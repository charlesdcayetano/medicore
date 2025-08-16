@extends('layouts.app')
@section('title','Prescriptions')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Prescriptions</h4>
  <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Date</th><th>Patient</th><th>Items</th><th></th></tr></thead>
<tbody>@foreach($prescriptions as $p)
<tr>
  <td>{{ $p->prescribed_on }}</td>
  <td>{{ $p->medicalRecord->patient->full_name }}</td>
  <td>{{ $p->items()->count() }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('prescriptions.show',$p) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('prescriptions.edit',$p) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('prescriptions.destroy',$p) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $prescriptions->links() }}
@endsection
