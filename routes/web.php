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
Route::post('/registerpost', 'AuthController@registerpost');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/member-profile', 'MembersController@index');
Route::post('/member/update', 'MembersController@updateMember');
Route::get('/forgotten-password', 'AuthController@forgot_password');
Route::post('reset-password','AuthController@reset_password');
Route::get('register-confirmation/{token}', 'AuthController@confirmation_show');
Route::get('reset-active/{token}', 'AuthController@active_show');
Route::post('reset-active/token', 'AuthController@active_token');

