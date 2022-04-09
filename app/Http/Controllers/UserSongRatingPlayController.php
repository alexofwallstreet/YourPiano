<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\UserSongRatingPlay;
use Illuminate\Http\Request;

class UserSongRatingPlayController extends Controller
{
    public function create(Request $request, Song $song)
    {
        $request->validate([
            'user_id' => 'exists:users,id',
            'rating_points' => 'required|numeric'
        ]);
        $newPlay = new UserSongRatingPlay();
        $newPlay->user_id = $request->user_id;
        $newPlay->song_id = $song->id;
        $newPlay->rating_points = $request->rating_points;
        $newPlay->save();
    }
}
