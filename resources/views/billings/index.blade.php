@extends('layouts.app')
@section('title','Billing')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Billings</h4>
  <a href="{{ route('billings.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<form class="row g-2 mb-3">
  <div class="col-sm-3">
    <select name="status" class="form-select">
      <option value="">All</option>
      @foreach(['Unpaid','Partially Paid','Paid','Voided'] as $s)
        <option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>#</th><th>Patient</th><th>Total</th><th>Status</th><th>Due</th><th></th></tr></thead>
<tbody>@foreach($bills as $b)
<tr>
  <td>{{ $b->id }}</td>
  <td>{{ $b->patient->full_name }}</td>
  <td>{{ number_format($b->total_amount,2) }}</td>
  <td>{{ $b->status }}</td>
  <td>{{ $b->due_date ?? '—' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('billings.show',$b) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('billings.edit',$b) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('billings.destroy',$b) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $bills->links() }}
@endsection

