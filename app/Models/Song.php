<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'author', 'description', 'genre_id', 'difficulty_level_id', 'rating_points', 'youtube_link'];

    public function userSongRatingPlay(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserSongRatingPlay::class, 'user_song_rating_plays', 'id', 'song_id');
    }
}
