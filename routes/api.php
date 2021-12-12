<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'AuthController@login')->name('login'); 

Route::middleware('api',/*'auth:api'*/)->group(function () {
    Route::resource('users', UserController::class);
    Route::post('profile', 'UserController@profile');   
    Route::get('search/{data}', 'UserController@search');  
    Route::get('date/{dateStart}/{dateEnd}', 'UserController@date'); 
    Route::get('validate/email/{email}','UserController@email');
    Route::post('/logout', 'AuthController@logout');
});


