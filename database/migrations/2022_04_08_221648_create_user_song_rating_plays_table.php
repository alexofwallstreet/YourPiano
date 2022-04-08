<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSongRatingPlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_song_rating_plays', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Song::class);
            $table->integer('rating_points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_song_rating_plays');
    }
}
