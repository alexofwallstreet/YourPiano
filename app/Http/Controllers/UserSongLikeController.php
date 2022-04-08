<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongLikeRequest;
use App\Models\Song;
use App\Models\UserSongLike;
use Illuminate\Http\Request;

class UserSongLikeController extends Controller
{
    public function likeSong(SongLikeRequest $request, Song $song)
    {
        $like = new \App\Models\UserSongLike();
        $like->song_id = $song->id;
        $like->user_id = $request->user_id;
        $like->save();
    }

    public function dislikeSong(SongLikeRequest $request, Song $song)
    {
        $like = UserSongLike::where('song_id', $song->id)->where('user_id', $request->user_id)->delete();
    }
}
