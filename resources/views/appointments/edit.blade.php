@extends('layouts.app')
@section('title','Edit Appointment')
@section('content')
<form method="POST" action="{{ route('appointments.update',$appointment) }}" class="col-lg-8">@csrf @method('PUT')
  @include('appointments.create', ['patients'=>$patients,'doctors'=>$doctors,'departments'=>$departments,'rooms'=>$rooms])
</form>
<a href="{{ route('appointments.export', ['from' => '2025-08-01', 'to' => '2025-08-20']) }}" class="btn btn-success">
    Export to Excel
</a>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const patientSelect = document.querySelector('select[name="patient_id"]');
    const doctorSelect = document.querySelector('select[name="doctor_id"]');
    const departmentSelect = document.querySelector('select[name="department_id"]');

    patientSelect.addEventListener('change', function() {
      // Logic to update doctor and department based on selected patient
    });

    doctorSelect.addEventListener('change', function() {
      // Logic to update department based on selected doctor
    });
  });
@endsection
