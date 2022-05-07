<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSongRatingPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('user_song_rating_plays')->insert([
                'user_id' => User::inRandomOrder()->first()->id,
                'song_id' => Song::inRandomOrder()->first()->id,
                'rating_points' => rand(0, 50),
            ]);
        }
    }
}
