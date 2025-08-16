@extends('layouts.app')
@section('title','Item')
@section('content')
<div class="card"><div class="card-body">
  <h5>{{ $item->name }}</h5>
  <div>SKU: {{ $item->sku }}</div>
  <div>Stock: {{ $item->stock }}</div>
  <div>Unit Price: {{ number_format($item->unit_price,2) }}</div>
  <div>Expires: {{ $item->expires_at ?? '—' }}</div>
</div></div>
@endsection
