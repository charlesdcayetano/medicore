@extends('layouts.app')
@section('title','Room')
@section('content')
<div class="card"><div class="card-body">
  <h5>Room {{ $room->number }}</h5>
  <div>Type: {{ $room->type }}</div>
  <div>Status: {{ $room->is_available? 'Available':'Not Available' }}</div>
</div></div>
@endsection
