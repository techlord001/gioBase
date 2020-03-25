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

/********** Artists Routes **********/
Route::get('/artists', 'ArtistController@index')->name('artists.index');
Route::get('/artists/create', 'ArtistController@create')->name('artists.create');
Route::post('/artists', 'ArtistController@store')->name('artists.store');
Route::get('/artists/{artist}', 'ArtistController@show')->name('artists.show');
Route::get('/artists/{artist}/edit', 'ArtistController@edit')->name('artists.edit');
Route::patch('/artists/{artist}', 'ArtistController@update')->name('artists.update');
Route::delete('/artists/{artist}', 'ArtistController@destroy')->name('artists.destroy');

/********** Records Routes **********/
Route::get('/records', 'RecordController@index')->name('records.index');
Route::get('/records/create', 'RecordController@create')->name('records.create');
Route::post('/records', 'RecordController@store')->name('records.store');
Route::get('/records/{record}', 'RecordController@show')->name('records.show');
Route::get('/records/{record}/edit', 'RecordController@edit')->name('records.edit');
Route::patch('/records/{record}', 'RecordController@update')->name('records.update');
Route::delete('/records/{record}', 'RecordController@destroy')->name('records.destroy');