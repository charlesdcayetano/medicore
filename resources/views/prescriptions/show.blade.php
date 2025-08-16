@extends('layouts.app')
@section('title','Prescription')
@section('content')
<div class="card"><div class="card-body">
  <div><strong>Date:</strong> {{ $prescription->prescribed_on }}</div>
  <div><strong>Patient:</strong> {{ $prescription->medicalRecord->patient->full_name }}</div>
  <hr>
  <div class="table-responsive"><table class="table">
    <thead><tr><th>Drug</th><th>Dosage</th><th>Frequency</th><th>Days</th></tr></thead>
    <tbody>@foreach($prescription->items as $it)
      <tr><td>{{ $it->drug_name }}</td><td>{{ $it->dosage }}</td><td>{{ $it->frequency }}</td><td>{{ $it->days }}</td></tr>
    @endforeach</tbody>
  </table></div>
</div></div>
@endsection
