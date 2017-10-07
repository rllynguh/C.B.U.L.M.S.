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
Route::view('/','welcome')->middleware('auth');
Route::get('test-manage','maintenanceBuildingController@manageItemAjax');
Route::get('test/floors/{id}',['uses' => 'maintenanceBuildingController@getFloors', 'as' =>'test.getFloors']);
Route::get('test/units/{id}',['uses' => 'maintenanceBuildingController@getUnits', 'as' =>'test.getUnits']);
Route::get('test/parkAreas/{id}',['uses' => 'maintenanceBuildingController@getParkAreas', 'as' =>'test.getParkAreas']);
Route::resource('test','maintenanceBuildingController');



Route::group(['prefix' => 'tenant/'],function(){
	Route::get('/test','mergeUnitsController@index')->name('tenant.test');
	Route::get('/requestUnit','requestUnitsController@index')->name('tenant.requestUnit');
	Route::post('/requestUnit2','requestUnitsController@store')->name('tenant.requestUnitStore');
	Route::get('/TerminateContract','terminateContractController@index')->name('tenant.terminateContract');
	Route::get('/test1','contractAmmendmentController@getUnits')->name('tenant.getUnits');
	Route::view('/','tenant.index')->name('tenant.home');
	Route::get('/login', function () {return view('tenant.login');});
	Route::get('/profile', function () {return view('tenant.profile');});
	Route::get('/soa', function () {return view('tenant.soa');});
	Route::get("/dashboard",function(){return view('tenant.dashboard');});
	Route::resource("registration","registrationController");
	
	Route::resource("/transaction/offerSheetApproval","offerSheetApprovalController");
	Route::get('/transaction/offerSheetApproval/get/data','offerSheetApprovalController@data')->name('offerSheetApproval.getData');
	Route::get('/transaction/offerSheetApproval/get/showData/{id}','offerSheetApprovalController@showData')->name('offerSheetApproval.showData');


	Route::resource("/transaction/registrationForfeit","registrationForfeitController");
	Route::get('/transaction/registrationForfeit/get/data','registrationForfeitController@data')->name('registrationForfeit.getData');
	Route::get('/transaction/registrationForfeit/get/showData/{id}', 'registrationForfeitController@showData')->name('registrationForfeit.showData');

	Route::resource("/transaction/contract","contractViewController");
	Route::get('/transaction/contract/get/data','contractViewController@data')->name('contract.getData');

	Route::get("contract/view",'contractAmmendmentController@index')->name('tenant.contractView');
	Route::get("contract/data",'contractAmmendmentController@data')->name('tenant.contractData');

	Route::get('/docs/reservation-fee-receipt/{id}', ['uses' => 'documentController@reservationFee', 'as' => 'docs.reservation-fee-receipt']);

});


//temporary for when the template is only for admin

Route::group(['prefix' => 'admin/'], function () {
	Route::get('/', function () {
		return view('user.admin.index');
	})->middleware('auth','admin');


	Route::resource('maintenance/banks','bankController');
	Route::get('maintenance/banks/get/data', ['uses' => 'bankController@data', 'as' => 'banks.getData']);
	Route::put('maintenance/banks/softdelete/{bank}', ['uses' => 'bankController@softdelete', 'as' => 'banks.softDelete']);


	Route::resource('maintenance/content','contentController');
	Route::get('maintenance/content/get/data', ['uses' => 'contentController@data', 'as' => 'content.getData']);
	Route::put('maintenance/content/softdelete/{bank}', ['uses' => 'contentController@softdelete', 'as' => 'content.softDelete']);


	Route::resource('maintenance/repr-positions','representativePositionController');
	Route::get('maintenance/repr-positions/get/data', ['uses' => 'representativePositionController@data', 'as' => 'repr-positions.getData']);
	Route::put('maintenance/repr-positions/softdelete/{id}', ['uses' => 'representativePositionController@softdelete', 'as' => 'repr-positions.softDelete']);


	Route::resource('maintenance/businesstypes','businessTypeController');
	Route::put('maintenance/businesstypes/softdelete/{businessType}',['uses' => 'businessTypeController@softDelete', 'as' => 'businesstypes.softdelete']);
	Route::get('maintenance/businesstypes/get/data', ['uses' => 'businessTypeController@data', 'as' => 'businesstypes.getData']);
	Route::get('/maintenance/businesstypes/showRequirements/{id}', ['uses' => 'businessTypeController@showRequirements', 'as' => 'businesstypes.showRequirements']);
	Route::post('maintenance/businesstypes/storeRequirements', ['uses' => 'businessTypeController@storeRequirements', 'as' => 'businesstypes.storeRequirements']);
	Route::get('/maintenance/businesstypes/showCurrentRequirements/{id}', ['uses' => 'businessTypeController@showCurrentRequirements', 'as' => 'businesstypes.showCurrentRequirements']);
	Route::put('maintenance/businesstypes/update/Requirements', ['uses' => 'businessTypeController@updateRequirements', 'as' => 'businesstypes.updateRequirements']);


	Route::resource('maintenance/requirements','requirementController');
	Route::put('maintenance/requirements/softdelete/{id}',['uses' => 'requirementController@softDelete', 'as' => 'requirements.softdelete']);
	Route::get('maintenance/requirements/get/data', ['uses' => 'requirementController@data', 'as' => 'requirements.getData']);

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
	Route::post('maintenance/floors/storePrice', ['uses' => 'floorController@storePrice', 'as' => 'floors.storePrice']);
	Route::get('maintenance/floors/get/price/{id}', ['uses' => 'floorController@getPrice', 'as' => 'floors.getPrice']);


	Route::resource("maintenance/units","unitController");
	Route::post('maintenance/units/get/data', ['uses' => 'unitController@data', 'as' => 'units.getData']);
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

	Route::get("/transaction/unitRequests","registrationApprovalController@unitRequests")->name('unitRequests.index');
	Route::get('/transaction/unitRequests/get/data','registrationApprovalController@data_existing_tenant')->name('unitRequests.getData');

	Route::resource("/transaction/offersheets","offerSheetController");
	Route::get('/transaction/offersheets/get/data', ['uses' => 'offerSheetController@data', 'as' => 'offerSheets.getData']);
	Route::get('/transaction/offersheets/showOptions/{id}', ['uses' => 'offerSheetController@showOptions', 'as' => 'offerSheets.showOptions']);
	Route::post('/transaction/offersheets/get/showData/{id}', ['uses' => 'offerSheetController@showData', 'as' => 'offerSheets.showData']);

	


	Route::resource("/transaction/requirementAssigning","requirementAssigningController");
	Route::get('/transaction/requirementAssigning/get/data', ['uses' => 'requirementAssigningController@data', 'as' => 'requirementAssigning.getData']);
	Route::get('/transaction/requirementAssigning/showRequirements/{id}', ['uses' => 'requirementAssigningController@showRequirements', 'as' => 'requirementAssigning.showRequirements']);
	Route::get('/transaction/requirementAssigning/showCurrentRequirements/{id}', ['uses' => 'requirementAssigningController@showCurrentRequirements', 'as' => 'requirementAssigning.showCurrentRequirements']);
	Route::post('transaction/requirementAssigning/storeRequirements', ['uses' => 'requirementAssigningController@storeRequirements', 'as' => 'requirementAssigning.storeRequirements']);
	Route::put('transaction/requirementAssigning/update/Requirements', ['uses' => 'requirementAssigningController@updateRequirements', 'as' => 'requirementAssigning.updateRequirements']);



	Route::resource("/transaction/requirementValidation","requirementValidationController");
	Route::get('/transaction/requirementValidation/get/data', ['uses' => 'requirementValidationController@data', 'as' => 'requirementValidation.getData']);

	Route::resource("/transaction/contract-create","contractCreationController");
	Route::get('/transaction/contract-create/get/data', ['uses' => 'contractCreationController@data', 'as' => 'contract-create.getData']);

	Route::resource("/transaction/pdcCollection","pdcCollectionController");
	Route::get('/transaction/pdcCollection/get/data', ['uses' => 'pdcCollectionController@data', 'as' => 'pdcCollection.getData']);
	Route::get('/transaction/pdcCollection/updatePDC', ['uses' => 'pdcCollectionController@updatePDC', 'as' => 'pdcCollection.updatePDC']);

	Route::resource("/transaction/pdcValidation","pdcValidationController");
	Route::get('/transaction/pdcValidation/get/data', ['uses' => 'pdcValidationController@data', 'as' => 'pdcValidation.getData']);

	Route::resource("/transaction/reservationFeeCollection","reservationFeeCollectionController");
	Route::get('/transaction/reservationFeeCollection/get/data', ['uses' => 'reservationFeeCollectionController@data', 'as' => 'reservationFeeCollection.getData']);

	Route::resource("/transaction/move-in","moveInController");
	Route::get('/transaction/move-in/get/data', ['uses' => 'moveInController@data', 'as' => 'move-in.getData']);

	Route::resource("/transaction/collection","collectionController");
	Route::get('/transaction/move-collection/get/data', ['uses' => 'collectionController@data', 'as' => 'collection.getData']);

	Route::get('/query/registration', ['uses' => 'registrationQueryController@index', 'as' => 'registrationQuery.index']);
	Route::get('/query/registration/get/data', ['uses' => 'registrationQueryController@data', 'as' => 'registrationQuery.getData']);

	Route::get('/query/offerSheet', ['uses' => 'offerSheetQueryController@index', 'as' => 'offerSheetQuery.index']);
	Route::get('/query/offerSheet/get/data', ['uses' => 'offerSheetQueryController@data', 'as' => 'offerSheetQuery.getData']);
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







