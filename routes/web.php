<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('home')->middleware('guest');
Route::get('/signin', 'AuthController@signin');
Route::get('/signout', 'AuthController@signout');
Route::get('/callback', 'AuthController@callback');
Route::get('/calendar', 'CalendarController@calendar');


Route::get('/appointments', 'AppointmentController@index')->name('appointment.index');
Route::get('/appointments/{appointment}', 'AppointmentController@show');

Route::post('/appointments', 'AppointmentController@create')->name('appointment.create');

Route::post('/managers', 'ManagerController@create')->name('manager.create');

Route::post('/visitors', 'VisitorController@create')->name('visitor.create');
