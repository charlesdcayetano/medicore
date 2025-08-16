@extends('layouts.app')
@section('title','Departments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Departments</h4>
  <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<form class="row g-2 mb-3">
  <div class="col-sm-6"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name/code"></div>
  <div class="col-sm-2"><button class="btn btn-outline-secondary w-100">Search</button></div>
</form>
<div class="table-responsive">
<table class="table table-hover">
<thead><tr><th>Name</th><th>Code</th><th></th></tr></thead>
<tbody>@foreach($departments as $d)
<tr>
  <td>{{ $d->name }}</td>
  <td>{{ $d->code }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-primary" href="{{ route('departments.edit',$d) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('departments.destroy',$d) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $departments->links() }}
@endsection
