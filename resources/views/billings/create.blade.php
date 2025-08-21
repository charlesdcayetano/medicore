@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($billing) ? 'Edit Billing' : 'Add New Billing' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($billing) ? route('billings.update', $billing) : route('billings.store') }}" method="POST">
        @csrf
        @if(isset($billing))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">-*- Select Patient -*-</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $billing->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                        {{ $patient->last_name }}, {{ $patient->first_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="appointment_id" class="form-label">Appointment</label>
            <select name="appointment_id" id="appointment_id" class="form-control">
                <option value="">-*- Select Appointment -*-</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $billing->appointment_id ?? '') == $appointment->id ? 'selected' : '' }}>
                        {{ $appointment->scheduled_at }} ({{ $appointment->reason ?? 'No Reason' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ old('amount', $billing->total_amount ?? '') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $billing->due_date ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">--Select Status--</option>
                @foreach (\App\Models\Billing::$statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $billing->status ?? '') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($billing) ? 'Update Billing' : 'Save Billing' }}</button>
        <a href="{{ route('billings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
