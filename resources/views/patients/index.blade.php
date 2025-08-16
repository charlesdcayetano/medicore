@extends('layouts.app')
@section('title','Patients')
@section('content')
<div class="fade-in">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h2 mb-1">
        <i class="fas fa-user-injured text-primary me-2"></i>
        Patients
      </h1>
      <p class="text-muted mb-0">Manage patient information and records</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
      <i class="fas fa-user-plus me-2"></i>
      Add Patient
    </a>
  </div>

  <!-- Search and Filters -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" class="row g-3">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-primary text-white">
              <i class="fas fa-search"></i>
            </span>
            <input type="text" name="q" class="form-control" placeholder="Search by name, email, or contact number" value="{{ request('q') }}">
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
          <button type="submit" class="btn btn-accent w-100">
            <i class="fas fa-filter me-2"></i>
            Filter
          </button>
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
          <div class="stats-number">{{ $patients->total() }}</div>
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
          <div class="stats-number">{{ $patients->where('gender', 'Male')->count() }}</div>
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
          <div class="stats-number">{{ $patients->where('gender', 'Female')->count() }}</div>
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
          <div class="stats-number">{{ $patients->where('created_at', '>=', now()->subDays(30))->count() }}</div>
          <div class="stats-label">New This Month</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Patients Table -->
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <i class="fas fa-list me-2"></i>
        Patient List
      </h5>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th class="text-center">
                <i class="fas fa-user me-2"></i>Name
              </th>
              <th class="text-center">
                <i class="fas fa-venus-mars me-2"></i>Gender
              </th>
              <th class="text-center">
                <i class="fas fa-phone me-2"></i>Contact
              </th>
              <th class="text-center">
                <i class="fas fa-envelope me-2"></i>Email
              </th>
              <th class="text-center">
                <i class="fas fa-calendar me-2"></i>Registered
              </th>
              <th class="text-center">
                <i class="fas fa-cogs me-2"></i>Actions
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($patients as $patient)
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar-circle me-3">
                    <i class="fas fa-user text-primary"></i>
                  </div>
                  <div>
                    <div class="fw-bold">{{ $patient->full_name }}</div>
                    <small class="text-muted">ID: {{ $patient->id }}</small>
                  </div>
                </div>
              </td>
              <td class="text-center">
                @if($patient->gender)
                  <span class="badge bg-{{ $patient->gender == 'Male' ? 'primary' : ($patient->gender == 'Female' ? 'success' : 'secondary') }}">
                    {{ $patient->gender }}
                  </span>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td class="text-center">
                @if($patient->contact_number)
                  <a href="tel:{{ $patient->contact_number }}" class="text-decoration-none">
                    <i class="fas fa-phone me-1"></i>{{ $patient->contact_number }}
                  </a>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td class="text-center">
                @if($patient->email)
                  <a href="mailto:{{ $patient->email }}" class="text-decoration-none">
                    <i class="fas fa-envelope me-1"></i>{{ $patient->email }}
                  </a>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td class="text-center">
                <small class="text-muted">
                  {{ $patient->created_at->format('M j, Y') }}
                </small>
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  <a class="btn btn-sm btn-outline-info" href="{{ route('patients.show', $patient) }}" title="View Details">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a class="btn btn-sm btn-outline-primary" href="{{ route('patients.edit', $patient) }}" title="Edit Patient">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form class="d-inline" method="POST" action="{{ route('patients.destroy', $patient) }}" onsubmit="return confirm('Are you sure you want to delete this patient?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Delete Patient">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <div class="text-muted">
                  <i class="fas fa-user-slash fa-3x mb-3"></i>
                  <div class="fw-bold">No patients found</div>
                  <small>Start by adding your first patient</small>
                </div>
              </td>
            </tr>
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

<style>
.avatar-circle {
  width: 40px;
  height: 40px;
  background: rgba(76, 175, 80, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid rgba(76, 175, 80, 0.3);
}

.btn-group .btn {
  margin: 0 2px;
}

.btn-group .btn:hover {
  transform: translateY(-1px);
}
</style>
@endsection
