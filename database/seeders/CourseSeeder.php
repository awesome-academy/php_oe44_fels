<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name'=>'Basic 1','described'=>'[Cơ bản] Dành cho người mới bắt đầu','topic_id'=>1], 
            ['name'=>'Basic 1','described'=>'[Cơ bản] Dành cho người mới bắt đầu','topic_id'=>2], 
            ['name'=>'Basic 1','described'=>'[Cơ bản] Dành cho người mới bắt đầu','topic_id'=>3], 
            ['name'=>'Basic 1','described'=>'[Cơ bản] Dành cho người mới bắt đầu','topic_id'=>4], 
            ['name'=>'Advanced 1','described'=>'[Nâng cao] Dành cho người đi làm','topic_id'=>1],
            ['name'=>'Advanced 1','described'=>'[Nâng cao] Dành cho người đi làm','topic_id'=>2],
            ['name'=>'Advanced 1','described'=>'[Nâng cao] Dành cho người đi làm','topic_id'=>3],
            ['name'=>'Advanced 1','described'=>'[Nâng cao] Dành cho người đi làm','topic_id'=>4],
        );

        DB::table('courses')->insert($data);
    }
}
