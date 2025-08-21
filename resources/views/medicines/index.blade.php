@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Medicines</h1>
  <a href="{{ route('medicines.create') }}" class="btn btn-primary">Add Medicine</a>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="fw-bold">Low Stock</div>
        <div class="display-6">{{ $lowStock }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="fw-bold">Expiring (≤30 days)</div>
        <div class="display-6">{{ $expiringSoon }}</div>
      </div>
    </div>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table align-middle">
    <thead><tr>
      <th>Name</th><th>Category</th><th>Qty</th><th>Min</th><th>Expiry</th><th></th>
    </tr></thead>
    <tbody>
      @foreach($medicines as $m)
        <tr class="{{ $m->quantity <= $m->min_level ? 'table-warning' : '' }}">
          <td>{{ $m->name }}</td>
          <td>{{ $m->category }}</td>
          <td>{{ $m->quantity }}</td>
          <td>{{ $m->min_level }}</td>
          <td>{{ optional($m->expiry_date)->format('Y-m-d') }}</td>
          <td class="text-end">
            <a href="{{ route('medicines.edit',$m) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('medicines.destroy',$m) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this medicine?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $medicines->links() }}
@endsection
            </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Bailan District Hospital. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>