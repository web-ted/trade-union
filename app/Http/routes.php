<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('worker/export', 'WorkerController@export');
Route::get('specialty/export', 'SpecialtyController@export');
Route::get('enterprise/export', 'EnterpriseController@export');

Route::get('worker/max', 'WorkerController@nextRegistrationNumber');
Route::get('report/exportAll', 'ReportController@exportAll');

Route::resource('worker', 'WorkerController');

Route::resource('specialty', 'SpecialtyController');

Route::resource('enterprise', 'EnterpriseController');


Route::get('/', function () {
	include 'index.html';
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//
//});