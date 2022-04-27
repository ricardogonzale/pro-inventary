<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('app');
});

Auth::routes();
Route::view('/autentication','app')->name('autentication');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/newClient', 'HomeController@registrarCliente')->name('newClient');
Route::post('/updateClient', 'HomeController@updateCliente')->name('updateClient');
Route::post('/deleteClient', 'HomeController@deleteCliente')->name('deleteClient');

Route::get('getState', 'GeoStateController@list')->name('State.list');


Route::get('getClientlist', 'ClientController@list')->name('cliente.list');
Route::get('getClientshow/{id}', 'ClientController@show')->name('cliente.show');
Route::get('getUserinfo', 'APIController@getUserinfo')->name('API.Userinfo');

Route::get('getCompanylist', 'CompanyController@list')->name('company.list');
Route::get('getCompanyshow/{id}', 'CompanyController@show')->name('company.show');
Route::post('/newCompany', 'CompanyController@create')->name('newCompany');
Route::post('/updateCompany', 'CompanyController@update')->name('updateCompany');
Route::post('/deleteCompany', 'CompanyController@destroy')->name('deleteCompany');