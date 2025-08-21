@extends('layouts.app')
@section('content')
<h1 class="h4 mb-3">Audit Trail</h1>
<table class="table table-sm">
  <thead><tr><th>When</th><th>User</th><th>Action</th><th>Details</th><th>IP</th></tr></thead>
  <tbody>
  @foreach($logs as $log)
    <tr>
      <td>{{ $log->created_at }}</td>
      <td>{{ optional($log->causer)->name }}</td>
      <td>{{ $log->description }}</td>
      <td><code class="small">{{ json_encode($log->properties) }}</code></td>
      <td>{{ $log->properties['ip'] ?? '' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $logs->links() }}
@endsection
