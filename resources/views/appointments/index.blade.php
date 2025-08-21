@extends('layouts.app')
@section('title','Appointments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Appointments</h4>
  <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<form class="row g-2 mb-3">
  <div class="col-sm-4"><input class="form-control" type="date" name="date" value="{{ request('date') }}"></div>
  <div class="col-sm-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Date/Time</th><th>Patient</th><th>Doctor</th><th>Dept</th><th>Room</th><th>Status</th><th></th></tr></thead>
<tbody>@foreach($appointments as $a)
<tr>
  <td>{{ $a->scheduled_at }}</td>
  <td>{{ $a->patient->full_name }}</td>
  <td>{{ $a->doctor->name }}</td>
  <td>{{ $a->department->name }}</td>
  <td>{{ $a->room?->number ?? '—' }}</td>
  <td>{{ $a->status }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('appointments.show',$a) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('appointments.edit',$a) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('appointments.destroy',$a) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>

{{ $appointments->links() }}
<a href="{{ route('appointments.export', ['from' => '2025-08-01', 'to' => '2025-08-20']) }}" class="btn btn-success">
    Export to Excel
</a>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[name="date"]');
    dateInput.addEventListener('change', function() {
      // Logic to filter appointments by selected date
      const url = new URL(window.location.href);
      url.searchParams.set('date', this.value);
      window.location.href = url.toString();
    });
  });
@endsection
