<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Controllers\Controller;


class PatientController extends Controller
{
    public function index(Request $request)
{
    $query = Patient::query();

    // Apply search filter
    if ($search = $request->input('q')) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('contact_number', 'like', "%{$search}%");
        });
    }

    // Apply gender filter only if specified and not "all"
    if ($gender = $request->input('gender')) {
        if (strtolower($gender) != 'all') {
            $query->whereRaw('LOWER(gender) = ?', [strtolower($gender)]);
        }
    }

    // Pagination
    $patients = $query->orderBy('last_name')->paginate(10);

    // Preserve query string manually if needed
    $patients->appends($request->except('page'));

    // Counts for Male/Female (full table counts)
    $malePatients = Patient::whereRaw('LOWER(gender) = ?', ['male'])->count();
    $femalePatients = Patient::whereRaw('LOWER(gender) = ?', ['female'])->count();
    $totalPatients = Patient::count();
    $newThisMonth = Patient::whereMonth('created_at', now()->month)->count();

    return view('patients.index', compact(
        'patients',
        'totalPatients',
        'malePatients',
        'femalePatients',
        'newThisMonth'
    ));
}

  public function create(){ return view('patients.create'); }
  public function store(StorePatientRequest $r){
    Patient::create($r->validated());
    return to_route('patients.index')->with('success','Patient created.');
  }
  public function show(Patient $patient){ return view('patients.show', compact('patient')); }
  public function edit(Patient $patient){ return view('patients.edit', compact('patient')); }
  public function update(StorePatientRequest $r, Patient $patient){
    $patient->update($r->validated());
    return to_route('patients.index')->with('success','Patient updated.');
  }
  public function destroy(Patient $patient){
    $patient->delete();
    return back()->with('success','Patient deleted.');
  }
}
