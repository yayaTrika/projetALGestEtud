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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::put('users/{user}', 'API\UserController@updateUser');
Route::get('/users', 'API\UserController@users')->name('List user'); //list users
Route::post('/users', 'API\UserController@details')->name('Detail user'); //avec id
Route::group(['middleware' => 'auth:api'], function(){
	Route::post('/details', 'API\UserController@details')->name('User detail');
});

Route::apiResource('etudiants','EtudiantController');
Route::apiResource('niveaux','NiveauController');
 