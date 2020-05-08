<?php

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

//Auth::routes();

Route::prefix('/admin')->group(function (){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');

    Route::get('/media','MediaController@index');
    Route::get('/media/create','MediaController@create');
    Route::post('/media/create','MediaController@create');
    Route::get('/media/{media}','MediaController@show');
    Route::get('/media/{media}/edit','MediaController@edit');
    Route::patch('/media/{media}/edit','MediaController@update');
    Route::delete('/media/{media}','MediaController@destroy');
});

Route::post('/contact', 'ContactController@store');


Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset ', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('/password/reset ', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/home', 'HomeController@index')->name('home');
