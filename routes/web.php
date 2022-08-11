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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
		'register'	=> false,
		'verify'	=> false,
	]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('bookscategories', BookCategoryController::class);
Route::resource('bookkeyword', BookKeywordController::class);

Route::get('category', 'CategoryController@index')->name('category.index');
Route::get('category/data', 'CategoryController@data')->name('category.data');
Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::post('category/save', 'CategoryController@save')->name('category.save');
Route::get('category/change', 'CategoryController@change')->name('category.change');
Route::post('category/update', 'CategoryController@update')->name('category.update');
Route::get('category/delete', 'CategoryController@delete')->name('category.delete');

Route::get('book', 'BookController@index')->name('book.index');
Route::get('book/data', 'BookController@data')->name('book.data');
Route::get('book/create', 'BookController@create')->name('book.create');
Route::post('book/save', 'BookController@save')->name('book.save');
Route::get('book/change', 'BookController@change')->name('book.change');
Route::post('book/update', 'BookController@update')->name('book.update');
Route::get('book/delete', 'BookController@delete')->name('book.delete');