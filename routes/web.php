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

Auth::routes();

Route::get('/home', 'RecetteController@all')->name('home');
Route::get('/top', 'RecetteController@top')->name('recettes.top');
Route::get('/top_users', 'UserController@top')->name('users.top');
Route::post('/recettes/{id}/update_note', 'RecetteController@update_note')->name('recettes.update_note');
Route::resource('recettes', 'RecetteController');
Route::resource('users', 'UserController');
Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost', ['as' => 'resizeImagePost', 'uses' => 'ImageController@resizeImagePost']);
