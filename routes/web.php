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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::get('/user/edit/{id}', 'UserController@edit')->name('edit');
Route::post('/user/update/{id}', 'UserController@update')->name('update');
Route::delete('/user/delete/{id}', 'UserController@destroy')->name('delete');
Route::get('/user/unverify/{id}', 'UserController@unverify')->name('unverify');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/terms/show', 'TermsController@show')->name('terms/show');
Route::get('/terms/add', 'TermsController@add')->name('terms/add');
Route::post('/terms/create', 'TermsController@create')->name('terms/create');
Route::get('/terms/publish/{id}', 'TermsController@publish')->name('terms/publish');
Route::get('/terms/edit/{id}', 'TermsController@edit')->name('terms/edit');
Route::post('/terms/update/{id}', 'TermsController@update')->name('terms/update');
Route::get('/terms/delete/{id}', 'TermsController@delete')->name('terms/delete');
