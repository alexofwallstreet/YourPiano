<?php

namespace App\Http\Resources;

use App\Models\UserSongLike;
use App\Models\UserSongRatingPlay;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre_id,
            'difficulty' => $this->difficulty_level_id,
            'description' => $this->description,
            'imagePath' => URL::to('/') . '/' . $this->image_file,
            'isFavorite' => UserSongLike::where('song_id', $this->id)->where('user_id', $request->user_id)->exists(),
            'userPoints' => UserSongRatingPlay::where('song_id', $this->id)->where('user_id', $request->user_id)->max('rating_points') ?? null,
            'totalPlays' => UserSongRatingPlay::where('song_id', $this->id)->count(),
            'ratingPoints' => $this->rating_points,
            'youtubeLink' => $this->youtube_link,
      ];
    }
}
