<?php

namespace App\Http\Controllers;

use App\Models\{Patient,Appointment,Room,Billing};

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard',[
            'patientCount'=>Patient::count(),
            'todayAppts'=>Appointment::whereDate('scheduled_at',now())->count(),
            'roomsAvailable'=>Room::where('is_available',1)->count(),
            'unpaidBills'=>Billing::where('status','Unpaid')->count(),
        ]);
    }
}
