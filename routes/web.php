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


Route::group(['prefix' => 'admin/'], function () {
	Route::resource('maintenance/banks','bankController');
	Route::get('maintenance/banks/get/data', ['uses' => 'bankController@data', 'as' => 'banks.getData']);
	Route::put('maintenance/banks/softdelete/{bank}', ['uses' => 'bankController@softdelete', 'as' => 'banks.softDelete']);


	Route::resource('maintenance/repr-positions','representativePositionController');
	Route::get('maintenance/repr-positions/get/data', ['uses' => 'representativePositionController@data', 'as' => 'repr-positions.getData']);
	Route::put('maintenance/repr-positions/softdelete/{id}', ['uses' => 'representativePositionController@softdelete', 'as' => 'repr-positions.softDelete']);


	Route::resource('maintenance/businesstypes','businessTypeController');
	Route::put('maintenance/businesstypes/softdelete/{businessType}',['uses' => 'businessTypeController@softDelete', 'as' => 'businesstypes.softdelete']);
	Route::get('maintenance/businesstypes/get/data', ['uses' => 'businessTypeController@data', 'as' => 'businesstypes.getData']);

	Route::resource('maintenance/buildingtypes','buildingTypeController');
	Route::put('maintenance/buildingtypes/softdelete/{buildingType}',['uses' => 'buildingTypeController@softDelete', 'as' => 'buildingtypes.softdelete']);
	Route::get('maintenance/buildingtypes/get/data', ['uses' => 'buildingTypeController@data', 'as' => 'buildingtypes.getData']);

	Route::resource("utilities","utilitiesController");
	Route::get('utilities/get/data', ['uses' => 'utilitiesController@data', 'as' => 'utilities.getData']);

	Route::resource("maintenance/parkrates","parkRateController");
	Route::get('maintenance/parkrates/get/data', ['uses' => 'parkRateController@data', 'as' => 'parkrates.getData']);

	Route::resource("maintenance/marketrates","marketRateController");
	Route::get('maintenance/marketrates/get/data', ['uses' => 'marketRateController@data', 'as' => 'marketrates.getData']);

	Route::resource("maintenance/parkareas","parkAreaController");
	Route::get('maintenance/parkareas/get/data', ['uses' => 'parkAreaController@data', 'as' => 'parkareas.getData']);
	Route::get('maintenance/parkareas/get/building', ['uses' => 'parkAreaController@getBuilding', 'as' => 'parkareas.getbuilding']);
	Route::get('maintenance/parkareas/getFloor/{floor}', ['uses' => 'parkAreaController@getFloor', 'as' => 'parkareas.getFloor']);
	Route::get('maintenance/parkareas/getLatest/{floor}', ['uses' => 'parkAreaController@getLatest', 'as' => 'parkareas.getLatest']);
	Route::post('maintenance/parkareas/storeSpace', ['uses' => 'parkAreaController@storeSpace', 'as' => 'parkareas.storeSpace']);
	Route::put('maintenance/parkareas/softdelete/{parkarea}',['uses' => 'parkAreaController@softdelete', 'as' => 'parkareas.softdelete']);

	Route::resource("maintenance/parkspaces","parkSpaceController");
	Route::get('maintenance/parkspaces/get/data', ['uses' => 'parkSpaceController@data', 'as' => 'parkspaces.getData']);
	Route::get('maintenance/parkspaces/get/building', ['uses' => 'parkSpaceController@getBuilding', 'as' => 'parkspaces.getBuilding']);
	Route::get('maintenance/parkspaces/getParkArea/{id}', ['uses' => 'parkSpaceController@getParkArea', 'as' => 'parkspaces.getParkArea']);
	Route::get('maintenance/parkspaces/getLatest/{id}', ['uses' => 'parkSpaceController@getLatest', 'as' => 'parkspaces.getLatest']);
	Route::put('maintenance/parkspaces/softdelete/{parkspace}',['uses' => 'parkSpaceController@softdelete', 'as' => 'parkspaces.softdelete']);

	Route::resource("maintenance/buildings","buildingController");
	Route::get('maintenance/buildings/get/data', ['uses' => 'buildingController@data', 'as' => 'buildings.getData']);
	Route::put('maintenance/buildings/softdelete/{building}',['uses' => 'buildingController@softdelete', 'as' => 'buildings.softdelete']);
	Route::post('maintenance/buildings/storefloor',['uses' => 'buildingController@storefloor', 'as' => 'buildings.storefloor']);
	Route::get('maintenance/buildings/getFloor/{floor}',['uses' => 'buildingController@getFloor', 'as' => 'buildings.getfloor']);
	Route::post('maintenance/buildings/storePrice', ['uses' => 'buildingController@storePrice', 'as' => 'buildings.storePrice']);
	

	Route::resource("maintenance/floors","floorController");
	Route::get('maintenance/floors/getFloor/{id}', ['uses' => 'floorController@getFloor', 'as' => 'floors.getFloor']);
	Route::get('maintenance/floors/get/building', ['uses' => 'floorController@getBuilding', 'as' => 'floors.getBuilding']);
	Route::put('maintenance/floors/softdelete/{floor}', ['uses' => 'floorController@softDelete', 'as' => 'floors.softdelete']);
	Route::get('floor/get/data', ['uses' => 'floorController@data', 'as' => 'floors.getData']);
	Route::post('maintenance/floors/storeunit',['uses' => 'floorController@storeUnit', 'as' => 'floor.storeunit']);


	Route::resource("maintenance/units","unitController");
	Route::get('maintenance/units/get/data', ['uses' => 'unitController@data', 'as' => 'units.getData']);
	Route::put('maintenance/units/softdelete/{unit}', ['uses' => 'unitController@softdelete', 'as' => 'units.softdelete']);
	Route::get('maintenance/units/get/building', ['uses' => 'unitController@getBuilding', 'as' => 'units.getBuilding']);
	Route::get('maintenance/units/getFloor/{unit}', ['uses' => 'unitController@getFloor', 'as' => 'units.getFloor']);
	Route::get('maintenance/units/getLatest/{unit}', ['uses' => 'unitController@getLatest', 'as' => 'units.getLatest']);
	Route::post('maintenance/units/{id}/update', ['uses' => 'unitController@updatePOST', 'as' => 'units.updatePOST']);


	Route::resource("/users","userAccountsController");
	Route::get('/users/get/data', ['uses' => 'userAccountsController@data', 'as' => 'users.getData']);
	Route::put('/users/active/{id}', ['uses' => 'userAccountsController@isActive', 'as' => 'users.active']);


	Route::resource("/transaction/registrationApproval","registrationApprovalController");
	Route::get('/transaction/registrationApproval/get/data', ['uses' => 'registrationApprovalController@data', 'as' => 'registrationApproval.getData']);
	Route::get('/transaction/registrationApproval/get/showData/{id}', ['uses' => 'registrationApprovalController@showData', 'as' => 'registrationApproval.showData']);


	Route::resource("/transaction/offersheets","offerSheetController");
	Route::get('/transaction/offersheets/get/data', ['uses' => 'offerSheetController@data', 'as' => 'offerSheets.getData']);
	Route::get('/transaction/offersheets/showOptions/{id}', ['uses' => 'offerSheetController@showOptions', 'as' => 'offerSheets.showOptions']);
	Route::get('/transaction/offersheets/get/showData/{id}', ['uses' => 'offerSheetController@showData', 'as' => 'offerSheets.showData']);


	Route::resource("/transaction/contract-create","contractCreationController");
	Route::get('/transaction/contract-create/get/data', ['uses' => 'contractCreationController@data', 'as' => 'contract-create.getData']);
	Route::get('/transaction/contract-create/get/createData/{id}', ['uses' => 'contractCreationController@createData', 'as' => 'contract-create.createData']);

});





Route::group(['prefix' => 'tenant/'], function () {
	Route::resource("/transaction/offerSheetApproval","offerSheetApprovalController");
	Route::get('/transaction/offerSheetApproval/get/data', ['uses' => 'offerSheetApprovalController@data', 'as' => 'offerSheetApproval.getData']);
	Route::post('/transaction/offerSheetApproval/get/showData/{id}', ['uses' => 'offerSheetApprovalController@showData', 'as' => 'offerSheetApproval.showData']);

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('custom/getCity/{id}', ['uses' => 'customController@getCity', 'as' => 'custom.getCity']);
Route::get('custom/getBuildingType', ['uses' => 'customController@getBuildingType', 'as' => 'custom.getBuildingType']);
Route::get('custom/getProvince', ['uses' => 'customController@getProvince', 'as' => 'custom.getProvince']);
Route::get('custom/getPosition', ['uses' => 'customController@getPosition', 'as' => 'custom.getPosition']);
Route::get('custom/getFloor', ['uses' => 'customController@getFloor', 'as' => 'custom.getFloor']);
Route::get('custom/getRange', ['uses' => 'customController@getRange', 'as' => 'custom.getRange']);
Route::get('custom/getMarketRate/{id}', ['uses' => 'customController@getMarketRate', 'as' => 'custom.getMarketRate']);





Route::resource("registration","registrationController");


