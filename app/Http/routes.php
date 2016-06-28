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

Route::get('/students', 'StudentController@index');
Route::post('/student', 'StudentController@store');
Route::post('/student/{student}/borrow', 'StudentController@borrow');
Route::get('/student/{student}', 'StudentController@show');
Route::delete('/student/{student}', 'StudentController@destroy');

Route::get('/resources', 'ResourceController@index');
Route::post('/resources', 'ResourceController@store');
Route::get('/resource/{resource}', 'ResourceController@show');
// Route::get('/resource/{resource}/edit', 'ResourceController@edit');
// Route::put('/resource/{resource}', 'ResourceController@update');
Route::delete('/resource/{resource}', 'ResourceController@destroy');

Route::get('/admin', 'AdminController@index');
