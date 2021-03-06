<?php

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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/contacts', 'PagesController@contacts');


Route::get('/users/{age}/{id}', function($age, $id){
    return 'This is user '. $age . ' with an id of ' . $id;  
});

Route::resource('students', 'StudentsController');
Route::get('/students/{id}/restore', 'StudentsController@reactivate');
Route::post('/students/{id}/restore', 'StudentsController@reactivate');
Route::post('students/update', 'StudentsController@update')->name('students.update');

Route::get('students/destroy/{id}', 'StudentsController@destroy');

Route::match(['delete'],'/students/{id}/remove', 'StudentsController@permanentDelete');

Route::get('/print-pdf', 'StudentsController@print');

Route::get('/export-excel', 'StudentsController@export');

Route::get('/generate-word', 'StudentsController@generateDocx');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/daterange', 'DateRangeController@index');
Route::post('/daterange/fetch_data', 'DateRangeController@fetch_data')->name('daterange.fetch_data');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
