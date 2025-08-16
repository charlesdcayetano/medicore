@extends('layouts.app')
@section('title','New Medical Record')
@section('content')
<form method="POST" action="{{ route('medical-records.store') }}" class="col-lg-8">@csrf
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Patient</label>
      <select name="patient_id" class="form-select">@foreach($patients as $p)
        <option value="{{ $p->id }}">{{ $p->full_name }}</option>
      @endforeach</select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Doctor</label>
      <select name="doctor_id" class="form-select">@foreach($doctors as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach</select>
    </div>
    <div class="col-md-4"><x-input name="visit_date" type="date" /></div>
    <div class="col-md-8"><x-input name="diagnosis" /></div>
    <div class="col-12">
      <label class="form-label">Treatment</label>
      <textarea name="treatment" class="form-control">{{ old('treatment') }}</textarea>
    </div>
    <div class="col-12">
      <label class="form-label">Notes</label>
      <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
    </div>
  </div>
  <button class="btn btn-primary mt-3">Save</button>
</form>
@endsection
