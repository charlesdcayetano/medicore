<?php

namespace App\Http\Controllers;

use App\Models\{Prescription,PrescriptionItem,MedicalRecord};
use App\Http\Requests\StorePrescriptionRequest;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
  public function index(){
    $prescriptions=Prescription::with('medicalRecord.patient')->orderBy('prescribed_on','desc')->paginate(10);
    return view('prescriptions.index',compact('prescriptions'));
  }
  public function create(){ return view('prescriptions.create',['medical_records'=>MedicalRecord::with('patient')->orderBy('visit_date','desc')->get()]); }
  public function store(StorePrescriptionRequest $r){
    DB::transaction(function() use($r){
      $p=Prescription::create($r->only('medical_record_id','prescribed_on'));
      foreach(($r->input('items')??[]) as $it){
        if(!empty($it['drug_name'])){
          PrescriptionItem::create($it+['prescription_id'=>$p->id]);
        }
      }
    });
    return to_route('prescriptions.index')->with('success','Prescription created.');
  }
  public function show(Prescription $prescription){ $prescription->load('medicalRecord.patient','items'); return view('prescriptions.show',compact('prescription')); }
  public function edit(Prescription $prescription){ $prescription->load('items'); return view('prescriptions.edit',['prescription'=>$prescription,'medical_records'=>MedicalRecord::with('patient')->get()]); }
  public function update(StorePrescriptionRequest $r, Prescription $prescription){
    DB::transaction(function() use($r,$prescription){
      $prescription->update($r->only('medical_record_id','prescribed_on'));
      $prescription->items()->delete();
      foreach(($r->input('items')??[]) as $it){
        if(!empty($it['drug_name'])) $prescription->items()->create($it);
      }
    });
    return to_route('prescriptions.show',$prescription)->with('success','Prescription updated.');
  }
  public function destroy(Prescription $prescription){ $prescription->delete(); return back()->with('success','Prescription deleted.'); }
}
