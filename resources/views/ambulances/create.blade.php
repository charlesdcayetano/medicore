@extends('layouts.app')
@section('title','Add Ambulance')
@section('content')
<form method="POST" action="{{ route('ambulances.store') }}" class="col-lg-6">@csrf
  <x-input name="plate_number" />
  <label class="form-label mt-2">Status</label>
  <select name="status" class="form-select">
    @foreach(['Available','On Duty','Maintenance'] as $s)<option>{{ $s }}</option>@endforeach
  </select>
  <x-input name="driver_name" />
  <button class="btn btn-primary mt-2">Save</button>
</form>
@endsection
