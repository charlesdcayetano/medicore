@extends('layouts.app')
@section('title','Patients')
@section('content')
<div class="fade-in">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h2 mb-1">
        <i class="fas fa-user-injured text-primary me-2"></i>
        Patients
      </h1>
      <p class="text-muted mb-0">Manage patient information and records</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
      <i class="fas fa-user-plus me-2"></i>Add Patient
    </a>
  </div>

  <!-- Search / Filter -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" class="row g-3">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
            <input type="text" name="q" class="form-control" placeholder="Search by name, email, contact" value="{{ request('q') }}">
          </div>
        </div>
        <div class="col-md-3">
          <select name="gender" class="form-select">
            <option value="">All Genders</option>
            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-accent w-100"><i class="fas fa-filter me-2"></i>Filter</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="stats-icon mb-2">
                    <i class="fas fa-users fa-2x text-primary"></i>
                </div>
                <div class="stats-number">{{ $totalPatients }}</div>
                <div class="stats-label">Total Patients</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="stats-icon mb-2">
                    <i class="fas fa-male fa-2x text-accent"></i>
                </div>
                <div class="stats-number">{{ $malePatients }}</div>
                <div class="stats-label">Male Patients</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="stats-icon mb-2">
                    <i class="fas fa-female fa-2x text-success"></i>
                </div>
                <div class="stats-number">{{ $femalePatients }}</div>
                <div class="stats-label">Female Patients</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="stats-icon mb-2">
                    <i class="fas fa-calendar-plus fa-2x text-warning"></i>
                </div>
                <div class="stats-number">{{ $newThisMonth }}</div>
                <div class="stats-label">New This Month</div>
            </div>
        </div>
    </div>
</div>


  <!-- Patients Table -->
  <div class="card">
    <div class="card-header"><h5><i class="fas fa-list me-2"></i>Patient List</h5></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th class="text-center">Name</th>
              <th class="text-center">Gender</th>
              <th class="text-center">Contact</th>
              <th class="text-center">Email</th>
              <th class="text-center">Registered</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($patients as $patient)
            <tr>
              <td>{{ $patient->full_name }}</td>
              <td class="text-center">
                @if($patient->gender)
                  <span class="badge bg-{{ $patient->gender == 'Male' ? 'primary' : ($patient->gender == 'Female' ? 'success' : 'secondary') }}">
                    {{ $patient->gender }}
                  </span>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td class="text-center">{{ $patient->contact_number ?? '—' }}</td>
              <td class="text-center">{{ $patient->email ?? '—' }}</td>
              <td class="text-center">{{ $patient->created_at->format('M j, Y') }}</td>
              <td class="text-center">
                <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                <form class="d-inline" method="POST" action="{{ route('patients.destroy', $patient) }}" onsubmit="return confirm('Delete this patient?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5">No patients found</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  @if($patients->hasPages())
    <div class="d-flex justify-content-center mt-4">
      {{ $patients->withQueryString()->links() }}
    </div>
  @endif

</div>
@endsection
