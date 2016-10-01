<?php

use App\Student;
use App\Resource;
use Illuminate\Http\Request;

// Authentication Routes...

Route::auth();

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MainController@home');

Route::get('/dashboard', 'MainController@dashboard');
Route::get('/reports', 'MainController@reports');

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', 'AdminController@index');

	Route::resource('students', 'StudentController');
	Route::resource('resources', 'ResourceController');
	Route::resource('categories', 'CategoryController');

	Route::get('/loans', 'LoanController@index');
	Route::delete('/loans/{loans}', 'LoanController@destroy');

	Route::post('/students/import', 'StudentController@import');
	Route::post('/resources/import', 'ResourceController@import');
});

Route::get('/students/{students}', 'StudentController@showProfile');
Route::get('/resources/{resources}', 'ResourceController@showProfile');
Route::post('/students/{students}/borrow', 'StudentController@borrowItem');
Route::post('/students/{students}/return', 'StudentController@returnItem');
Route::post('/students/search', 'StudentController@searchStudent');
Route::get('/students/browse', 'StudentController@browse');


Route::get('autocompleteStudent',array('as'=>'autocompleteStudent','uses'=>'StudentController@autocompleteStudent'));
Route::get('autocompleteResource',array('as'=>'autocompleteResource','uses'=>'ResourceController@autocompleteResource'));


