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
  // dd("ghjg");
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'UserController@search');

Route::get('/user/create','UserController@create');
Route::post('/user/create/store', 'UserController@store');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::get('/user/myprofile', 'UserController@myprofile');
Route::patch('/user/{id}', 'UserController@update');
Route::get('/user/{id}', 'UserController@destroy');



Route::get('/export/users', 'ExportUserController@exportUsers')->name('usersExport');
Route::get('/download/users', 'ExportUserController@showUsersDownload')->name('showUsersDownload');
Route::get('/download/users-file', 'ExportUserController@usersDownload')->name('usersDownload');