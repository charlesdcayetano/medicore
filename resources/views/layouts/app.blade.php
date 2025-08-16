<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediCore — @yield('title','Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <i class="fas fa-heartbeat me-2"></i>
      MediCore
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex align-items-center ms-auto">
      <div class="dropdown me-3">
        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-user-circle me-1"></i>
          {{ auth()->user()->name ?? '' }}
        </button>
        <ul class="dropdown-menu">
          <li>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <aside class="col-lg-2 sidebar p-3">
      <div class="list-group">
        <a class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
           href="{{ route('dashboard') }}">
          <i class="fas fa-tachometer-alt me-2"></i>
          Dashboard
        </a>

        @auth
        @if(in_array(auth()->user()->role,['Admin','Staff']))
          <a class="list-group-item list-group-item-action {{ request()->routeIs('patients.*') ? 'active' : '' }}" 
             href="{{ route('patients.index') }}">
            <i class="fas fa-user-injured me-2"></i>
            Patients
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('appointments.*') ? 'active' : '' }}" 
             href="{{ route('appointments.index') }}">
            <i class="fas fa-calendar-check me-2"></i>
            Appointments
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('billings.*') ? 'active' : '' }}" 
             href="{{ route('billings.index') }}">
            <i class="fas fa-file-invoice-dollar me-2"></i>
            Billing
          </a>
        @endif
        @if(in_array(auth()->user()->role,['Admin','Doctor']))
          <a class="list-group-item list-group-item-action {{ request()->routeIs('medical-records.*') ? 'active' : '' }}" 
             href="{{ route('medical-records.index') }}">
            <i class="fas fa-notes-medical me-2"></i>
            Medical Records
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('prescriptions.*') ? 'active' : '' }}" 
             href="{{ route('prescriptions.index') }}">
            <i class="fas fa-prescription-bottle-medical me-2"></i>
            Prescriptions
          </a>
        @endif
        @if(auth()->user()->role==='Admin')
          <a class="list-group-item list-group-item-action {{ request()->routeIs('departments.*') ? 'active' : '' }}" 
             href="{{ route('departments.index') }}">
            <i class="fas fa-building me-2"></i>
            Departments
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('rooms.*') ? 'active' : '' }}" 
             href="{{ route('rooms.index') }}">
            <i class="fas fa-bed me-2"></i>
            Rooms
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('inventory.*') ? 'active' : '' }}" 
             href="{{ route('inventory.index') }}">
            <i class="fas fa-pills me-2"></i>
            Pharmacy
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('ambulances.*') ? 'active' : '' }}" 
             href="{{ route('ambulances.index') }}">
            <i class="fas fa-ambulance me-2"></i>
            Ambulances
          </a>
          <a class="list-group-item list-group-item-action {{ request()->routeIs('users.*') ? 'active' : '' }}" 
             href="{{ route('users.index') }}">
            <i class="fas fa-users me-2"></i>
            Users
          </a>
        @endif
        @endauth
      </div>
    </aside>
    
    <main class="col-lg-10 p-4">
      @if(session('success')) 
        <div class="alert alert-success fade-in">
          <i class="fas fa-check-circle me-2"></i>
          {{ session('success') }}
        </div> 
      @endif
      
      @if ($errors->any())
        <div class="alert alert-danger fade-in">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <ul class="mb-0">
            @foreach ($errors->all() as $error) 
              <li>{{ $error }}</li> 
            @endforeach
          </ul>
        </div>
      @endif
      
      @yield('content')
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
