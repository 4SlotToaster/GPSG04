<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome');
Route::get('/signin', 'AuthController@signin');
Route::get('/signout', 'AuthController@signout');
Route::get('/callback', 'AuthController@callback');
Route::get('/calendar', 'CalendarController@calendar');


Route::get('/appointment', 'AppointmentController@index');
Route::get('/appointment/{appointment}', 'AppointmentController@ShowAppointment');
