<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentCreateRequest;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
        public function index(){
            return view('appointments.index', ['appointments' => Appointment::all()]);
        }

        public function create(AppointmentCreateRequest $request) {
            $validated = $request->validated();
            $validated['ends_at'] = explode("T", $validated['starts_at'])[0] . 'T' . $validated['ends_at'];
            Appointment::query()->create($validated);
            return redirect(route('home'));
        }

        public function show(Appointment $appointment){
            return view('appointments.show', ['appointment' => $appointment]);
        }
}
