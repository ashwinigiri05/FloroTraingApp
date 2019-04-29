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
   
    });
//Route::post('details', 'API\UserController@details');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::group(['middleware' => 'auth:api'], function(){
   
    //Route::post('details', 'API\UserController@details');
  //  Route::post('create','API\UserController@store');
    
    //Route::get('/edit_user/{id}', 'API\UserController@edit');
    //Route::patch('/updated_user/{id}', 'API\UserController@update');
    //Route::get('/user/myprofile', 'API\UserController@myprofile');
    //Route::get('/deleted_user/{id}', 'API\UserController@destroy');
    //Route::get('/search', 'API\UserController@search');
    //});