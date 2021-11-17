<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome');
Route::get('/signin', 'AuthController@signin');
Route::get('/signout', 'AuthController@signout');
Route::get('/callback', 'AuthController@callback');
Route::get('/calendar', 'CalendarController@calendar');


Route::get('/appointments', 'AppointmentController@index');
Route::get('/appointment/{appointment}', 'AppointmentController@ShowAppointment');
