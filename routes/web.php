<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'TestController');

Route::get('login/{job?}', 'AuthController@showLoginForm')->name('login.show');
Route::post('login', 'AuthController@login')->name('login.store');

Route::get('register/{job?}', 'AuthController@showRegisterForm')->name('register.show');
Route::post('register', 'AuthController@register')->name('register.store');

Route::post('logout', 'AuthController@logout')->name('logout');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('jobs', 'Web\JobController@index')->name('job.index');
Route::get('jobs/{job:post_name}', 'Web\JobController@show')->name('job.show');
