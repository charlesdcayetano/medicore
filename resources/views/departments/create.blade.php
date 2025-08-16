@extends('layouts.app')
@section('title','Add Department')
@section('content')
<form method="POST" action="{{ route('departments.store') }}" class="col-lg-6">@csrf
  <x-input name="name" />
  <x-input name="code" />
  <button class="btn btn-primary mt-2">Save</button>
</form>
@endsection
