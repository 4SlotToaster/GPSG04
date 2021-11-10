<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome');
Route::get('/signin', 'AuthController@signin');
Route::get('/signout', 'AuthController@signout');
Route::get('/callback', 'AuthController@callback');
Route::get('/calendar', 'CalendarController@calendar');


Route::get('/appointment/', function (){
    return view('appointments',[
        'appointments' => Appointment::all()
    ]);
});
Route::get('/appointment/{appointment}', function ($id){
    return view('appointment',[
        'appointment' => Appointment::findOrFail($id)
    ]);
});
