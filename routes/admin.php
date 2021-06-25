<?php

use App\Http\Controllers\Auth\Admin\Auth\AdminController;
use App\Http\Controllers\Auth\Admin\CategoryAdminController;
use App\Http\Controllers\Auth\Admin\CourseAdminController;
use App\Http\Controllers\Auth\Admin\LessonAdminController;
use App\Http\Controllers\Auth\Admin\WordAdminController;
use App\Http\Controllers\NotifyController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::middleware('auth:admin')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');

    Route::resource('/courses', CourseAdminController::class);
    Route::resource('/lessons', LessonAdminController::class);
    Route::post('lessons/removeWord/{id_lesson}', [LessonAdminController::class, 'removeWord'])->name('lessons.removeWord');
    Route::resource('/words', WordAdminController::class);
    Route::resource('/categories', CategoryAdminController::class);
    Route::get('/notifications',[NotifyController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark_all_as_read/',[NotifyController::class, 'markAllAsRead'])->name('notifications.mark_all_as_read');
});
