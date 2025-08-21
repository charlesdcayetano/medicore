@extends('layouts.app')
@section('content')
<h1 class="h4 mb-3">Bulk Import</h1>
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<form method="POST" action="{{ route('import.upload') }}" enctype="multipart/form-data" class="card p-3">
  @csrf
  <div class="mb-3">
    <label class="form-label">Entity</label>
    <select name="entity" class="form-select" required>
      <option value="patients">Patients</option>
      <option value="users">Users</option>
      <option value="medicines">Medicines</option>
    </select>
    <div class="form-text">
      Download template:
      <a href="{{ route('import.template','patients') }}">patients.csv</a> ·
      <a href="{{ route('import.template','users') }}">users.csv</a> ·
      <a href="{{ route('import.template','medicines') }}">medicines.csv</a>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">File</label>
    <input type="file" name="file" class="form-control" accept=".csv,.xls,.xlsx" required>
  </div>
  <button class="btn btn-primary">Upload</button>
</form>
@endsection
