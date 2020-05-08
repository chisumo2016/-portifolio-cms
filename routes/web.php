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


    Route::prefix('/media')->group(function (){

        Route::get('/',         'MediaController@index');
        Route::get('/create',   'MediaController@create');
        Route::post('/create',  'MediaController@create');
        Route::get('/{medium}',  'MediaController@show');
        Route::get('/{medium}/edit','MediaController@edit');
        Route::patch('/{medium}/edit','MediaController@update');
        Route::delete('/{medium}','MediaController@destroy');

    });

    Route::resource('posts', 'PostController@index');
});

Route::post('/contact', 'ContactController@store');


Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset ', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('/password/reset ', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/home', 'HomeController@index')->name('home');
