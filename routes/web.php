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

Route::get('/', function () {
    return view('welcome');
});


/********** Labels Routes **********/
Route::get('/labels', 'LabelController@index')->name('labels.index');
Route::get('/labels/create', 'LabelController@create')->name('labels.create');
Route::post('/labels', 'LabelController@store')->name('labels.store');
Route::get('/labels/{label}', 'LabelController@show')->name('labels.show');
Route::get('/labels/{label}/edit', 'LabelController@edit')->name('labels.edit');
Route::patch('/labels/{label}', 'LabelController@update')->name('labels.update');
Route::delete('/labels/{label}', 'LabelController@destroy')->name('labels.destroy');