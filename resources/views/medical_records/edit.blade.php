@extends('layouts.app')
@section('title','Edit Medical Record')
@section('content')
<form method="POST" action="{{ route('medical-records.update',$medical_record) }}" class="col-lg-8">@csrf @method('PUT')
  @include('medical_records.create', ['patients'=>$patients,'doctors'=>$doctors])
</form>
@endsection
