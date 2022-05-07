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
            'name' => "Амадей Волчков",
            'email' => 'alex@gmail.com',
            'password' => bcrypt('Az123456'),
            'profile_photo' => 'storage/user-profile-images/TX6Ky4a6qTuexUDq.jpeg',
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => "Алекс Волк",
            'email' => 'alexwolf@gmail.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/9QrQr6LBoEXo01Ar.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Людвиг ван Бетховен",
            'email' => 'beethooven@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/LX0S7x6ITsjXu2yg.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Вольфганг Амадей Моцарт",
            'email' => 'mozart@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/jKLbfp8FLwMX5m4k.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Пётр Ильич Чайковский",
            'email' => 'tchaikovski@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/vwCbiXWWn84g7GBe.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Иоганн Штраус",
            'email' => 'straus@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/VtHQix4PoyPXLqTD.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Клод Дебюсси",
            'email' => 'debussy@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/8tI5OBTI4Njw70LP.jpeg',
        ]);
        DB::table('users')->insert([
            'name' => "Эрик Сати",
            'email' => 'satie@example.com',
            'password' => bcrypt(sha1(time())),
            'profile_photo' => 'storage/user-profile-images/TczkBzC5bhdG7VRk.jpeg',
        ]);
    }
}
