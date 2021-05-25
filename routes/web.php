<?php

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   
    return view('welcome');
});
