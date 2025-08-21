<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Billing;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        // Get some basic statistics for the homepage
        $stats = [
            'total_patients' => Patient::count(),
            'total_appointments' => Appointment::count(),
            'total_medicines' => Medicine::count(),
            'total_revenue' => Billing::where('status', 'Paid')->sum('total_amount'),
        ];

        return view('home', compact('stats'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display the services page
     */
    public function services()
    {
        return view('services');
    }
}
