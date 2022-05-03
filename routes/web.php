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
Route::get('getCategories', 'CategoryController@list')->name('Categories.list');

Route::get('getClientlist', 'ClientController@list')->name('cliente.list');
Route::get('getClientshow/{id}', 'ClientController@show')->name('cliente.show');
Route::get('getUserinfo', 'APIController@getUserinfo')->name('API.Userinfo');

Route::get('getCompanylist', 'CompanyController@list')->name('company.list');
Route::get('getCompanyshow/{id}', 'CompanyController@show')->name('company.show');
Route::post('/newCompany', 'CompanyController@create')->name('newCompany');
Route::post('/updateCompany', 'CompanyController@update')->name('updateCompany');
Route::post('/deleteCompany', 'CompanyController@destroy')->name('deleteCompany');

Route::get('getEquipmentlist', 'EquipmentController@list')->name('equipment.list');
Route::get('getEquipmentshow/{id}', 'EquipmentController@show')->name('equipment.show');
Route::post('/newEquipment', 'EquipmentController@create')->name('newEquipment');
Route::post('/updateEquipment', 'EquipmentController@update')->name('updateEquipment');
Route::post('/deleteEquipment', 'EquipmentController@destroy')->name('deleteEquipment');

Route::get('getCategorylist', 'CategoryController@list')->name('category.list');
Route::get('getCategoryshow/{id}', 'CategoryController@show')->name('category.show');
Route::post('/newCategory', 'CategoryController@create')->name('newCategory');
Route::post('/updateCategory', 'CategoryController@update')->name('updateCategory');
Route::post('/deleteCategory', 'CategoryController@destroy')->name('deleteCategory');

Route::get('getDivisionlist', 'DivisionController@list')->name('division.list');
Route::get('getDivisionshow/{id}', 'DivisionController@show')->name('division.show');
Route::post('/newDivision', 'DivisionController@create')->name('newDivision');
Route::post('/updateDivision', 'DivisionController@update')->name('updateDivision');
Route::post('/deleteDivision', 'DivisionController@destroy')->name('deleteDivision');

Route::get('getBranchlist', 'BranchController@list')->name('branch.list');
Route::get('getBranchshow/{id}', 'BranchController@show')->name('branch.show');
Route::post('/newBranch', 'BranchController@create')->name('newBranch');
Route::post('/updateBranch', 'BranchController@update')->name('updateBranch');
Route::post('/deleteBranch', 'BranchController@destroy')->name('deleteBranch');