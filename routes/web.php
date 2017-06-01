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
Route::resource('maintenance/banks','bankController');
Route::get('maintenance/banks/get/data', ['uses' => 'bankController@data', 'as' => 'banks.getData']);
Route::post('maintenance/banks/softDelete/{bank}', ['uses' => 'bankController@softDelete', 'as' => 'banks.softDelete']);