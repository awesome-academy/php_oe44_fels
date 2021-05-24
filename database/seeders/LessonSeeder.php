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
            ['course_id'=>1,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>1,'name'=>'Lesson 2','described'=>'Mô tả bài học'],
            ['course_id'=>2,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>2,'name'=>'Lesson 2','described'=>'Mô tả bài học'], 
            ['course_id'=>3,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>4,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>5,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>6,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>7,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
            ['course_id'=>8,'name'=>'Lesson 1','described'=>'Mô tả bài học'],
        );

        DB::table('lessons')->insert($data);
    }
}
