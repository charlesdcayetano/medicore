@extends('layouts.app')
@section('title','Add Patient')
@section('content')
<form method="POST" action="{{ route('patients.store') }}" class="col-lg-8">@csrf
  <div class="row g-3">
    <div class="col-md-6"><x-input name="first_name" /></div>
    <div class="col-md-6"><x-input name="last_name" /></div>
    <div class="col-md-4"><x-input name="date_of_birth" type="date" /></div>
    <div class="col-md-4">
      <label class="form-label">Gender</label>
      <select name="gender" class="form-select">
        <option value="">—</option>
        @foreach(['Male','Female','Other'] as $g)<option value="{{ $g }}">{{ $g }}</option>@endforeach
      </select>
    </div>
    <div class="col-md-4"><x-input name="contact_number" /></div>
    <div class="col-md-6"><x-input name="email" type="email" /></div>
    <div class="col-md-6"><x-input name="emergency_contact" /></div>
    <div class="col-12">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control">{{ old('address') }}</textarea>
    </div>
  </div>
  <button class="btn btn-primary mt-3">Save</button>
</form>
@endsection
