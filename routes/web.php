<?php

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
    return view('login');
});
Route::get('login', 'AuthController@index');
Route::post('loginpost', 'AuthController@loginpost');
Route::get('logout', 'AuthController@logout');
Route::get('/register', 'AuthController@register');
<<<<<<< HEAD
Route::post('/registerpost', 'AuthController@registerpost');
=======
>>>>>>> 13149d82becc96d2e41b3c217c795ccff71340a8

Route::get('/home', 'HomeController@index')->name('home');

