<?php

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

//映画
Route::get('/', 'CinemasController@index');
Route::get('cinema/', 'CinemasController@index');
Route::get('cinema/home', 'CinemasController@home');
Route::get('cinema/movie/{movie_id}', 'CinemasController@show_movie');
Route::get('cinema/person/{person_id}', 'CinemasController@show_person');
Route::get('cinema/company/{company_id}', 'CinemasController@show_company');
Route::get('cinema/user/{user_id}', 'CinemasController@show_user');
Route::get('cinema/search_movie', 'CinemasController@search_movie');
Route::get('cinema/search_person', 'CinemasController@search_person');
Route::get('cinema/search_user', 'CinemasController@search_user');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
