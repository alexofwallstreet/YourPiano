<?php

namespace App\Http\Resources;

use App\Models\UserSongLike;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
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
            'imagePath' => URL::to('/') . '/storage/songs-images/' . $this->image_file,
            'isFavorite' => UserSongLike::where('song_id', $this->id)->where('user_id', $request->user_id)->exists(),
            'ratingPoints' => $this->rating_points,
      ];
    }
}
