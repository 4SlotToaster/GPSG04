<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
class AppointmentController extends Controller
{

        public function index(){
            return view('appointments.index',['appointments' => Appointment::all()]);
        }

        public function showAppointment(int $id){
            return view('appointment',[
                'appointment' => Appointment::findOrFail($id)
            ]);
        }
        public function CreateAppointment(){


        }
        public function SaveAppointment(){

        }
}
