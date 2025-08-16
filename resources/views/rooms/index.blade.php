@extends('layouts.app')
@section('title','Rooms')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Rooms</h4>
  <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<div class="table-responsive"><table class="table table-hover">
<thead><tr><th>Number</th><th>Type</th><th>Available</th><th></th></tr></thead>
<tbody>@foreach($rooms as $r)
<tr>
  <td>{{ $r->number }}</td><td>{{ $r->type }}</td><td>{{ $r->is_available ? 'Yes' : 'No' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-primary" href="{{ route('rooms.edit',$r) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('rooms.destroy',$r) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $rooms->links() }}
@endsection
