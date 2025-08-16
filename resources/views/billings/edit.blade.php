@extends('layouts.app')
@section('title','Edit Billing')
@section('content')
<form method="POST" action="{{ route('billings.update',$billing) }}" class="col-lg-10">@csrf @method('PUT')
  @include('billings.create', ['patients'=>$patients,'appointments'=>$appointments])
</form>
@endsection

