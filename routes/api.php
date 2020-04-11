<?php

use Illuminate\Http\Request;


// login and register
Route::post('login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');

Route::group(['middleware' => 'auth:api'], function()
{
	// create task
	Route::get('task/create', 'tasksController@create');
	Route::post('task/create', 'tasksController@store');
	
	// get user task
	Route::post('task','tasksController@index');
	
	// get all users
	Route::get('users','api\UserController@index');
	
});