<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\I18nController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserTopicController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/i18n/{option}', [I18nController::class, 'changes'])->name('i18n');

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/user_topic/insert', [UserTopicController::class ,'insert'])->name('user_topic.insert');

Route::post('/user_course/insert/{course_id}', [UserCourseController::class ,'insert'])->name('user_course.insert');

Route::get('/other-courses', [CourseController::class ,'index'])->name('other.courses');
