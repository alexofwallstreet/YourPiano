<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->foreignIdFor(\App\Models\Genre::class);
            $table->foreignIdFor(\App\Models\DifficultyLevel::class);
            $table->string('midi_file');
            $table->string('youtube_link')->nullable();
            $table->text('description');
            $table->integer('rating_points')->default(100);
            $table->string('image_file')->default('storage/songs-images/default.jpg');
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
        Schema::dropIfExists('songs');
    }
}
