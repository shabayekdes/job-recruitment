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

Route::get('jobs/login/{job}', 'JobController@showLoginForm')->name('job.login.show');
Route::post('jobs/login', 'JobController@login')->name('job.login.store');

Route::get('jobs/register/{job}', 'JobController@showRegisterForm')->name('job.register.show');
Route::post('jobs/register', 'JobController@register')->name('job.register.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('jobs', 'Web\JobController@index')->name('job.index');
Route::get('jobs/{job:post_name}', 'Web\JobController@show')->name('job.show');
