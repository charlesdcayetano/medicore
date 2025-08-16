<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Http\Requests\StoreAmbulanceRequest;

class AmbulanceController extends Controller
{
  public function index(){ $ambulances=Ambulance::orderBy('plate_number')->paginate(10); return view('ambulances.index',compact('ambulances')); }
  public function create(){ return view('ambulances.create'); }
  public function store(StoreAmbulanceRequest $r){ Ambulance::create($r->validated()); return to_route('ambulances.index')->with('success','Ambulance added.'); }
  public function show(Ambulance $ambulance){ return view('ambulances.show',compact('ambulance')); }
  public function edit(Ambulance $ambulance){ return view('ambulances.edit',compact('ambulance')); }
  public function update(StoreAmbulanceRequest $r, Ambulance $ambulance){ $ambulance->update($r->validated()); return to_route('ambulances.index')->with('success','Ambulance updated.'); }
  public function destroy(Ambulance $ambulance){ $ambulance->delete(); return back()->with('success','Ambulance removed.'); }
}
