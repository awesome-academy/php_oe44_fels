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
            ['name'=>'[Animals] Basic Course On Animals', 'described'=>'Something content...', 'topic_id'=>1], 
            ['name'=>'[Animals] Advanced Course On Animals', 'described'=>'Something content...', 'topic_id'=>1], 

            ['name'=>'[Family] Basic Course On Family', 'described'=>'Something content...', 'topic_id'=>2], 
            ['name'=>'[Family] Advanced Course On Family', 'described'=>'Something content...', 'topic_id'=>2], 

            ['name'=>'[Colors] Basic Course On Colors', 'described'=>'Something content...', 'topic_id'=>3], 
            ['name'=>'[Colors] Advanced Course On Colors', 'described'=>'Something content...', 'topic_id'=>3], 

            ['name'=>'[Jobs] Basic Course On Jobs', 'described'=>'Something content...', 'topic_id'=>4], 
            ['name'=>'[Jobs] Advanced Course On Jobs', 'described'=>'Something content...', 'topic_id'=>4], 
        );

        DB::table('courses')->insert($data);
    }
}
