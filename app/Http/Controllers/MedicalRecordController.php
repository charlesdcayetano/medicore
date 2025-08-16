<?php

namespace App\Http\Controllers;

use App\Models\{MedicalRecord,Patient,User};
use App\Http\Requests\StoreMedicalRecordRequest;

class MedicalRecordController extends Controller
{
  public function index(){
    $q=MedicalRecord::with(['patient','doctor']);
    if($pid=request('patient_id')) $q->where('patient_id',$pid);
    $records=$q->orderBy('visit_date','desc')->paginate(10);
    return view('medical_records.index',compact('records'));
  }
  public function create(){
    return view('medical_records.create',[
      'patients'=>Patient::orderBy('last_name')->get(),
      'doctors'=>User::where('role','Doctor')->orderBy('name')->get(),
    ]);
  }
  public function store(StoreMedicalRecordRequest $r){ $mr=MedicalRecord::create($r->validated()); return to_route('medical-records.show',$mr)->with('success','Record created.'); }
  public function show(MedicalRecord $medical_record){ $medical_record->load(['patient','doctor','prescriptions.items']); return view('medical_records.show',compact('medical_record')); }
  public function edit(MedicalRecord $medical_record){
    return view('medical_records.edit',[
      'medical_record'=>$medical_record,
      'patients'=>Patient::orderBy('last_name')->get(),
      'doctors'=>User::where('role','Doctor')->orderBy('name')->get(),
    ]);
  }
  public function update(StoreMedicalRecordRequest $r, MedicalRecord $medical_record){ $medical_record->update($r->validated()); return to_route('medical-records.show',$medical_record)->with('success','Record updated.'); }
  public function destroy(MedicalRecord $medical_record){ $medical_record->delete(); return back()->with('success','Record deleted.'); }
}
