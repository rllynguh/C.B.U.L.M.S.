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
Route::put('maintenance/banks/softdelete/{bank}', ['uses' => 'bankController@softdelete', 'as' => 'banks.softDelete']);

Route::resource('maintenance/businesstypes','businessTypeController');
Route::put('maintenance/businesstypes/softdelete/{businessType}',['uses' => 'businessTypeController@softDelete', 'as' => 'businesstypes.softdelete']);
Route::get('maintenance/businesstypes/get/data', ['uses' => 'businessTypeController@data', 'as' => 'businesstypes.getData']);

Route::resource('maintenance/buildingtypes','buildingTypeController');
Route::put('maintenance/buildingtypes/softdelete/{buildingType}',['uses' => 'buildingTypeController@softDelete', 'as' => 'buildingtypes.softdelete']);
Route::get('maintenance/buildingtypes/get/data', ['uses' => 'buildingTypeController@data', 'as' => 'buildingtypes.getData']);

Route::resource("utilities","utilitiesController");