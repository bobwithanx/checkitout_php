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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'MainController@dashboard');
Route::get('/reports', 'MainController@reports');

Route::resource('students', 'StudentController');
Route::resource('resources', 'ResourceController');
Route::resource('categories', 'CategoryController');

Route::post('/students/search', 'StudentController@searchStudent');

Route::post('/students/import', 'StudentController@import');
Route::post('/resources/import', 'ResourceController@import');
Route::post('/students/{students}/borrow', 'StudentController@borrowItem');
Route::post('/students/{students}/return', 'StudentController@returnItem');

Route::get('/admin', 'AdminController@index');
