<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'vocabulary' => 'Bear',
                'spelling' => 'bɛr',
                'translate' => 'Con gấu',
                'category_id' => 1,
                'lesson_id' => 1,
                'range_questions' => '1,2,3',
            ],
            [
                'vocabulary' => 'Bird',
                'spelling' => 'bɜrd',
                'translate' => 'Con chim',
                'category_id' => 1,
                'lesson_id' => 1,
                'range_questions' => '4,5,6',
            ],
            [
                'vocabulary' => 'Cat',
                'spelling' => 'kæt',
                'translate' => 'Con mèo',
                'category_id' => 1,
                'lesson_id' => 1,
                'range_questions' => '7,8,9',
            ],
            [
                'vocabulary' => 'Cow',
                'spelling' => 'kaʊ',
                'translate' => 'Con bò',
                'category_id' => 1,
                'lesson_id' => 2,
                'range_questions' => '10,11,12',
            ],
            [
                'vocabulary' => 'Donkey',
                'spelling' => 'ˈdɑŋki',
                'translate' => 'Con lừa',
                'category_id' => 1,
                'lesson_id' => 2,
                'range_questions' => '13,14,15',
            ],
            [
                'vocabulary' => 'Elephant',
                'spelling' => 'ˈɛləfənt',
                'translate' => 'Con voi',
                'category_id' => 1,
                'lesson_id' => 2,
                'range_questions' => '16,17,18',
            ],
            [
                'vocabulary' => 'Goat',
                'spelling' => 'goʊt',
                'translate' => 'Con dê',
                'category_id' => 1,
                'lesson_id' => 3,
                'range_questions' => '19,20,21',
            ],
            [
                'vocabulary' => 'Insect',
                'spelling' => 'ˈɪnˌsɛkt',
                'translate' => 'Côn trùng',
                'category_id' => 1,
                'lesson_id' => 3,
                'range_questions' => '22,23,24',
            ],
            [
                'vocabulary' => 'Rabbit',
                'spelling' => 'ˈræbət',
                'translate' => 'Con thỏ',
                'category_id' => 1,
                'lesson_id' => 3,
                'range_questions' => '25,26,27',
            ],
            [
                'vocabulary' => 'Aunt',
                'spelling' => 'Ænt',
                'translate' => 'Người dì',
                'category_id' => 1,
                'lesson_id' => 4,
                'range_questions' => '28,29,30',
            ],
            [
                'vocabulary' => 'Brother',
                'spelling' => 'ˈbrʌðər',
                'translate' => 'Anh/em trai',
                'category_id' => 1,
                'lesson_id' => 4,
                'range_questions' => '31,32,33',
            ],
            [
                'vocabulary' => 'Close',
                'spelling' => 'kloʊs',
                'translate' => 'Gần gũi, gắn bó',
                'category_id' => 3,
                'lesson_id' => 4,
                'range_questions' => '34,35,36',
            ],
            [
                'vocabulary' => 'Cousin',
                'spelling' => 'ˈkʌzən',
                'translate' => 'Anh chị em họ',
                'category_id' => 1,
                'lesson_id' => 5,
                'range_questions' => '37,38,39',
            ],
            [
                'vocabulary' => 'Daughter',
                'spelling' => 'ˈdɔtər',
                'translate' => 'Con gái',
                'category_id' => 1,
                'lesson_id' => 5,
                'range_questions' => '40,41,42',
            ],
            [
                'vocabulary' => 'Son',
                'spelling' => 'sʌn',
                'translate' => 'Con trai',
                'category_id' => 1,
                'lesson_id' => 5,
                'range_questions' => '43,44,45',
            ],
            [
                'vocabulary' => 'Parents',
                'spelling' => 'ˈpɛrənts',
                'translate' => 'Cha mẹ, phụ huynh',
                'category_id' => 1,
                'lesson_id' => 6,
                'range_questions' => '46,47,48',
            ],
            [
                'vocabulary' => 'Mother',
                'spelling' => 'ˈmʌðər',
                'translate' => 'Mẹ',
                'category_id' => 1,
                'lesson_id' => 6,
                'range_questions' => '49,50,51',
            ],
            [
                'vocabulary' => 'Father',
                'spelling' => 'ˈfɑðər',
                'translate' => 'Cha/Bố',
                'category_id' => 1,
                'lesson_id' => 6,
                'range_questions' => '52,53,54',
            ],
            [
                'vocabulary' => 'Pregnant',
                'spelling' => 'ˈprɛgnənt',
                'translate' => 'Mang thai',
                'category_id' => 3,
                'lesson_id' => 7,
                'range_questions' => '55,56,57',
            ],
            [
                'vocabulary' => 'Relative',
                'spelling' => 'ˈrɛlətɪv',
                'translate' => 'Họ hàng',
                'category_id' => 1,
                'lesson_id' => 7,
                'range_questions' => '58,59,60',
            ],
            [
                'vocabulary' => 'Sibling',
                'spelling' => 'ˈsɪblɪŋ',
                'translate' => 'Anh chị em',
                'category_id' => 1,
                'lesson_id' => 7,
                'range_questions' => '61,62,63',
            ],
        );

        DB::table('words')->insert($data);
    }
}
