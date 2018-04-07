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

Route::get('/reg',  'RegController@create'); // 外委企业注册
Route::post('/reg', 'RegController@store'); // 外委企业注册


Route::get('/', function () {
    return view('welcome');
});
