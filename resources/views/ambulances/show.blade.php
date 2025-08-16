@extends('layouts.app')
@section('title','Ambulance')
@section('content')
<div class="card"><div class="card-body">
  <div><strong>Plate:</strong> {{ $ambulance->plate_number }}</div>
  <div><strong>Status:</strong> {{ $ambulance->status }}</div>
  <div><strong>Driver:</strong> {{ $ambulance->driver_name ?? '—' }}</div>
</div></div>
@endsection

