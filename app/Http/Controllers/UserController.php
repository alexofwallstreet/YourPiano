<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Song;
use App\Models\User;
use App\Models\UserSongRatingPlay;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $usersQuery = User::with([])->where('id', '!=', $userId);
        if ($request->search) {
            $usersQuery->orWhere('name', 'LIKE', '%' . $request->search . '%');
            $usersQuery->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }

        return UserResource::collection($usersQuery->paginate(10));
    }

    /**
     * @throws \Exception
     */
    public function update(Request $request, User $user): UserResource
    {
        $emailValidation = 'required|email|string|unique:users,email';

        if ($request->email === $user->email) {
            $emailValidation = '';
        }

        $messages = [
            'required' => 'Не заполено одно из обязательных полей',
            'email' => 'Неверный адрес электронной почты',
        ];

        $data = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => $emailValidation,
            'profile_photo' => 'string|nullable',
        ], $messages)->validated();

        $user->update($data);

        if (!empty($data['profile_photo'])) {
            $imagePath = $this->saveImage($data['profile_photo']);

            if ($user->profile_photo) {
                if (!str_contains($user->profile_photo, 'default.jpg')) {
                    $absolutePath = public_path($user->profile_photo);
                    File::delete($absolutePath);
                }
            }

            $user->profile_photo = $imagePath;
        }

        $user->save();
        return new UserResource($user);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request, User $user)
    {
        $messages = [
            'required' => 'Не заполено одно из обязательных полей',
            'same' => 'Пароли не совпадают',
            'min' => 'Минимальная длина пароля - 8 символов',
            'numbers' => 'Пароль должен содержать хотя бы одну цифру',
            'mixedCase' => 'Пароль должен содержать буквы верхнего и нижнего регистров'
        ];

        $data = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => [
                'required',
                'same:new_password_confirm',
                Password::min(8)->mixedCase()->numbers(),
            ]
        ], $messages)->validated();

        if (Hash::check($data['old_password'], $user->password)) {
            $user->password = bcrypt($data['new_password']);
            $user->save();
            return new UserResource($user);
        }

        return response([
            'error' => 'Введен неверный пароль'
        ], 422);
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

    public function stats(User $user): array
    {
        # Count of songs that user played
        $playedSongs = UserSongRatingPlay::where('user_id', $user->id)->where('rating_points', '!=', 0)->groupBy('song_id')->get()->count();

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
                ->where('rating_points', '!=', 0)
                ->groupBy('song_id')->get()->count();
            $ratingUser->playedSongs = $ratingUserPlayedSongs;
            $ratingUser->userStatus = UserSongRatingPlay::userStatus($ratingUserPlayedSongs);
            $ratingUser->profile_photo = URL::to('/') . '/' . $ratingUser->profile_photo;
        }

        return [
            'playedSongs' => $playedSongs,
            'totalPoints' => $totalPoints,
            'userStatus' => UserSongRatingPlay::userStatus($playedSongs),
            'userPlace' => $userPlace,
            'usersTop10' => array_slice($ratingUsers, 0, 5)
        ];
    }

    public function adminStats(): array
    {
        $usersCount = User::all()->count();
        $songsCount = Song::all()->count();
        $totalRatingPlays = UserSongRatingPlay::all()->count();
        $totalRatingPoints = (int)DB::table('user_song_rating_plays')
            ->sum('rating_points');
        return [
            'usersCount' => $usersCount,
            'songsCount' => $songsCount,
            'totalRatingPlays' => $totalRatingPlays,
            'totalRatingPoints' => $totalRatingPoints,
        ];
    }

    public function destroy(User $user)
    {
        if ($user->profile_photo) {
            if (!str_contains($user->profile_photo, 'default.jpg')) {
                $absolutePath = public_path($user->profile_photo);
                File::delete($absolutePath);
            }
        }
        $user->delete();
        return response([
            'success' => true
        ]);
    }

    public function destroyResults(User $user)
    {
        UserSongRatingPlay::where('user_id', $user->id)->delete();
        return response([
            'success' => true
        ]);
    }
}
