@extends('layouts.app')
@section('title','Patient Details')
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{ $patient->full_name }}</h5>
    <p class="mb-1"><strong>Gender:</strong> {{ $patient->gender ?? '—' }}</p>
    <p class="mb-1"><strong>DOB:</strong> {{ $patient->date_of_birth ?? '—' }}</p>
    <p class="mb-1"><strong>Contact:</strong> {{ $patient->contact_number ?? '—' }}</p>
    <p class="mb-1"><strong>Email:</strong> {{ $patient->email ?? '—' }}</p>
    <p class="mb-0"><strong>Address:</strong> {{ $patient->address ?? '—' }}</p>
  </div>
</div>
@endsection
