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

// Auth routes
Auth::routes();

// Home route
Route::get('/', 'HomeController@index')->name('home');

// User routes
Route::get('/user/{user}', 'UserController@index')->name('user');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('auth');
Route::put('/user/{user}', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('/user/{user}/tweet', 'UserController@tweet')->name('user.tweet');

// Entry routes
Route::get('/entry', 'EntryController@create')->name('entry.create');
Route::post('/entry', 'EntryController@save')->name('entry.save')->middleware('auth');
Route::get('/entry/{entry}', 'EntryController@index')->name('entry');
Route::get('/entry/{entry}/edit', 'EntryController@edit')->name('entry.edit')->middleware('auth');
Route::put('/entry/{entry}', 'EntryController@update')->name('entry.update')->middleware('auth');
