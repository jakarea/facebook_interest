<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class,'welcome']);
Route::get('/login',function(){
    return view('auth.login');
})->name('login');

// Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'HomeController@logout')->name('user.logout');

// serach
Route::get('/search/user/', 'SearchController@searchuser')->name('search.user');

Route::get('postinsert', 'SearchController@searchuser');
Route::post('postinsert', 'SearchController@searchuser');

//Facebook Authentication
Route::prefix('facebook')->name('facebook.')->group(function(){
    Route::get('/login',[FacebookController::class,'login'])->name('login');
    Route::get('/accessToken',[FacebookController::class,'generateAccessToken']);
    Route::get('/logout',[FacebookController::class,'facebookLogout']);
});