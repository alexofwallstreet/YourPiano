<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\UserSongRatingPlay;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $playedSongs = UserSongRatingPlay::where('user_id', $this->id)->groupBy('song_id')->get()->count();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => UserSongRatingPlay::userStatus($playedSongs),
            'imagePath' => URL::to('/') . '/' . $this->profile_photo,
            'isAdmin' => $this->is_admin
        ];
    }
}
