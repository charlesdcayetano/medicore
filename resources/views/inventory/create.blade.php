@extends('layouts.app')
@section('title','Add Item')
@section('content')
<form method="POST" action="{{ route('inventory.store') }}" class="col-lg-6">@csrf
  <x-input name="name" />
  <x-input name="sku" />
  <x-input name="stock" type="number" />
  <x-input name="unit_price" type="number" step="0.01" />
  <x-input name="expires_at" type="date" />
  <button class="btn btn-primary mt-2">Save</button>
</form>
@endsection
