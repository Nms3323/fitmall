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

Route::group([
	'prefix' => 'auth'
], function () {
	Route::post('login', 'api\AuthController@login');
	Route::post('signup', 'api\AuthController@signup');

	Route::group([
		'middleware' => 'auth:api'
	], function() {
		Route::get('logout', 'api\AuthController@logout');
		Route::get('user', 'api\AuthController@user');
		Route::post('UpdateProfile', 'api\AuthController@UpdateProfile');
		
		Route::get('country', 'api\LocationController@country');
		Route::get('state', 'api\LocationController@state');
		Route::get('city', 'api\LocationController@city');

		Route::post('getState', 'api\LocationController@getState');
		Route::post('getCity', 'api\LocationController@getCity');

	});
});