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
Route::get('/labels/create', 'LabelController@create')->name('labels.create')->middleware('auth');
Route::post('/labels', 'LabelController@store')->name('labels.store')->middleware('auth');
Route::get('/labels/{label}', 'LabelController@show')->name('labels.show');
Route::get('/labels/{label}/edit', 'LabelController@edit')->name('labels.edit')->middleware('auth');
Route::patch('/labels/{label}', 'LabelController@update')->name('labels.update')->middleware('auth');
Route::delete('/labels/{label}', 'LabelController@destroy')->name('labels.destroy')->middleware('auth');

/********** Artists Routes **********/
Route::get('/artists', 'ArtistController@index')->name('artists.index');
Route::get('/artists/create', 'ArtistController@create')->name('artists.create')->middleware('auth');
Route::post('/artists', 'ArtistController@store')->name('artists.store')->middleware('auth');
Route::get('/artists/{artist}', 'ArtistController@show')->name('artists.show');
Route::get('/artists/{artist}/edit', 'ArtistController@edit')->name('artists.edit')->middleware('auth');
Route::patch('/artists/{artist}', 'ArtistController@update')->name('artists.update')->middleware('auth');
Route::delete('/artists/{artist}', 'ArtistController@destroy')->name('artists.destroy')->middleware('auth');

/********** Records Routes **********/
Route::get('/records', 'RecordController@index')->name('records.index');
Route::get('/records/create', 'RecordController@create')->name('records.create')->middleware('auth');
Route::post('/records', 'RecordController@store')->name('records.store')->middleware('auth');
Route::get('/records/{record}', 'RecordController@show')->name('records.show');
Route::get('/records/{record}/edit', 'RecordController@edit')->name('records.edit')->middleware('auth');
Route::patch('/records/{record}', 'RecordController@update')->name('records.update')->middleware('auth');
Route::delete('/records/{record}', 'RecordController@destroy')->name('records.destroy')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
