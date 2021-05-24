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
            ['name'=>'Information Technology'],
            ['name'=>'Family'],
            ['name'=>'Friend'],
            ['name'=>'Love'],
        );

        DB::table('topics')->insert($data);
    }
}
