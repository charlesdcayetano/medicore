@extends('layouts.app')
@section('content')
<h1 class="h4 mb-3">Notifications</h1>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="list-group">
@foreach($notifications as $n)
  @php $data = $n->data; @endphp
  <div class="list-group-item d-flex justify-content-between align-items-start {{ is_null($n->read_at) ? 'bg-light' : '' }}">
    <div class="ms-2 me-auto">
      <div class="fw-bold">{{ $data['title'] ?? ucfirst($data['type'] ?? 'notification') }}</div>
      <div class="small">{{ $data['message'] ?? '' }}</div>
      <div class="text-muted small">Priority: {{ $data['priority'] ?? 'low' }} · {{ $n->created_at->diffForHumans() }}</div>
    </div>
    <div class="btn-group">
      @if(is_null($n->read_at))
      <form action="{{ route('notifications.read',$n->id) }}" method="POST">@csrf
        <button class="btn btn-sm btn-outline-primary">Mark read</button>
      </form>
      @endif
      <form action="{{ route('notifications.destroy',$n->id) }}" method="POST" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger">Delete</button>
      </form>
    </div>
  </div>
@endforeach
</div>

<div class="mt-3">{{ $notifications->links() }}</div>

@can('Admin')
<form class="mt-4" method="POST" action="{{ route('notifications.broadcast') }}">
  @csrf
  <h5>System Broadcast (Admin)</h5>
  <input class="form-control mb-2" name="title" placeholder="Title" required>
  <textarea class="form-control mb-2" name="message" rows="3" placeholder="Message" required></textarea>
  <select class="form-select mb-2" name="priority" required>
    <option value="low">low</option><option value="medium">medium</option>
    <option value="high">high</option><option value="urgent">urgent</option>
  </select>
  <button class="btn btn-primary">Send Broadcast</button>
</form>
@endcan
@endsection
