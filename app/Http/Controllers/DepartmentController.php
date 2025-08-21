<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Patient;
use App\Models\User;
use App\Models\Room;

class DepartmentController extends Controller
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Cardiology', 'code' => 'CARD'],
            ['name' => 'Pediatrics', 'code' => 'PEDI'],
            ['name' => 'Emergency', 'code' => 'EMER'],
        ];
        foreach ($departments as $dept) {
            Department::updateOrCreate(['name' => $dept['name']], ['code' => $dept['code']]);
        }
    }
    public function index(){
        $q = Department::query();
        if($s=request('q')) $q->where('name','like',"%$s%")->orWhere('code','like',"%$s%");
        $patients = Patient::pluck('full_name', 'id');
        $departments=$q->orderBy('name')->paginate(10);
        return view('departments.index',compact('departments'));

        foreach ($departments as $dept) {
        Department::updateOrCreate(['name' => $dept]);
}
    }
    public function create()
    {
        // Using pluck() is more efficient as it only retrieves the necessary columns.
        $patients = Patient::pluck('name', 'id');
        $doctors = User::where('role', 'Doctor')->pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $rooms = Room::pluck('name', 'id');

        return view('appointments.create', compact('patients', 'doctors', 'departments', 'rooms'));
    }

    public function store(StoreDepartmentRequest $r){ Department::create($r->validated()); return to_route('departments.index')->with('success','Department created.'); }
    public function show(Department $department){ return view('departments.show',compact('department')); }
    public function edit(Department $department){ return view('departments.edit',compact('department')); }
    public function update(StoreDepartmentRequest $r, Department $department){ $department->update($r->validated()); return to_route('departments.index')->with('success','Department updated.'); }
    public function destroy(Department $department){ $department->delete(); return back()->with('success','Department deleted.'); }
}