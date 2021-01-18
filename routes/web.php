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

Auth::routes();

Route::get('/home', 'PatronController@index')->name('home');
Auth::routes();

Route::get('/home', 'PatronController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::get('patrons', 'PatronController@index')->name('patrons.show');
	Route::get('patrons/{patron}/edit', 'PatronController@edit')->name('patrons.edit');
	Route::put('book-patron/store', 'BookPatronController@store')->name('book-patron.store');
	Route::post('patron/{patron}/update', 'PatronController@update')->name('patrons.update');
	Route::get('patron/{patron}/pay', 'PatronController@pay')->name('patrons.pay');
	Route::get('patrons/{patron}/delete', 'PatronController@destroy')->name('patrons.destroy');
	Route::get('book-patron/{id}/delete', 'BookPatronController@destroy')->name('book-patron.destroy');
	Route::get('patron/{patron_id}/return', 'BookPatronController@destroyAllByPatronId')->name('book-patron.destroy-all');
});

