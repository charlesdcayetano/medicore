@extends('layouts.app')
@section('title','Medical Records')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Medical Records</h4>
  <a href="{{ route('medical-records.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Date</th><th>Patient</th><th>Doctor</th><th>Diagnosis</th><th></th></tr></thead>
<tbody>@foreach($records as $r)
<tr>
  <td>{{ $r->visit_date }}</td>
  <td>{{ $r->patient->full_name }}</td>
  <td>{{ $r->doctor->name }}</td>
  <td>{{ $r->diagnosis ?? '—' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('medical-records.show',$r) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('medical-records.edit',$r) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('medical-records.destroy',$r) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $records->links() }}
@endsection
