<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Http\Requests;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $songQuery = Song::with([]);
        if ($request->search) {
            $songQuery->orWhere('title', 'LIKE', '%' . $request->search . '%');
            $songQuery->orWhere('author', 'LIKE', '%' . $request->search . '%');
            $songQuery->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->title) {
            $songQuery->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->author) {
            $songQuery->where('author', 'LIKE', '%' . $request->author . '%');
        }
        if ($request->difficultyLevel) {
            if (is_array($request->difficultyLevel)) {
                $songQuery->where(function ($query) use ($request) {
                    return $query->whereIn('difficulty_level_id', $request->difficultyLevel);
                });
            }
        }
        if ($request->genre) {
            if (is_array($request->genre)) {
                $songQuery->where(function ($query) use ($request) {
                    return $query->whereIn('genre_id', $request->genre);
                });
            }
        }

        if ($request->orderBy) {
            switch ($request->orderBy) {
                case 'popularity':
                    $songQuery->selectRaw('songs.*, COUNT(user_song_rating_plays.id) AS plays_count')
                        ->leftJoin('user_song_rating_plays', 'songs.id', '=', 'user_song_rating_plays.song_id')
                        ->groupBy('songs.id')
                        ->orderBy('plays_count', 'desc');
                    break;
                case 'oldest':
                    $songQuery->orderBy('id', 'ASC');
                    break;
                default:
                    $songQuery->orderBy('id', 'DESC');
                    break;
            }
        }
        return SongResource::collection($songQuery->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\SongStoreRequest $request
     * @return SongResource
     */
    public function store(Requests\SongStoreRequest $request): SongResource
    {
        $newSong = new Song();
        $newSong->fill($request->validated());

        if (isset($request['image_file']) && !empty($request['image_file'])) {
            $imagePath = $this->saveImage($request['image_file']);
            $newSong->image_file = $imagePath;
        }

        $midiPath = $this->saveMidi($request['midi_file']);
        $newSong->midi_file = $midiPath;

        $newSong->save();
        return new SongResource($newSong);
    }

    /**
     * @throws \Exception
     */
    public function saveImage($image): string
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]); //png, jpg, gif

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new \Exception('Неверный тип изображения');
            }

            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);
            if ($image === false) {
                throw new \Exception('Ошибка при декодировании файла');
            }
        } else {
            throw new \Exception('Ошибка при загрузке картинки');
        }

        $dir = 'storage/songs-images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    /**
     * @throws \Exception
     */
    public function saveMidi($midi): string
    {
        $b64_sub = substr($midi, strpos($midi, ",") + 1);
        $b64_clean = str_replace(' ', '+', $b64_sub);
        $raw = base64_decode($b64_clean, true);
        $dir = 'storage/songs-midi/';
        $file = Str::random() . '.mid';
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $raw);
        return $relativePath;
    }

    /**
     * Display the specified resource.
     *
     * @param Song $song
     * @return SongResource
     */
    public function show(Song $song): SongResource
    {
        return new SongResource($song);
    }

    /**
     * Display the specified resource midi.
     *
     * @param Song $song
     * @return false|string
     */
    public function midi(Song $song)
    {
        $path = public_path($song->midi_file);
        if (file_exists($path)) {
            return file_get_contents($path);
        }
        return response('Cannot load MIDI File', ResponseAlias::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\SongUpdateRequest $request
     * @param Song $song
     * @return SongResource
     * @throws \Exception
     */
    public function update(Requests\SongUpdateRequest $request, Song $song): SongResource
    {
        $song->update($request->validated());

        if (!empty($request['image_file'])) {
            $imagePath = $this->saveImage($request['image_file']);

            if ($song->image_file) {
                if (!str_contains($song->image_file, 'default.jpg')) {
                    $absolutePath = public_path($song->image_file);
                    File::delete($absolutePath);
                }
            }

            $song->image_file = $imagePath;
        }

        if (!empty($request['midi_file'])) {
            $midiPath = $this->saveMidi($request['midi_file']);

            if ($song->midi_file) {
                $absolutePath = public_path($song->midi_file);
                File::delete($absolutePath);
            }

            $song->midi_file = $midiPath;
        }

        $song->save();
        return new SongResource($song);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Song $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song): \Illuminate\Http\Response
    {
        if (file_exists(public_path('/storage/songs-images/' . $song->image_file))) {
            if ($song->image_file !== 'default.jpg') {
                unlink(public_path('/storage/songs-images/' . $song->image_file));
            }
        }
        if (file_exists(public_path('/storage/songs-midi/' . $song->midi_file))) {
            unlink(public_path('/storage/songs-midi/' . $song->midi_file));
        }
        $song->delete();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
