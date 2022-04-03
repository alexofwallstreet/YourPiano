<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
        'midiPath' => $this->midi_file,
        'imagePath' => URL::to('/') . '/storage/songs-images/' . $this->image_file,
      ];
    }
}
