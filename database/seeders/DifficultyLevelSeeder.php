<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DifficultyLevelSeeder extends Seeder
{

  const LEVELS = [
    'Простой', 'Средний', 'Сложный'
  ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (self::LEVELS as $LEVEL) {
        DB::table('difficulty_levels')->insert([
          'title' => $LEVEL
        ]);
      }
    }
}
