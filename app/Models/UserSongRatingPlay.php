<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSongRatingPlay extends Model
{
    use HasFactory;

    public function song(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Song::class, 'song_id');
    }
}
