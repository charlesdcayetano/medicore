@extends('layouts.app')
@section('title','Record')
@section('content')
<div class="card"><div class="card-body">
  <div><strong>Date:</strong> {{ $medical_record->visit_date }}</div>
  <div><strong>Patient:</strong> {{ $medical_record->patient->full_name }}</div>
  <div><strong>Doctor:</strong> {{ $medical_record->doctor->name }}</div>
  <div><strong>Diagnosis:</strong> {{ $medical_record->diagnosis ?? '—' }}</div>
  <div class="mt-2"><strong>Treatment:</strong><br>{{ $medical_record->treatment ?? '—' }}</div>
  <div class="mt-2"><strong>Notes:</strong><br>{{ $medical_record->notes ?? '—' }}</div>
  <hr>
  <a href="{{ route('prescriptions.create') }}" class="btn btn-sm btn-outline-primary">Create Prescription</a>
</div></div>
@endsection
