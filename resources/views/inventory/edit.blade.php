@extends('layouts.app')
@section('title','Edit Item')
@section('content')
<form method="POST" action="{{ route('inventory.update',$item) }}" class="col-lg-6">@csrf @method('PUT')
  <x-input name="name" :value="$item->name" />
  <x-input name="sku" :value="$item->sku" />
  <x-input name="stock" type="number" :value="$item->stock" />
  <x-input name="unit_price" type="number" step="0.01" :value="$item->unit_price" />
  <x-input name="expires_at" type="date" :value="$item->expires_at" />
  <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection
