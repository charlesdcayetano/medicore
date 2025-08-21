<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentsExport;
use App\Models\Medicine;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function appointmentsExcel(Request $request)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $timestamp = date('Y') . date('m') . date('d') . '_' . date('H') . date('i') . date('s');
        $filename = 'appointments_' . $timestamp . '.xlsx';

        try {
            return Excel::download(new AppointmentsExport($request->from, $request->to), $filename);
        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function appointmentsView(Request $request)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');

        $query = Appointment::with(['patient', 'doctor']);
        
        if ($from) {
            $query = $query->whereDate('scheduled_at', '>=', $from);
        }
        
        if ($to) {
            $query = $query->whereDate('scheduled_at', '<=', $to);
        }
        
        $appointments = $query->orderBy('scheduled_at', 'desc')->get();

        return view('reports.appointments', [
            'appointments' => $appointments,
            'from' => $from,
            'to' => $to
        ]);
    }

    public function inventoryView()
    {
        $medicines = Medicine::orderBy('name')->get();

        return view('reports.inventory', ['medicines' => $medicines]);
    }

    public function index()
    {
        return view('reports.index');
    }
}