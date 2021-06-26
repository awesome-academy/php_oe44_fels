<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name'=>'Animals'],
            ['name'=>'Family'],
            ['name'=>'Colors'],
            ['name'=>'Jobs'],
        );

        DB::table('topics')->insert($data);
    }
}
