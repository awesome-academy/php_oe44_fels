<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name'=>'Nouns','described'=>'Kí hiệu (n). Danh từ là từ loại trong tiếng Anh chỉ tên người, đồ vật, sự việc hay địa điểm, nơi chốn.'],
            ['name'=>'Verb','described'=>'Kí hiệu (v). Động từ là từ loại trong tiếng Anh diễn tả hành động, một tình trạng hay một cảm xúc. Động từ trong tiếng Anh giúp xác định chủ từ đang làm hay chịu đựng điều gì.'],
            ['name'=>'Adjective','described'=>'Kí hiệu (adj). Tính từ là từ loại trong tiếng Anh chỉ tính chất của sự vật, sự việc, hiện tượng.'],
            ['name'=>'Adverb','described'=>'Kí hiệu (adv). Trạng từ là từ loại trong tiếng Anh nêu ra trạng thái hay tình trạng.'],
            ['name'=>'Prepositions','described'=>'Kí hiệu (pre). Giới từ là từ loại trong tiếng Anh dùng để diễn tả mối tương quan về hoàn cảnh, thời gian hay vị trí của các sự vật, sự việc được nói đến.'],
        );
        
        DB::table('categories')->insert($data);
    }
}
