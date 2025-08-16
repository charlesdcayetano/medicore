<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;

class DepartmentController extends Controller
{
  public function index(){
    $q = Department::query();
    if($s=request('q')) $q->where('name','like',"%$s%")->orWhere('code','like',"%$s%");
    $departments=$q->orderBy('name')->paginate(10);
    return view('departments.index',compact('departments'));
  }
  public function create(){ return view('departments.create'); }
  public function store(StoreDepartmentRequest $r){ Department::create($r->validated()); return to_route('departments.index')->with('success','Department created.'); }
  public function show(Department $department){ return view('departments.show',compact('department')); }
  public function edit(Department $department){ return view('departments.edit',compact('department')); }
  public function update(StoreDepartmentRequest $r, Department $department){ $department->update($r->validated()); return to_route('departments.index')->with('success','Department updated.'); }
  public function destroy(Department $department){ $department->delete(); return back()->with('success','Department deleted.'); }
}
