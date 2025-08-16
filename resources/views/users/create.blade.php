@extends('layouts.app')
@section('title','Add User')
@section('content')
<form method="POST" action="{{ route('users.store') }}" class="col-lg-6">@csrf
  <x-input name="name" />
  <x-input name="email" type="email" />
  <x-input name="password" type="password" />
  <label class="form-label mt-2">Role</label>
  <select name="role" class="form-select">
    @foreach(['Admin','Staff','Doctor','Patient'] as $r)<option>{{ $r }}</option>@endforeach
  </select>
  <label class="form-label mt-2">Department (optional)</label>
  <select name="department_id" class="form-select">
    <option value="">—</option>
    @foreach($departments as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach
  </select>
  <button class="btn btn-primary mt-2">Save</button>
</form>
@endsection

