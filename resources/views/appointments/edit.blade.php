@extends('layouts.app')
@section('title','Edit Appointment')
@section('content')
<form method="POST" action="{{ route('appointments.update',$appointment) }}" class="col-lg-8">@csrf @method('PUT')
  @include('appointments.create', ['patients'=>$patients,'doctors'=>$doctors,'departments'=>$departments,'rooms'=>$rooms])
</form>
@endsection
