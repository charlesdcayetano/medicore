<!DOCTYPE html>
<html>
<head>
    <title>Inventory Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .low-stock { background-color: #ffebee; }
    </style>
</head>
<body>
    <h1>Medicine Inventory Report</h1>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Min Level</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
            <tr class="{{ $medicine->quantity <= $medicine->min_level ? 'low-stock' : '' }}">
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->category ?? 'N/A' }}</td>
                <td>{{ $medicine->quantity }}</td>
                <td>{{ $medicine->min_level }}</td>
                <td>{{ $medicine->expiry_date ? substr($medicine->expiry_date, 0, 10) : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>