<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SongSeeder extends Seeder
{

    const SONGS = [
        [
            'title' => 'К Элизе',
            'author' => 'Людвиг ван Бетховен',
            'difficulty_level_id' => 3,
            'genre_id' => 3,
            'description' => 'Für Elise, багатель No. 25 ля минор для фортепиано соло, WoO 59, Bia 515) — фортепианная пьеса-багатель Людвига ван Бетховена. Это произведение Бетховена на протяжении многих лет является одним из самых известных шедевров мировой музыки. Входит в обязательную программу произведений в музыкальных школах всего мира.',
            'midi_file' => 'storage/songs-midi/fur_elise.mid',
            'image_file' => 'storage/songs-images/default.jpg'
        ],
        [
            'title' => 'Take On Me',
            'author' => 'a-ha',
            'difficulty_level_id' => 1,
            'genre_id' => 3,
            'description' => 'Für Elise, багатель No. 25 ля минор для фортепиано соло, WoO 59, Bia 515) — фортепианная пьеса-багатель Людвига ван Бетховена. Это произведение Бетховена на протяжении многих лет является одним из самых известных шедевров мировой музыки. Входит в обязательную программу произведений в музыкальных школах всего мира.',
            'midi_file' => 'storage/songs-midi/take_on_me.mid',
            'image_file' => 'storage/songs-images/default.jpg'
        ],
        [
            'title' => 'Star Wars Theme',
            'author' => 'Soundtrack',
            'difficulty_level_id' => 2,
            'genre_id' => 4,
            'description' => 'Für Elise, багатель No. 25 ля минор для фортепиано соло, WoO 59, Bia 515) — фортепианная пьеса-багатель Людвига ван Бетховена. Это произведение Бетховена на протяжении многих лет является одним из самых известных шедевров мировой музыки. Входит в обязательную программу произведений в музыкальных школах всего мира.',
            'midi_file' => 'storage/songs-midi/star_wars.mid',
            'image_file' => 'storage/songs-images/default.jpg'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::SONGS as $SONG) {
            DB::table('songs')->insert([$SONG]);
        }
    }
}
