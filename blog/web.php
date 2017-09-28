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
    return view('welcome');
});
//crypt的用法
Route::any('crypt','IndexController@crypt');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//自己设计登陆
Route::group(['middleware'=>['admin.login']],function(){
        Route::any('backend/backend','Backend\IndexController@backend');
});
Route::any('backend/index','Backend\IndexController@index');
Route::any('backend/login','Backend\IndexController@login');
