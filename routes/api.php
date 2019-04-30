<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login'); 
Route::group(['middleware' => 'auth:api'], function(){

    Route::get('details', 'API\UserController@details');
    Route::post('create', 'API\UserController@store');
    Route::post('user/{id}', 'API\UserController@update');
    Route::post('delete/{id}', 'API\UserController@destroy');
    Route::get('search', 'API\UserController@search');
    Route::get('sort', 'API\UserController@sortUser');
   
   
   
    Route::get('download/users', 'API\ExportUserController@showUsersDownload')->name('showUsersDownload');
    Route::get('download/users-file', 'API\ExportUserController@usersDownload')->name('usersDownload');

    Route::post('logout', 'API\UserController@logout');
    });