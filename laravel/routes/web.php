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


Auth::routes(['register' =>false]);

Route::get("/login", "Auth\LoginController@showLoginForm")->name("login");
Route::post("/login", "Auth\LoginController@login");
Route::get("/logout", "Auth\LoginController@logout")->name("logout");

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'CompanyController@index')->name('index');
    Route::get('/', 'CompanyController@index')->name('index');

    Route::get("/company", "CompanyController@index")->name('company.index');
    Route::get("/company/deleted", "CompanyController@deleted_company")->name('company.deleted');
    Route::get("/company/list", "CompanyController@index");
    Route::get("/company/show/{company_id}", "CompanyController@show")->name('company.show');
    Route::get("/company/create", "CompanyController@create")->name('company.create');
    Route::post("/company/create", "CompanyController@store")->name('company.store');
    Route::get("/company/edit/{company_id}", "CompanyController@edit")->name('company.edit');
    Route::post("/company/update/{company_id}", "CompanyController@update")->name('company.update');
    Route::get("/company/destroy/{company_id}", "CompanyController@destroy")->name('company.destroy');

    Route::get("/employee/list", "EmployeeController@list");

    Route::get("/employee/show/{employee_id}", "EmployeeController@show")->name('employee.show');
    Route::get("/employee", "EmployeeController@index")->name('employee.index');
    Route::get("/employee/deleted", "EmployeeController@deleted_employee")->name('employee.deleted');
    Route::get("/employee/create", "EmployeeController@create")->name('employee.create');
    Route::post("/employee/create", "EmployeeController@store")->name('employee.store');
    Route::get("/employee/edit/{employee_id}", "EmployeeController@edit")->name('employee.edit');
    Route::post("/employee/update/{employee_id}", "EmployeeController@update")->name('employee.update');
    Route::get("/employee/destroy/{employee_id}", "EmployeeController@destroy")->name('employee.destroy');
});
