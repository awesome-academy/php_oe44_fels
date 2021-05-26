<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\I18nController;
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
