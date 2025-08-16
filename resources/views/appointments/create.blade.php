@extends('layouts.app')
@section('title','New Appointment')
@section('content')
<form method="POST" action="{{ route('appointments.store') }}" class="col-lg-8">@csrf
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Patient</label>
      <select name="patient_id" class="form-select">@foreach($patients as $p)
        <option value="{{ $p->id }}">{{ $p->full_name }}</option>
      @endforeach</select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Doctor</label>
      <select name="doctor_id" class="form-select">@foreach($doctors as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach</select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Department</label>
      <select name="department_id" class="form-select">@foreach($departments as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach</select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Room</label>
      <select name="room_id" class="form-select">
        <option value="">—</option>
        @foreach($rooms as $r) <option value="{{ $r->id }}">{{ $r->number }} ({{ $r->type }})</option> @endforeach
      </select>
    </div>
    <div class="col-md-4"><x-input name="scheduled_at" type="datetime-local" /></div>
    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">@foreach(['Pending','Confirmed','Completed','Cancelled'] as $s)<option>{{ $s }}</option>@endforeach</select>
    </div>
    <div class="col-12">
      <label class="form-label">Notes</label>
      <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
    </div>
  </div>
  <button class="btn btn-primary mt-3">Save</button>
</form>
@endsection
