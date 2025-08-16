@extends('layouts.app')
@section('title','Ambulances')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Ambulances</h4>
  <a href="{{ route('ambulances.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Plate</th><th>Status</th><th>Driver</th><th></th></tr></thead>
<tbody>@foreach($ambulances as $a)
<tr>
  <td>{{ $a->plate_number }}</td>
  <td>{{ $a->status }}</td>
  <td>{{ $a->driver_name ?? '—' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('ambulances.show',$a) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('ambulances.edit',$a) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('ambulances.destroy',$a) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $ambulances->links() }}
@endsection

