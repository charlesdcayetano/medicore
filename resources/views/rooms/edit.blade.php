@extends('layouts.app')
@section('title','Edit Room')
@section('content')
<form method="POST" action="{{ route('rooms.update',$room) }}" class="col-lg-6">@csrf @method('PUT')
  <x-input name="number" :value="$room->number" />
  <x-input name="type" :value="$room->type" />
  <div class="form-check mt-2">
    <input class="form-check-input" type="checkbox" name="is_available" value="1" id="available" @checked($room->is_available)>
    <label class="form-check-label" for="available">Available</label>
  </div>
  <button class="btn btn-primary mt-3">Update</button>
</form>
@endsection
