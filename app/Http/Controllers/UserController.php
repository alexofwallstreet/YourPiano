<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserSongRatingPlay;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $usersQuery = User::with([]);
        if ($request->search) {
            $usersQuery->orWhere('name', 'LIKE', '%' . $request->search . '%');
            $usersQuery->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }

        return UserResource::collection($usersQuery->paginate());
    }

    /**
     * @throws \Exception
     */
    public function updatePhoto(Request $request, User $user)
    {
        $data = $request->validate([
            'profile_photo' => 'required|string',
        ]);

        if (isset($data['profile_photo'])) {
            $imagePath = $this->saveImage($data['profile_photo']);

            if ($user->profile_photo) {
                if (!str_contains($user->profile_photo, 'default.jpg')) {
                    $absolutePath = public_path($user->profile_photo);
                    File::delete($absolutePath);
                }
            }
        }
        $user->profile_photo = $imagePath;
        $user->save();

        return [
          'profile_image' => URL::to('/') . '/' . $imagePath
        ];
    }

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

        $dir = 'storage/user-profile-images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    public function stats(User $user)
    {
        # Count of songs that user played
        $playedSongs = UserSongRatingPlay::where('user_id', $user->id)->groupBy('song_id')->get()->count();

        # Count of points that user Get from played songs
        $totalPoints = UserSongRatingPlay::userRatingPoints($user);

        # User Place in users Rating
        $ratingUsers = UserSongRatingPlay::userPlaces($user)->get()->toArray();
        $userPlace = 1;
        foreach ($ratingUsers as $ratingUser) {
            if ($ratingUser->id === $user->id) {
                break;
            }
            $userPlace++;
        }
        foreach ($ratingUsers as $ratingUser) {
            $ratingUserPlayedSongs = UserSongRatingPlay::where('user_id', $ratingUser->id)
                ->groupBy('song_id')->get()->count();
            $ratingUser->playedSongs = $ratingUserPlayedSongs;
            $ratingUser->userStatus = UserSongRatingPlay::userStatus($ratingUserPlayedSongs);
        }

        return [
            'playedSongs' => $playedSongs,
            'totalPoints' => $totalPoints,
            'userStatus' => UserSongRatingPlay::userStatus($playedSongs),
            'userPlace' => $userPlace,
            'usersTop10' => array_slice($ratingUsers, 0, 10)
        ];
    }

    public function destroy(User $user)
    {
        if (file_exists(public_path('/storage/user-profile-images/' . $user->profile_photo))) {
            if ($user->profile_photo !== 'default.jpg') {
                unlink(public_path('/storage/user-profile-images/' . $user->profile_photo));
            }
        }
        $user->delete();
    }

}
