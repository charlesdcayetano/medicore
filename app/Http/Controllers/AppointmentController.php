<?php

namespace App\Http\Controllers;

use App\Models\{Appointment, Patient, User, Department, Room};
use App\Http\Requests\StoreAppointmentRequest;
use App\Exports\AppointmentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentController extends Controller
{
    public function index()
    {
        $q = Appointment::with(['patient', 'doctor', 'department', 'room']);

        if ($d = request('date')) {
            $q->whereDate('scheduled_at', $d);
        }

        $appointments = $q->orderBy('scheduled_at', 'desc')->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create', [
            'patients'    => Patient::orderBy('last_name')->get(),
            'doctors'     => User::where('role', 'Doctor')->orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
            'rooms'       => Room::orderBy('number')->get(),
        ]);
    }

    public function store(StoreAppointmentRequest $r)
    {
        Appointment::create($r->validated());

        return to_route('appointments.index')->with('success', 'Appointment created.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor', 'department', 'room']);

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'patients'    => Patient::orderBy('last_name')->get(),
            'doctors'     => User::where('role', 'Doctor')->orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
            'rooms'       => Room::orderBy('number')->get(),
        ]);
    }

    public function update(StoreAppointmentRequest $r, Appointment $appointment)
    {
        $appointment->update($r->validated());

        return to_route('appointments.index')->with('success', 'Appointment updated.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return back()->with('success', 'Appointment deleted.');
    }

    /**
     * Export appointments to Excel
     */
    public function export(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');

        try {
            $export = new AppointmentsExport($from, $to);
            return Excel::download($export, $export->fileName);
        } catch (\Exception $e) {
            return back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }
}
