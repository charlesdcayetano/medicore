@extends('layouts.app')
@section('title','Users')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Users</h4>
  <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<form class="row g-2 mb-3">
  <div class="col-sm-3">
    <select name="role" class="form-select">
      <option value="">All roles</option>
      @foreach(['Admin','Staff','Doctor','Patient'] as $r)
        <option value="{{ $r }}" @selected(request('role')===$r)>{{ $r }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Department</th><th></th></tr></thead>
<tbody>@foreach($users as $u)
<tr>
  <td>{{ $u->name }}</td>
  <td>{{ $u->email }}</td>
  <td>{{ $u->role }}</td>
  <td>{{ $u->department?->name ?? '—' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('users.show',$u) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit',$u) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('users.destroy',$u) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $users->links() }}
@endsection

