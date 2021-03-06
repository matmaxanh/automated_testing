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

Route::get('/', 'PostController@index')->name('post_list');
Route::get('/posts/create', 'PostController@create')->name('post_create');
Route::post('/posts', 'PostController@store')->name('post_store');
