@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="fade-in">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">
      <i class="fas fa-tachometer-alt text-primary me-2"></i>
      Dashboard
    </h1>
    <div class="text-muted">
      <i class="fas fa-calendar-alt me-1"></i>
      {{ now()->format('l, F j, Y') }}
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
      <div class="card stats-card h-100">
        <div class="card-body text-center">
          <div class="stats-icon mb-3">
            <i class="fas fa-user-injured fa-2x text-primary"></i>
          </div>
          <div class="stats-number">{{ $patientCount }}</div>
          <div class="stats-label">Total Patients</div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card stats-card h-100">
        <div class="card-body text-center">
          <div class="stats-icon mb-3">
            <i class="fas fa-calendar-check fa-2x text-accent"></i>
          </div>
          <div class="stats-number">{{ $todayAppts }}</div>
          <div class="stats-label">Today's Appointments</div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card stats-card h-100">
        <div class="card-body text-center">
          <div class="stats-icon mb-3">
            <i class="fas fa-bed fa-2x text-success"></i>
          </div>
          <div class="stats-number">{{ $roomsAvailable }}</div>
          <div class="stats-label">Available Rooms</div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card stats-card h-100">
        <div class="card-body text-center">
          <div class="stats-icon mb-3">
            <i class="fas fa-file-invoice-dollar fa-2x text-warning"></i>
          </div>
          <div class="stats-number">{{ $unpaidBills }}</div>
          <div class="stats-label">Unpaid Bills</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions Section -->
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="fas fa-bolt me-2"></i>
            Quick Actions
          </h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-3 col-sm-6">
              <a href="{{ route('patients.create') }}" class="btn btn-primary w-100">
                <i class="fas fa-user-plus me-2"></i>
                New Patient
              </a>
            </div>
            <div class="col-md-3 col-sm-6">
              <a href="{{ route('appointments.create') }}" class="btn btn-accent w-100">
                <i class="fas fa-calendar-plus me-2"></i>
                New Appointment
              </a>
            </div>
            <div class="col-md-3 col-sm-6">
              <a href="{{ route('medical-records.create') }}" class="btn btn-success w-100">
                <i class="fas fa-notes-medical me-2"></i>
                Medical Record
              </a>
            </div>
            <div class="col-md-3 col-sm-6">
              <a href="{{ route('billings.create') }}" class="btn btn-warning w-100">
                <i class="fas fa-receipt me-2"></i>
                New Bill
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Activity Section -->
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="fas fa-clock me-2"></i>
            Recent Appointments
          </h5>
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-center text-muted py-4">
            <i class="fas fa-calendar-day fa-3x me-3"></i>
            <div>
              <div class="fw-bold">No recent appointments</div>
              <small>Appointments will appear here</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="fas fa-bell me-2"></i>
            System Notifications
          </h5>
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-center text-muted py-4">
            <i class="fas fa-check-circle fa-3x text-success me-3"></i>
            <div>
              <div class="fw-bold">All systems operational</div>
              <small>No pending notifications</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
