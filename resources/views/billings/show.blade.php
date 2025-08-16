@extends('layouts.app')
@section('title','Billing')
@section('content')
<div class="card"><div class="card-body">
  <div><strong>Bill #:</strong> {{ $billing->id }}</div>
  <div><strong>Patient:</strong> {{ $billing->patient->full_name }}</div>
  <div><strong>Status:</strong> {{ $billing->status }}</div>
  <div><strong>Due:</strong> {{ $billing->due_date ?? '—' }}</div>
  <hr>
  <div class="table-responsive"><table class="table">
    <thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
    <tbody>@foreach($billing->items as $it)
      <tr>
        <td>{{ $it->description }}</td>
        <td>{{ $it->quantity }}</td>
        <td>{{ number_format($it->unit_price,2) }}</td>
        <td>{{ number_format($it->line_total,2) }}</td>
      </tr>
    @endforeach</tbody>
    <tfoot><tr><th colspan="3" class="text-end">Total</th><th>{{ number_format($billing->total_amount,2) }}</th></tr></tfoot>
  </table></div>
</div></div>
@endsection

