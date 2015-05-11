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
Route::get('cinema/', 'CinemasController@index');
Route::get('cinema/home', 'CinemasController@home');
Route::get('cinema/movie/{movie_id}', 'CinemasController@show_movie');
Route::get('cinema/person/{person_id}', 'CinemasController@show_person');
Route::get('cinema/company/{company_id}', 'CinemasController@show_company');
Route::get('cinema/user/{user_id}', 'CinemasController@show_user');
Route::get('cinema/search_movie', 'CinemasController@search_movie');
Route::get('cinema/search_person', 'CinemasController@search_person');
Route::get('cinema/search_user', 'CinemasController@search_user');

//堀田ITスクール
Route::get('home', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');

Route::get('/', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
Route::get('articles', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
Route::get('articles/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);
Route::get('articles/{id}', ['as' => 'articles.show', 'uses' => 'ArticlesController@show']);
Route::post('articles', ['as' => 'articles.store', 'uses' => 'ArticlesController@store']);
Route::get('articles/{id}/edit', ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
Route::patch('articles/{id}', ['as' => 'articles.update', 'uses' => 'ArticlesController@update']);
Route::delete('articles/{id}', ['as' => 'articles.destroy', 'uses' => 'ArticlesController@destroy']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
