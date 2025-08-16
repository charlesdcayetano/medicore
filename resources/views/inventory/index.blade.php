@extends('layouts.app')
@section('title','Pharmacy Inventory')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Inventory</h4>
  <a href="{{ route('inventory.create') }}" class="btn btn-primary btn-sm">Add</a>
</div>
<form class="row g-2 mb-3">
  <div class="col-sm-6"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name/SKU"></div>
  <div class="col-sm-2"><button class="btn btn-outline-secondary w-100">Search</button></div>
</form>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Name</th><th>SKU</th><th>Stock</th><th>Unit Price</th><th>Expires</th><th></th></tr></thead>
<tbody>@foreach($items as $i)
<tr>
  <td>{{ $i->name }}</td>
  <td>{{ $i->sku }}</td>
  <td>{{ $i->stock }}</td>
  <td>{{ number_format($i->unit_price,2) }}</td>
  <td>{{ $i->expires_at ?? '—' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-info" href="{{ route('inventory.show',$i) }}">View</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('inventory.edit',$i) }}">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('inventory.destroy',$i) }}">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>
  </td>
</tr>
@endforeach</tbody></table></div>
{{ $items->links() }}
@endsection
