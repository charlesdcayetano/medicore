<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">MediCore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('medicines.index') }}"><i class="fa fa-capsules"></i> Medicines</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('import.form') }}"><i class="fa fa-file-upload"></i> Import</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="fa fa-bell"></i> Notifications</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('audit.index') }}"><i class="fa fa-clipboard-list"></i> Audit</a></li>
      </ul>
      <span class="navbar-text me-3">{{ auth()->user()->name ?? '' }}</span>
      <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-secondary btn-sm">Logout</button></form>
    </div>
  </div>
</nav>
