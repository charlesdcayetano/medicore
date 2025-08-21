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
<a href="{{ route('appointments.export', ['from' => '2025-08-01', 'to' => '2025-08-20']) }}" class="btn btn-success">
    Export to Excel
</a>
<div class="mt-3">
  <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary">Edit</a>
  <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="d-inline">@csrf @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('Delete this appointment?')">Delete</button>
  </form>
  <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to Appointments</a>
@endsection
