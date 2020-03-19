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

Route::get('/tasks', 'TaskController@index');
Route::get('/tasks/create', 'TaskController@showCreateForm');
Route::post('/tasks/create', 'TaskController@create');
Route::get('/tasks/edit/{task_id}', 'TaskController@showEditForm');
Route::post('/tasks/edit/{task_id}', 'TaskController@edit');
