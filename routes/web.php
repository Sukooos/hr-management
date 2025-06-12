<?php

use Illuminate\Support\Facades\Route;
use Mews\Captcha\Captcha;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
