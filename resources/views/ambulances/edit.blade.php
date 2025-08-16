@extends('layouts.app')
@section('title','Edit Ambulance')
@section('content')
<form method="POST" action="{{ route('ambulances.update',$ambulance) }}" class="col-lg-6">@csrf @method('PUT')
  <x-input name="plate_number" :value="$ambulance->plate_number" />
  <label class="form-label mt-2">Status</label>
  <select name="status" class="form-select">
    @foreach(['Available','On Duty','Maintenance'] as $s)
      <option @selected($ambulance->status===$s)>{{ $s }}</option>
    @endforeach
  </select>
  <x-input name="driver_name" :value="$ambulance->driver_name" />
  <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection

