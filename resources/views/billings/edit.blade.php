@extends('layouts.app')

@section('title', 'Edit Billing')

@section('content')
<div class="container">
    <h2>Edit Billing</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('billings.update', $billing) }}" method="POST">
        @csrf
        @method('PUT')

        @include('billings.create', ['billing' => $billing, 'patients' => $patients, 'appointments' => $appointments])

    </form>
</div>
@endsection
