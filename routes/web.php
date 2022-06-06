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

Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
//Route::get('/pdf', ['as' => '/pdf', 'uses' => 'HomeController@pdf']);
Route::get('/pdf/corridas/{date}/{nacionalidad}', ['as' => '/pdf/corridas/{date}/{nacionalidad}', 'uses' => 'HomeController@pdfCorridas']);
///Login///
Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
Route::get('/restablecer-contrasena', ['as' => 'restablecer-contrasena', 'uses' => 'LoginController@index']);
Route::get('/nueva-contrasena/{token?}', ['as' => '/nueva-contrasena', 'uses' => 'LoginController@index']);

//Reservaciones//
Route::get('/reservaciones/alta', ['as' => '/reservaciones/alta', 'uses' => 'HomeController@index']);
Route::get('/reservaciones/editar/{id}', ['as' => '/reservaciones/alta', 'uses' => 'HomeController@index']);
Route::get('/reservaciones/lista', ['as' => '/reservaciones/lista', 'uses' => 'HomeController@index']);

// Customers
Route::get('/contacts', ['as' => 'contacts', 'uses' => 'HomeController@index']);
Route::get('/contacts/profile/{id}', ['as' => 'contacts', 'uses' => 'HomeController@index']);

// Users
Route::get('/users', ['as' => '/users', 'uses' => 'HomeController@index']);
Route::get('/users/create', ['as' => '/users/create', 'uses' => 'HomeController@index']);
Route::get('/users/edit/{id}', ['as' => '/users/edit', 'uses' => 'HomeController@index']);

// Profile
Route::get('/users/profile/{id?}', ['as' => 'perfilUsuario', 'uses' => 'HomeController@index']);

// Permissions
Route::get('users/permissions/{id}', ['as' => '/users/permissions', 'uses' => 'HomeController@index']);

//Dashboard
Route::get('/error', ['as' => '/error', 'uses' => 'HomeController@index']);
Route::get('/error/notfound', ['as' => '/error/notfound', 'uses' => 'HomeController@index']);
Route::get('/error/notauthorized', ['as' => '/error/notauthorized', 'uses' => 'HomeController@index']);

//Vendors
Route::get('/vendors', ['as' => 'vendors', 'uses' => 'HomeController@index']);
Route::get('/vendors/list', ['as' => 'vendors/list', 'uses' => 'HomeController@index']);
Route::get('/vendors/create', ['as' => 'vendors/create', 'uses' => 'HomeController@index']);
Route::get('/vendors/edit/{id}', ['as' => 'vendors/edit', 'uses' => 'HomeController@index']);
Route::get('/vendors/contacts/{id}', ['as' => 'vendors/contacts', 'uses' => 'HomeController@index']);
Route::get('/vendors/contacts/{id}/create', ['as' => 'vendors/contacts/create', 'uses' => 'HomeController@index']);
Route::get('/vendors/contacts/{id}/edit/{contactId}', ['as' => 'vendors/contacts/edit', 'uses' => 'HomeController@index']);
Route::get('vendors/profile/{id}', ['as' => 'profile', 'uses' => 'HomeController@index']);

//Reportes
Route::get('/reportes/corridas', ['as' => 'vendors', 'uses' => 'HomeController@index']);

//Cases
Route::get('/cases/history/{id_case}', ['as' => 'vendors', 'uses' => 'HomeController@index']);

//Dashboard
Route::get('/overview', ['as' => '/overview', 'uses' => 'HomeController@index']);