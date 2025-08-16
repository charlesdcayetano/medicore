@extends('layouts.app')
@section('title','Department')
@section('content')
<div class="card"><div class="card-body">
  <h5>{{ $department->name }}</h5>
  <div>Code: {{ $department->code }}</div>
</div></div>
@endsection
