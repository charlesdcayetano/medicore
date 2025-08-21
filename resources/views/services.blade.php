<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - MediCore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-heartbeat me-2"></i>MediCore
            </a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('home') }}">Back to Home</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-5">Our Services</h1>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="fas fa-user-injured fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Patient Management</h5>
                        <p class="card-text">Comprehensive patient records management including medical history, contact information, and appointment scheduling.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="fas fa-calendar-check fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Appointment Scheduling</h5>
                        <p class="card-text">Efficient appointment booking system with reminders and calendar integration.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="fas fa-pills fa-2x text-info mb-3"></i>
                        <h5 class="card-title">Medicine Inventory</h5>
                        <p class="card-text">Track medicine stock levels, expiry dates, and manage pharmaceutical inventory.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="fas fa-file-invoice-dollar fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Billing & Reports</h5>
                        <p class="card-text">Generate invoices, track payments, and create comprehensive financial reports.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
