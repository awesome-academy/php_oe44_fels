<?php

use App\Http\Controllers\Auth\Admin\ChartController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\UserLessonController;
use App\Http\Controllers\WordController;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('questions/check', [UserLessonController::class, 'checkAnswer']);

Route::post('user/lesson/result', [UserLessonController::class, 'updateResult']);

Route::get('words/{option}', [WordController::class, 'filter'])->name('words');

Route::get('words/search/{char}', [WordController::class, 'search'])->name('search');

Route::put('notification/update/{id}', [NotifyController::class, 'updateRead']);

Route::get('chart/user-register/{year}', [ChartController::class, 'userRegister'] );

Route::get('chart/topic-of-month/{month}/{year}', [ChartController::class, 'topicOfMonth'] );

Route::get('chart/topic-of-year/{year}', [ChartController::class, 'topicOfYear']);

Route::get('chart/course-regiser/{month}/{year}', [ChartController::class, 'courseRegister']);
