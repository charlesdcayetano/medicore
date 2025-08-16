@extends('layouts.app')
@section('title','User')
@section('content')
<div class="card"><div class="card-body">
  <h5>{{ $user->name }}</h5>
  <div>Email: {{ $user->email }}</div>
  <div>Role: {{ $user->role }}</div>
  <div>Department: {{ $user->department?->name ?? '—' }}</div>
</div></div>
@endsection

