<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongLikeRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use App\Models\UserSongLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSongLikeController extends Controller
{
    public function show(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $songs = DB::table('songs')
            ->join('user_song_likes', 'songs.id', '=', 'user_song_likes.song_id')
            ->where('user_song_likes.user_id', '=', $request->user_id)
            ->select('songs.*');

        return SongResource::collection($songs->paginate(8));
    }

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
