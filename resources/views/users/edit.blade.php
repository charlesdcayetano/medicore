@extends('layouts.app')
@section('title','Edit User')
@section('content')
<form method="POST" action="{{ route('users.update',$user) }}" class="col-lg-6">@csrf @method('PUT')
  <x-input name="name" :value="$user->name" />
  <x-input name="email" type="email" :value="$user->email" />
  <x-input name="password" type="password" />
  <label class="form-label mt-2">Role</label>
  <select name="role" class="form-select">
    @foreach(['Admin','Staff','Doctor','Patient'] as $r)
      <option @selected($user->role===$r)>{{ $r }}</option>
    @endforeach
  </select>
  <label class="form-label mt-2">Department</label>
  <select name="department_id" class="form-select">
    <option value="">—</option>
    @foreach($departments as $d)
      <option value="{{ $d->id }}" @selected($user->department_id===$d->id)>{{ $d->name }}</option>
    @endforeach
  </select>
  <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection

