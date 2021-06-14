<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\I18nController;
use App\Http\Controllers\UserLessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserTopicController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/i18n/{option}', [I18nController::class, 'changes'])->name('i18n');

Route::post('/user/login', [LoginController::class, 'login'])->name('user.login');

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('words', [WordController::class, 'index'])->name('words');

    Route::get('lessons/{course_id}', [UserLessonController::class, 'index'])->name('lessons');
    Route::get('lesson/start/{lesson_id}', [UserLessonController::class, 'start'])->name('lesson.start');

    Route::post('/user_topic/insert', [UserTopicController::class, 'insert'])->name('user_topic.insert');
    Route::post('/user_course/insert/{course_id}', [UserCourseController::class, 'insert'])->name('user_course.insert');
    Route::get('/other_courses', [CourseController::class, 'index'])->name('other.courses');

    Route::match(['GET', 'PATCH'], '/user/profile', [UserController::class, 'index'])->name('user.profile');
});
