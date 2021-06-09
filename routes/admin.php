<?php

use App\Http\Controllers\Auth\Admin\Auth\AdminController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::middleware('auth:admin')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
});
