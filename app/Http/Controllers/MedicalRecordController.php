<?php

namespace App\Http\Controllers;

use App\Models\{MedicalRecord,Patient,User};
use App\Http\Requests\StoreMedicalRecordRequest;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the medical records.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Start a query with eager loading for the patient and doctor relationships.
        $q = MedicalRecord::with(['patient', 'doctor']);

        // Filter by patient ID if a request parameter is present.
        if ($pid = request('patient_id')) {
            $q->where('patient_id', $pid);
        }

        // Order the records by visit date in descending order and paginate the results.
        $records = $q->orderBy('visit_date', 'desc')->paginate(10);

        return view('medical_records.index', compact('records'));
    }

    /**
     * Show the form for creating a new medical record.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get a list of all patients and users with the 'Doctor' role to populate the form dropdowns.
        return view('medical_records.create', [
            'patients' => Patient::orderBy('last_name')->get(),
            'doctors' => User::where('role', 'Doctor')->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created medical record in storage.
     *
     * @param  \App\Http\Requests\StoreMedicalRecordRequest  $r
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMedicalRecordRequest $r)
    {
        // Create a new medical record using the validated data from the request.
        $mr = MedicalRecord::create($r->validated());
        
        return to_route('medical-records.show', $mr)->with('success', 'Record created.');
    }

    /**
     * Display the specified medical record.
     *
     * @param  \App\Models\MedicalRecord  $medical_record
     * @return \Illuminate\View\View
     */
    public function show(MedicalRecord $medical_record)
    {
        // Eager load the patient, doctor, and prescriptions with their items.
        $medical_record->load(['patient', 'doctor', 'prescriptions.items']);
        
        return view('medical_records.show', compact('medical_record'));
    }

    /**
     * Show the form for editing the specified medical record.
     *
     * @param  \App\Models\MedicalRecord  $medical_record
     * @return \Illuminate\View\View
     */
    public function edit(MedicalRecord $medical_record)
    {
        // Get the specific medical record, along with lists of patients and doctors for the form.
        return view('medical_records.edit', [
            'medical_record' => $medical_record,
            'patients' => Patient::orderBy('last_name')->get(),
            'doctors' => User::where('role', 'Doctor')->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified medical record in storage.
     *
     * @param  \App\Http\Requests\StoreMedicalRecordRequest  $r
     * @param  \App\Models\MedicalRecord  $medical_record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreMedicalRecordRequest $r, MedicalRecord $medical_record)
    {
        // Update the medical record with the validated data from the request.
        $medical_record->update($r->validated());
        
        return to_route('medical-records.show', $medical_record)->with('success', 'Record updated.');
    }

    /**
     * Remove the specified medical record from storage.
     *
     * @param  \App\Models\MedicalRecord  $medical_record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MedicalRecord $medical_record)
    {
        $medical_record->delete();
        
        return back()->with('success', 'Record deleted.');
    }
}
