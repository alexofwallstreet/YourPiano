<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSongRatingPlay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function updatePhoto(Request $request, User $user)
    {
        $request->validate([
            'profile_photo' => 'image|max:2000',
        ]);

        if ($request->file('profile_photo')) {
            if (file_exists(public_path('/storage/user-profile-images/' . $user->profile_photo))) {
                if ($user->profile_photo !== 'default.jpg') {
                    unlink(public_path('/storage/user-profile-images/' . $user->profile_photo));
                }
            }
            $photoName = Str::uuid() . '.' . $request->profile_photo->getClientOriginalExtension();
            $request->profile_photo->move(public_path('/storage/user-profile-images'), $photoName);
            $user->profile_photo = $photoName;
        }

        $user->save();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }

    public function stats(User $user)
    {
        # Count of songs that user played
        $playedSongs = UserSongRatingPlay::where('user_id', $user->id)->groupBy('song_id')->count();

        # Count of points that user Get from played songs
        $totalPoints = UserSongRatingPlay::userRatingPoints($user);

        # User Place in users Rating
        $ratingUsers = UserSongRatingPlay::userPlaces($user)->get();
        $userPlace = 1;
        foreach ($ratingUsers as $ratingUser) {
            if ($ratingUser->id === $user->id) {
                break;
            }
            $userPlace++;
        }

        return [
            'playedSongs' => $playedSongs,
            'totalPoints' => $totalPoints,
            'userPlace' => $userPlace,
            'usersTop10' => array_slice($ratingUsers->toArray(), 0, 10)
        ];
    }
}
