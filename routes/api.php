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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

//Reservaciones
Route::group([
    //'middleware' => ['jwt.auth'],
    'prefix' => 'v1/reservas'
], function () {
    Route::post('/', 'ReservacionesController@store');
    Route::put('/put/{clave}', 'ReservacionesController@update');
    Route::get('/{fecha}', 'ReservacionesController@find');
    Route::get('/info/{id}', 'ReservacionesController@findReserva');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/users'
], function () {
    // User
    Route::get('/current', 'UsersController@getCurrentUser');
    Route::get('/get', 'UsersController@getUsers');
    Route::get('/getByVendorId/{id}', 'UsersController@getByVendorId');
    Route::get('/get/{userId}', 'UsersController@get');
    Route::post('/create', 'UsersController@post');
    Route::put('/put/{userId}', 'UsersController@put');
    Route::get('/delete/{id}', 'UsersController@deleteUsers');
    Route::get('/vendors/{vendorId}/list', 'UsersController@getUsersVendors');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/users/permission'
], function () {
    // Permissions
    Route::get('/moudules', 'UsersPermisionController@getModules');
    Route::get('/{id_user}', 'UsersPermisionController@permissionUsers');
    Route::get('/{id_user}/{name_module}', 'UsersPermisionController@permissionUserByModule');
    Route::put('/put', 'UsersPermisionController@updatePermission');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1'
], function () {
    //AUTH
    Route::post('/auth/logout', 'AuthUserController@logout');
    Route::post('/auth/refresh', 'AuthUserController@refreshToken');
    Route::get('/auth/logout', 'AuthUserController@logout');
    Route::get('/me', 'AuthUserController@me');

    // Profile
    Route::get('/users/get-profile/{id}', 'UsersController@getUserProfile');
    
    // Notes
    Route::get('/notes/user/get/{id_user}/{entity?}', 'NotesController@getNotesUser');
    Route::post('/notes/user/save', 'NotesController@saveNotesUser');

    // Countries
    Route::get('/countries/get', 'NationsController@getCountries');
    Route::get('/states/get/{id_country}', 'NationsController@getStates');
    Route::get('/citys/get/{id_state}', 'NationsController@getCitys');
});

//Customers
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/customer/'
], function () {
    
    Route::post('create', 'CustomerController@updateOrCreateCustomer');
    Route::put('update/{id_customer}', 'CustomerController@updateOrCreateCustomer');
    Route::get('get/list/{id_provider}', 'CustomerController@getListCustomer');
    Route::get('get/{id_customer}', 'CustomerController@getCustomer');
    Route::delete('delete/{id_customer}', 'CustomerController@deleteCustomer');
});

//Corridas
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/corridas/'
], function () {
    
    Route::post('/find/date', 'CorridasController@getCorridas');
});


//Cases
Route::group([

    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/cases/'

], function () {

    Route::get('get/{id_case}', 'CaseController@getCase');
    Route::post('create', 'CaseController@updateOrCreateCase');
    Route::get('get/vendor/{id_vendor}', 'CaseController@getListVendor');
    Route::put('update/{id_case}', 'CaseController@updateOrCreateCase');
    Route::put('{id}/status/{status}', 'CaseController@updateStatus');
});

//Cases History
Route::group([

    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/cases/history/'

], function () {
    
    Route::get('get/{id_case}', 'CasesHistoryController@getList');
    Route::post('create', 'CasesHistoryController@updateOrCreateCase');
    Route::put('update/{id_case_history}', 'CasesHistoryController@updateOrCreateCase');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/profile'
], function () {
    // Profiles
    Route::get('/{id}', 'ProfilesController@getProfile');
    Route::get('/bycontact/{id}', 'ProfilesController@getProfileByContactId');
    Route::post('/create', 'ProfilesController@post');
    Route::put('/update/{id}', 'ProfilesController@put');
    Route::get('/type/{type}', 'ProfilesController@getProfiles');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/contact'
], function () {
    // Contactos
    Route::get('/{id}', 'ContactsController@getContact');
    Route::post('/create', 'ContactsController@post');
    Route::put('/update/{id}', 'ContactsController@put');
    Route::get('/vendors/{id_vendor}', 'ContactsController@getListContactsVendor');
    Route::put('/block/{id}/{status}', 'ContactsController@putBlock');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/address'
], function () {
    // Dirección
    Route::get('/{id}', 'AddressController@getAddress');
    Route::post('/create', 'AddressController@post');
    Route::put('/update/{id}', 'AddressController@put');
});

Route::group([
    'middleware' => [],
    'prefix' => 'v1'
], function () {
    Route::post('/auth/login', 'AuthUserController@login');
    Route::post('/users/restore-password', 'UsersController@restorePassword');
    Route::get('/users/get-token-password/{token?}', 'UsersController@getTokenPassword');
    Route::put('/users/update-password/{token?}', 'UsersController@updatePassword');
});

// Contacts Vendors
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/contactsvendors'
], function () {
    Route::get('/vendorId/{id}', 'ContactsVendorsController@getContactsByVendorId');
    Route::post('/create', 'ContactsVendorsController@post');
});

// Vendors
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/vendors'
], function () {
    Route::get('/get', 'VendorsController@getList');
    Route::get('/get/{id}', 'VendorsController@getVendor');
    Route::post('/create', 'VendorsController@post');
    Route::delete('/delete/{id}', 'VendorsController@delete');
});

// Hoteles
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/hotels'
], function () {
    Route::get('/get', 'HotelsController@get');
    Route::get('/find/{clave}', 'HotelsController@find');
});

// Tours
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/tours'
], function () {
    Route::get('/get', 'ToursController@get');
    Route::get('/find/{clave}', 'ToursController@find');
});

// Clientes
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'v1/clientes'
], function () {
    Route::get('/get', 'ClientesController@get');
    Route::get('/find/{clave}', 'ClientesController@find');
});