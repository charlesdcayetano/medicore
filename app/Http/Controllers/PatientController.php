<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;

class PatientController extends Controller
{
  public function index(){
    $q = Patient::query();
    if($s=request('q')){
      $q->where(function($x) use($s){
        $x->where('first_name','like',"%$s%")
          ->orWhere('last_name','like',"%$s%")
          ->orWhere('email','like',"%$s%");
      });
    }
    $patients = $q->orderBy('last_name')->paginate(10);
    return view('patients.index', compact('patients'));
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
