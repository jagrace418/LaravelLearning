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
    //project dashboard
    Route::get('/projects', 'ProjectsController@index');
    //project create page
    Route::get('/projects/create', 'ProjectsController@create');
    //post a project
    Route::post('/projects', 'ProjectsController@store');
    //add a task
    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
	//update a task
	Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
    //single project view
    Route::get('/projects/{project}', 'ProjectsController@show');
    //home
    Route::get('/home', 'HomeController@index')->name('home');
});


Auth::routes();


