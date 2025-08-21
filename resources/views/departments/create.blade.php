@extends('layouts.app')
@section('title', 'Create Appointment')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4>Create New Appointment</h4>
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                
                {{-- Dropdown for Patients --}}
                <div class="form-group mb-3">
                    <label for="patient_id">Patient</label>
                    <select name="patient_id" id="patient_id" class="form-control">
                        <option value="">Select a Patient</option>
                        @foreach($patients as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown for Doctors --}}
                <div class="form-group mb-3">
                    <label for="doctor_id">Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-control">
                        <option value="">Select a Doctor</option>
                        @foreach($doctors as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- This is the Department dropdown --}}
                <div class="form-group mb-3">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">Select a Department</option>
                        @foreach($departments as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown for Rooms --}}
                <div class="form-group mb-3">
                    <label for="room_id">Room</label>
                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">Select a Room</option>
                        @foreach($rooms as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Appointment</button>
            </form>
        </div>
    </div>
</div>
@endsection