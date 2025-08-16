@extends('layouts.app')
@section('title','Add Room')
@section('content')
<form method="POST" action="{{ route('rooms.store') }}" class="col-lg-6">@csrf
  <x-input name="number" />
  <x-input name="type" />
  <div class="form-check mt-2">
    <input class="form-check-input" type="checkbox" name="is_available" value="1" id="available" checked>
    <label class="form-check-label" for="available">Available</label>
  </div>
  <button class="btn btn-primary mt-3">Save</button>
</form>
@endsection

