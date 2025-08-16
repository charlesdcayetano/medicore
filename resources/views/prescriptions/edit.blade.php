@extends('layouts.app')
@section('title','Edit Prescription')
@section('content')
<form method="POST" action="{{ route('prescriptions.update',$prescription) }}" class="col-lg-8">@csrf @method('PUT')
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Medical Record</label>
      <select name="medical_record_id" class="form-select">
        @foreach($medical_records as $mr)
          <option value="{{ $mr->id }}" @selected($prescription->medical_record_id===$mr->id)>
            #{{ $mr->id }} — {{ $mr->patient->full_name }} ({{ $mr->visit_date->format('Y-m-d') }})
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6"><x-input name="prescribed_on" type="date" :value="$prescription->prescribed_on" /></div>
  </div>
  <hr>
  <div id="items">
    @foreach($prescription->items as $i=>$it)
    <div class="row g-2 mb-2">
      <div class="col-md-4"><input name="items[{{ $i }}][drug_name]" class="form-control" value="{{ $it->drug_name }}"></div>
      <div class="col-md-2"><input name="items[{{ $i }}][dosage]" class="form-control" value="{{ $it->dosage }}"></div>
      <div class="col-md-3"><input name="items[{{ $i }}][frequency]" class="form-control" value="{{ $it->frequency }}"></div>
      <div class="col-md-2"><input name="items[{{ $i }}][days]" type="number" min="1" class="form-control" value="{{ $it->days }}"></div>
      <div class="col-md-1 d-grid"><button type="button" class="btn btn-outline-danger" onclick="this.closest('.row').remove()">−</button></div>
    </div>
    @endforeach
  </div>
  <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection
