<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('services','ServicesController');
Route::post('check/serviceName','ServicesController@checkSerName')->name('check.serName');
Route::post('status/service','ServicesController@statusChange')->name('service.status');

Route::resource('subServices','SubServicesController');
Route::post('check/SubServiceName','SubServicesController@checkSubSerName')->name('check.subSerName');
Route::post('status/SubService','SubServicesController@statusChange')->name('subService.status');

Route::resource('country','CountryController');
Route::post('check/countryName','CountryController@checkcountryName')->name('check.countryName');
Route::post('status/country','CountryController@statusChange')->name('country.status');

Route::resource('state','StateController');
Route::post('check/stateName','StateController@checkstateName')->name('check.stateName');
Route::post('status/state','StateController@statusChange')->name('state.status');

Route::resource('city','CityController');
Route::post('check/cityName','CityController@checkCityName')->name('check.cityName');
Route::post('status/city','CityController@statusChange')->name('city.status');
Route::post('get/stateList','CityController@stateList')->name('get.stateList');

Route::resource('currency','CurrencyController');
Route::post('check/currencyName','CurrencyController@checkCurrencyName')->name('check.currencyName');
Route::post('status/currency','CurrencyController@statusChange')->name('currency.status');

Route::resource('coinMaster','CoinMasterController');
Route::post('check/coinMaster','CoinMasterController@checkCoinMaster')->name('check.coinMaster');
Route::post('status/coinMaster','CoinMasterController@statusChange')->name('coinMaster.status');

Route::resource('coinVia','CoinviaController');
Route::post('check/withdraw','CoinviaController@withdrawChange')->name('withdraw.coinVia');
Route::post('status/coinVia','CoinviaController@statusChange')->name('coinVia.status');