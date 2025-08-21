<!DOCTYPE html>
<html>
<head>
    <title>Appointments Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Appointments Report</h1>
    @if($from || $to)
        <p>Period: {{ $from ?? 'Start' }} to {{ $to ?? 'End' }}</p>
    @endif
    
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->scheduled_at ? substr($appointment->scheduled_at, 0, 16) : 'N/A' }}</td>
                <td>{{ $appointment->patient?->name ?? 'N/A' }}</td>
                <td>{{ $appointment->doctor?->name ?? 'N/A' }}</td>
                <td>{{ ucfirst($appointment->status ?? 'pending') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>