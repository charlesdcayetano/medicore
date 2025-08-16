@extends('layouts.app')
@section('title','Appointment')
@section('content')
<div class="card"><div class="card-body">
  <div><strong>Date/Time:</strong> {{ $appointment->scheduled_at }}</div>
  <div><strong>Patient:</strong> {{ $appointment->patient->full_name }}</div>
  <div><strong>Doctor:</strong> {{ $appointment->doctor->name }}</div>
  <div><strong>Department:</strong> {{ $appointment->department->name }}</div>
  <div><strong>Room:</strong> {{ $appointment->room?->number ?? '—' }}</div>
  <div><strong>Status:</strong> {{ $appointment->status }}</div>
  <div class="mt-2"><strong>Notes:</strong><br>{{ $appointment->notes ?? '—' }}</div>
</div></div>
@endsection
