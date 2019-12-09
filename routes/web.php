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
	return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
	//all routes for projects in 1
	Route::resource('projects', 'ProjectsController');
	//update a task
	Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
	//add a task
	Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
	//edit a project
	Route::get('/projects/{project}/edit', 'ProjectsController@edit');
	//invite a user
	Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');
	//home
	Route::get('/home', 'HomeController@index')->name('home');
});


Auth::routes();


