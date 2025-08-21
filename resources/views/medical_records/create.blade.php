@extends('layouts.app')

@section('title', isset($medical_record) ? 'Edit Medical Record' : 'Add New Medical Record')

@section('content')
<div class="container">
    <h2>{{ isset($medical_record) ? 'Edit Medical Record' : 'Add New Medical Record' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($medical_record) ? route('medical-records.update', $medical_record) : route('medical-records.store') }}" class="col-lg-8">
        @csrf
        {{-- If the $medical_record object exists, it means we are editing, so we need @method('PUT') --}}
        @if(isset($medical_record))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Patient</label>
                <select name="patient_id" class="form-select">
                    @foreach($patients as $p)
                        {{-- Use 'old' with a fallback to the existing data for editing --}}
                        <option value="{{ $p->id }}" {{ old('patient_id', $medical_record->patient_id ?? '') == $p->id ? 'selected' : '' }}>
                            {{ $p->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Doctor</label>
                <select name="doctor_id" class="form-select">
                    @foreach($doctors as $d)
                        <option value="{{ $d->id }}" {{ old('doctor_id', $medical_record->doctor_id ?? '') == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Visit Date</label>
                <input name="visit_date" type="date" class="form-control" value="{{ old('visit_date', $medical_record->visit_date ?? '') }}" />
            </div>
            <div class="col-md-8">
                <label class="form-label">Diagnosis</label>
                <input name="diagnosis" class="form-control" value="{{ old('diagnosis', $medical_record->diagnosis ?? '') }}" />
            </div>
            <div class="col-12">
                <label class="form-label">Treatment</label>
                <textarea name="treatment" class="form-control">{{ old('treatment', $medical_record->treatment ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes', $medical_record->notes ?? '') }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            {{-- Change the button text based on whether you are editing or creating --}}
            {{ isset($medical_record) ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('medical-records.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
