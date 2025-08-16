@extends('layouts.app')
@section('title','New Prescription')
@section('content')
<form method="POST" action="{{ route('prescriptions.store') }}" class="col-lg-8">@csrf
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Medical Record</label>
      <select name="medical_record_id" class="form-select">
        @foreach($medical_records as $mr)
          <option value="{{ $mr->id }}">#{{ $mr->id }} — {{ $mr->patient->full_name }} ({{ $mr->visit_date->format('Y-m-d') }})</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6"><x-input name="prescribed_on" type="date" /></div>
  </div>
  <hr>
  <div id="items">
    <div class="row g-2 mb-2">
      <div class="col-md-4"><input name="items[0][drug_name]" class="form-control" placeholder="Drug name"></div>
      <div class="col-md-2"><input name="items[0][dosage]" class="form-control" placeholder="Dosage"></div>
      <div class="col-md-3"><input name="items[0][frequency]" class="form-control" placeholder="Frequency"></div>
      <div class="col-md-2"><input name="items[0][days]" type="number" min="1" class="form-control" placeholder="Days"></div>
      <div class="col-md-1 d-grid"><button type="button" class="btn btn-outline-secondary" onclick="addItem()">+</button></div>
    </div>
  </div>
  <button class="btn btn-primary mt-2">Save</button>
</form>
<script>
let idx=1;
function addItem(){
  const row=document.createElement('div'); row.className='row g-2 mb-2';
  row.innerHTML=`
    <div class="col-md-4"><input name="items[${idx}][drug_name]" class="form-control" placeholder="Drug name"></div>
    <div class="col-md-2"><input name="items[${idx}][dosage]" class="form-control" placeholder="Dosage"></div>
    <div class="col-md-3"><input name="items[${idx}][frequency]" class="form-control" placeholder="Frequency"></div>
    <div class="col-md-2"><input name="items[${idx}][days]" type="number" min="1" class="form-control" placeholder="Days"></div>
    <div class="col-md-1 d-grid"><button type="button" class="btn btn-outline-danger" onclick="this.closest('.row').remove()">−</button></div>`;
  document.getElementById('items').appendChild(row); idx++;
}
</script>
@endsection
