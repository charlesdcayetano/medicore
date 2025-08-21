@extends('layouts.app')
@section('content')
<h1 class="h4 mb-3">Dashboard</h1>

<div class="row g-3 mb-4">
  @foreach([['Patients','patients'],['Appointments','appointments'],['Medicines','medicines'],['Revenue','revenue']] as [$label,$key])
    <div class="col-md-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted small">{{ $label }}</div>
          <div class="display-6">{{ $key==='revenue' ? number_format($stats[$key],2) : $stats[$key] }}</div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="row g-3">
  <div class="col-lg-6">
    <div class="card"><div class="card-body">
      <h5>Recent Appointments</h5>
      <ul class="list-group list-group-flush">
        @foreach($recentAppointments as $a)
          <li class="list-group-item small">
            {{ $a->date }} — {{ $a->patient->name ?? '' }} with {{ $a->doctor->name ?? '' }} ({{ $a->status }})
          </li>
        @endforeach
      </ul>
    </div></div>
  </div>
  <div class="col-lg-6">
    <div class="card"><div class="card-body">
      <h5>Latest Notifications</h5>
      <ul class="list-group list-group-flush">
        @foreach($notifications as $n)
          <li class="list-group-item small">{{ $n->data['title'] ?? 'Notification' }} — {{ $n->created_at->diffForHumans() }}</li>
        @endforeach
      </ul>
    </div></div>

    <div class="card mt-3"><div class="card-body">
      <h5>Recent Activity</h5>
      <ul class="list-group list-group-flush">
        @foreach($recentActivities as $log)
          <li class="list-group-item small">{{ $log->created_at }} — {{ $log->description }} by {{ optional($log->causer)->name }}</li>
        @endforeach
      </ul>
    </div></div>
  </div>
</div>
@endsection
