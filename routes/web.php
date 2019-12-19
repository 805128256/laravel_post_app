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

Route::get('/test', function () {
    return view('test');
});

Route::get('/posts','PostController@index')->name('posts.index');

Route::post('/admin/{id}','PostController@admin')->name('admin');

Route::get('/posts/create','PostController@create')->name('posts.create');

Route::post('/posts','PostController@store')->name('posts.store');

Route::post('/comments','CommentController@store')->name('comments.store');

Route::get('/posts/{id}','PostController@show')->name('posts.show')->middleware('auth');

Route::put('/posts/{id}','PostController@update')->name('posts.update');

Route::put('/comments/{id}','CommentController@update')->name('comments.update');

Route::delete('/posts/{id}','PostController@destroy')->name('posts.destroy');

Route::delete('/comments/{id}','CommentController@destroy')->name('comments.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

