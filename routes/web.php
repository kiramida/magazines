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

Route::get('/magazines', 'MagazinesController@index');
Route::post('/magazines/create', 'MagazinesController@create')->name('createMagazine');
Route::get('/magazines/delete/{id}', 'MagazinesController@destroy');
Route::get('/magazines/edit/{id}', 'MagazinesController@edit');
Route::post('/magazines/update/{id}', 'MagazinesController@update');

Route::get('/authors', 'AuthorsController@index');
Route::post('/authors/create', 'AuthorsController@create')->name('createAuthor');
Route::get('/authors/delete/{id}', 'AuthorsController@destroy');
Route::post('/authors/update/{id}', 'AuthorsController@update');
