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

Route::post('/newCarrier', 'HomeController@registrarCarrier')->name('newCarrier');
Route::post('/updateCarrier', 'HomeController@updateCarrier')->name('updateCarrier');
Route::post('/deleteCarrier', 'HomeController@deleteCarrier')->name('deleteCarrier');
Route::post('/dataCarrier', 'HomeController@dataCarrier')->name('dataCarrier');

Route::get('getCountry', 'GeoCountryController@list')->name('Country.list');
Route::get('getProvince', 'GeoProvinceController@list')->name('Province.list');
Route::get('getActivity', 'TypeActivityController@list')->name('getActivity.list');
Route::get('getAvailability', 'TypeAvailabilityController@list')->name('getAvailability.list');
Route::get('getTypeVehicle', 'TypeVehicleController@list')->name('getTypeVehicle.list');

Route::get('getClientlist', 'ClientController@list')->name('cliente.list');
Route::get('getClientshow/{id}', 'ClientController@show')->name('cliente.show');
Route::get('getCarrierlist', 'CarrierController@list')->name('carrier.list');
Route::get('getCarriershow/{id}', 'CarrierController@show')->name('carrier.show');
Route::get('getUserinfo', 'APIController@getUserinfo')->name('API.Userinfo');

Route::get('getDriverlist', 'DriverController@list')->name('driver.list');
Route::post('/newDriver', 'DriverController@create')->name('newDriver');
Route::post('/updateDriver', 'DriverController@update')->name('updateDriver');
Route::post('/deleteDriver', 'DriverController@destroy')->name('deleteDriver');
Route::post('/activateDriver', 'DriverController@activate')->name('activateDriver');

Route::get('getVehiclelist', 'VehicleController@list')->name('vehicle.list');
Route::post('/newVehicle', 'VehicleController@create')->name('newVehicle');
Route::post('/updateVehicle', 'VehicleController@edit')->name('updateVehicle');
Route::post('/deleteVehicle', 'VehicleController@destroy')->name('deleteVehicle');
Route::post('/activateVehicle', 'VehicleController@activate')->name('activateVehicle');


Route::get('getCertificationlist', 'CertificationController@list')->name('certification.list');
Route::post('/newCertification', 'CertificationController@create')->name('newCertification');
Route::post('/updateCertification', 'CertificationController@edit')->name('updateCertification');
Route::post('/deleteCertification', 'CertificationController@destroy')->name('deleteCertification');
Route::post('/activateCertification', 'CertificationController@activate')->name('activateCertification');