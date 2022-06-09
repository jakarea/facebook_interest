<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'SearchController@searchuser')->name('search.user');
Route::get('postinsert', 'SearchController@searchuser');

Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('/login', [FacebookController::class, 'login'])->name('login');
    Route::get('/accessToken', [FacebookController::class, 'generateAccessToken']);
    Route::get('/logout', [FacebookController::class, 'facebookLogout']);
});

Route::get('/user/logout', 'HomeController@logout')->name('user.logout');