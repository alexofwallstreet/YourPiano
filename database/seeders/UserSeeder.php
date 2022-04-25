<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => "Alex",
          'email' => 'alexwolf@gmail.com',
          'password' => bcrypt('Az123456'),
        ]);
        DB::table('users')->insert([
            'name' => "Alex Wolf",
            'email' => 'alex@gmail.com',
            'password' => bcrypt('Az123456'),
            'is_admin' => true
        ]);
    }
}
