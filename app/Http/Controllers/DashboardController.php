<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Medicine;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'patients'      => Patient::count(),
            'appointments'  => Appointment::count(),
            'medicines'     => Medicine::count(),
            'revenue'       => DB::table('billings')->sum('amount'),
        ];

        $recentAppointments = Appointment::with(['patient', 'doctor'])
                                ->latest()
                                ->limit(8)
                                ->get();

        $recentActivities = Activity::latest()->limit(8)->get();

        // Remove notifications entirely or replace with something else
        $notifications = collect(); // Empty collection
        
        // Or replace with recent appointments for the current user
        // $notifications = Appointment::where('doctor_id', auth()->id())
        //                            ->whereDate('scheduled_at', '>=', today())
        //                            ->limit(8)
        //                            ->get();

        return view('dashboard.index', compact(
            'stats',
            'recentAppointments',
            'recentActivities',
            'notifications'
        ));
    }
}