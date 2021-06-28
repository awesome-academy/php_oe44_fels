<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['course_id'=>1,'name'=>'Basic Animals Lesson 1','described'=>'Something content...'],
            ['course_id'=>1,'name'=>'Basic Animals Lesson 2','described'=>'Something content...'],
            ['course_id'=>2,'name'=>'Advanced Animals Lesson 1','described'=>'Something content...'],

            ['course_id'=>3,'name'=>'Basic Family Lesson 1','described'=>'Something content...'],
            ['course_id'=>3,'name'=>'Basic Family Lesson 2','described'=>'Something content...'],
            ['course_id'=>3,'name'=>'Basic Family Lesson 3','described'=>'Something content...'],
            ['course_id'=>4,'name'=>'Advanced Family Lesson 1','described'=>'Something content...'],
            
        );

        DB::table('lessons')->insert($data);
    }
}
