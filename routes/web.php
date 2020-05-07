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


/********** Legal Routes **********/
Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
});
Route::get('/terms-conditions', function () {
    return view('legal.terms-conditions');
});

/********** Labels Routes **********/
Route::get('/labels', 'LabelController@index')->name('labels.index');
Route::get('/labels/create', 'LabelController@create')->name('labels.create')->middleware(['auth', 'verified']);
Route::post('/labels', 'LabelController@store')->name('labels.store')->middleware(['auth', 'verified']);
Route::get('/labels/{label}', 'LabelController@show')->name('labels.show');
Route::get('/labels/{label}/edit', 'LabelController@edit')->name('labels.edit')->middleware(['auth', 'verified']);
Route::patch('/labels/{label}', 'LabelController@update')->name('labels.update')->middleware(['auth', 'verified']);
Route::delete('/labels/{label}', 'LabelController@destroy')->name('labels.destroy')->middleware(['auth', 'verified']);

/********** Artists Routes **********/
Route::get('/artists', 'ArtistController@index')->name('artists.index');
Route::get('/artists/create', 'ArtistController@create')->name('artists.create')->middleware(['auth', 'verified']);
Route::post('/artists', 'ArtistController@store')->name('artists.store')->middleware(['auth', 'verified']);
Route::get('/artists/{artist}', 'ArtistController@show')->name('artists.show');
Route::get('/artists/{artist}/edit', 'ArtistController@edit')->name('artists.edit')->middleware(['auth', 'verified']);
Route::patch('/artists/{artist}', 'ArtistController@update')->name('artists.update')->middleware(['auth', 'verified']);
Route::delete('/artists/{artist}', 'ArtistController@destroy')->name('artists.destroy')->middleware(['auth', 'verified']);

/********** Records Routes **********/
Route::get('/records', 'RecordController@index')->name('records.index');
Route::get('/records/create', 'RecordController@create')->name('records.create')->middleware(['auth', 'verified']);
Route::post('/records', 'RecordController@store')->name('records.store')->middleware(['auth', 'verified']);
Route::get('/records/{record}', 'RecordController@show')->name('records.show');
Route::get('/records/{record}/edit', 'RecordController@edit')->name('records.edit')->middleware(['auth', 'verified']);
Route::patch('/records/{record}', 'RecordController@update')->name('records.update')->middleware(['auth', 'verified']);
Route::delete('/records/{record}', 'RecordController@destroy')->name('records.destroy')->middleware(['auth', 'verified']);

/********** Collectors Routes **********/
Route::get('/collectors', 'UserController@index')->name('users.index')->middleware(['auth', 'verified']);
Route::get('/collectors/{user}', 'UserController@show')->name('users.show')->middleware(['auth', 'verified']);
Route::get('/collectors/{user}/edit', 'UserController@edit')->name('users.edit')->middleware(['auth', 'verified']);
Route::patch('/collectors/{user}', 'UserController@update')->name('users.update')->middleware(['auth', 'verified']);
Route::delete('/collectors/{user}', 'UserController@destroy')->name('users.destroy')->middleware(['auth', 'verified']);

/********** Colours Routes **********/
Route::get('/colours', 'ColourController@index')->name('colours.index')->middleware(['auth', 'verified']);
Route::get('/colours/create', 'ColourController@create')->name('colours.create')->middleware(['auth', 'verified']);
Route::post('/colours', 'ColourController@store')->name('colours.store')->middleware(['auth', 'verified']);
Route::get('/colours/{colour}/edit', 'ColourController@edit')->name('colours.edit')->middleware(['auth', 'verified']);
Route::patch('/colours/{colour}', 'ColourController@update')->name('colours.update')->middleware(['auth', 'verified']);
Route::delete('/colours/{colour}', 'ColourController@destroy')->name('colours.destroy')->middleware(['auth', 'verified']);

/********** Formats Routes **********/
Route::get('/formats', 'FormatController@index')->name('formats.index')->middleware(['auth', 'verified']);
Route::get('/formats/create', 'FormatController@create')->name('formats.create')->middleware(['auth', 'verified']);
Route::post('/formats', 'FormatController@store')->name('formats.store')->middleware(['auth', 'verified']);
Route::get('/formats/{format}/edit', 'FormatController@edit')->name('formats.edit')->middleware(['auth', 'verified']);
Route::patch('/formats/{format}', 'FormatController@update')->name('formats.update')->middleware(['auth', 'verified']);
Route::delete('/formats/{format}', 'FormatController@destroy')->name('formats.destroy')->middleware(['auth', 'verified']);

/********** Genres Routes **********/
Route::get('/genres', 'GenreController@index')->name('genres.index');
Route::get('/genres/create', 'GenreController@create')->name('genres.create')->middleware(['auth', 'verified']);
Route::post('/genres', 'GenreController@store')->name('genres.store')->middleware(['auth', 'verified']);
Route::get('/genres/{genre}', 'GenreController@show')->name('genres.show');
Route::get('/genres/{genre}/edit', 'GenreController@edit')->name('genres.edit')->middleware(['auth', 'verified']);
Route::patch('/genres/{genre}', 'GenreController@update')->name('genres.update')->middleware(['auth', 'verified']);
Route::delete('/genres/{genre}', 'GenreController@destroy')->name('genres.destroy')->middleware(['auth', 'verified']);

// Auth::routes();
Auth::routes(['verify' => true]);

/********** Home/Collection/Wishlist Routes **********/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/profile', 'HomeController@profileIndex')->name('collector.profile.index')->middleware(['auth', 'verified']);
Route::get('/home/collection', 'HomeController@collectionIndex')->name('collector.collection.index')->middleware(['auth', 'verified']);
Route::get('/home/wishlist', 'HomeController@wishlistIndex')->name('collector.wishlist.index')->middleware(['auth', 'verified']);
Route::post('/home/collection/{record}', 'HomeController@collectionstore')->name('collector.collection.store')->middleware(['auth', 'verified']);
Route::post('/home/wishlist/{record}', 'HomeController@wishliststore')->name('collector.wishlist.store')->middleware(['auth', 'verified']);
Route::delete('/home/{record}', 'HomeController@destroy')->name('home.destroy')->middleware(['auth', 'verified']);

/********** About Routes **********/
Route::get('/about/faq', 'AboutController@faqIndex')->name('about.faq.index');