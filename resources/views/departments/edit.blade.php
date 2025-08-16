@extends('layouts.app')
@section('title','Edit Department')
@section('content')
<form method="POST" action="{{ route('departments.update',$department) }}" class="col-lg-6">@csrf @method('PUT')
  <x-input name="name" :value="$department->name" />
  <x-input name="code" :value="$department->code" />
  <button class="btn btn-primary mt-2">Update</button>
</form>
@endsection
