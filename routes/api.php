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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/logged-user', 'DashboardController@loggedUser');
    Route::get('/search-customer', 'SearchController@search');
    Route::apiResource('/users','UserController');
    Route::apiResource('/contacts','ContactController');
    Route::apiResource('/phones','PhoneController');
    
    //Route::get('/current-user', 'DashboardController@currentUser');
    //Route::apiResource('/users','UserController');
    
});


