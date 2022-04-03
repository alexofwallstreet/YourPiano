<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    const GENRES = [
      'Поп',
      'Рок',
      'Хип-хоп',
      'Рэп',
      'Электронная',
      'Классическая',
      'Джаз',
      'R&B'
    ];

    public function run()
    {
        foreach (self::GENRES as $GENRE) {
          DB::table('genres')->insert([
            'title' => $GENRE
          ]);
        }
    }
}
