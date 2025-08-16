@extends('layouts.app')
@section('title','Edit Patient')
@section('content')
<form method="POST" action="{{ route('patients.update',$patient) }}" class="col-lg-8">@csrf @method('PUT')
  <div class="row g-3">
    <div class="col-md-6"><x-input name="first_name" :value="$patient->first_name" /></div>
    <div class="col-md-6"><x-input name="last_name" :value="$patient->last_name" /></div>
    <div class="col-md-4"><x-input name="date_of_birth" type="date" :value="$patient->date_of_birth" /></div>
    <div class="col-md-4">
      <label class="form-label">Gender</label>
      <select name="gender" class="form-select">
        <option value="">—</option>
        @foreach(['Male','Female','Other'] as $g)
          <option value="{{ $g }}" @selected($patient->gender===$g)>{{ $g }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4"><x-input name="contact_number" :value="$patient->contact_number" /></div>
    <div class="col-md-6"><x-input name="email" type="email" :value="$patient->email" /></div>
    <div class="col-md-6"><x-input name="emergency_contact" :value="$patient->emergency_contact" /></div>
    <div class="col-12">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control">{{ old('address',$patient->address) }}</textarea>
    </div>
  </div>
  <button class="btn btn-primary mt-3">Update</button>
</form>
@endsection
