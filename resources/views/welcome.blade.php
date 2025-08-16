<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediCore - Healthcare Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #2E7D32;
            --accent-color: #2196F3;
            --light-bg: #F5F5F5;
            --white: #FFFFFF;
            --text-primary: #2E7D32;
            --text-secondary: #666666;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light-bg) 0%, #E8F5E8 100%);
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            box-shadow: var(--shadow);
        }
        
        .navbar-brand {
            color: var(--white) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .feature-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            border: none;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
        }
        
        .btn-hero {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: none;
            transition: all 0.3s ease;
        }
        
        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .stats-section {
            background: var(--white);
            padding: 4rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 2rem 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer {
            background: var(--secondary-color);
            color: var(--white);
            padding: 3rem 0 1rem;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-heartbeat me-2"></i>
                MediCore
            </a>
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>
                        Dashboard
                    </a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>
                        Login
                    </a>
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content fade-in">
                    <h1 class="hero-title">
                        Modern Healthcare Management
                    </h1>
                    <p class="hero-subtitle">
                        Streamline your medical practice with our comprehensive healthcare management system. 
                        Manage patients, appointments, records, and more with ease.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-hero">
                                <i class="fas fa-arrow-right me-2"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-hero">
                                <i class="fas fa-rocket me-2"></i>
                                Get Started
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-hero">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center fade-in">
                    <i class="fas fa-hospital fa-10x opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="h1 text-primary mb-3">Why Choose MediCore?</h2>
                <p class="text-muted lead">Comprehensive features designed for modern healthcare providers</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <h4 class="text-primary mb-3">Patient Management</h4>
                        <p class="text-muted">
                            Comprehensive patient records with medical history, appointments, and billing information.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4 class="text-primary mb-3">Appointment Scheduling</h4>
                        <p class="text-muted">
                            Efficient appointment management with automated reminders and calendar integration.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <h4 class="text-primary mb-3">Medical Records</h4>
                        <p class="text-muted">
                            Secure digital medical records with easy access and comprehensive documentation.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h4 class="text-primary mb-3">Pharmacy Management</h4>
                        <p class="text-muted">
                            Complete inventory management for medications and medical supplies.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h4 class="text-primary mb-3">Billing & Payments</h4>
                        <p class="text-muted">
                            Streamlined billing system with multiple payment options and financial reporting.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="text-primary mb-3">Analytics & Reports</h4>
                        <p class="text-muted">
                            Detailed insights and reports to optimize your practice performance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 stat-item fade-in">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Patients Served</div>
                </div>
                <div class="col-md-3 stat-item fade-in">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Appointments</div>
                </div>
                <div class="col-md-3 stat-item fade-in">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Medical Staff</div>
                </div>
                <div class="col-md-3 stat-item fade-in">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">
                        <i class="fas fa-heartbeat me-2"></i>
                        MediCore
                    </h5>
                    <p class="mb-3">
                        Empowering healthcare providers with modern, efficient, and secure management solutions.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="mb-3">Quick Links</h6>
                    <div class="d-flex flex-column">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-light text-decoration-none mb-2">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-light text-decoration-none mb-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="text-light text-decoration-none mb-2">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} MediCore. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
