<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = ['name'=> 'Admin', 'email'=> 'admin@gmail.com', 'password'=> Hash::make('admin'),];
        DB::table('admins')->insert($admin); 
        
        $this->call([
            CourseSeeder::class,
            LessonSeeder::class,
            TopicSeeder::class,
            CategorySeeder::class,
            WordSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
