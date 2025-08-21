<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - MediCore</title>
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap 5.3 CDN for grid system -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- MediCore Healthcare Theme CSS -->
    <style>
        /* MediCore Healthcare Theme */
        :root {
            --primary-color: #4CAF50;    /* Light Green */
            --secondary-color: #2E7D32;  /* Dark Green */
            --accent-color: #2196F3;     /* Blue */
            --light-bg: #F5F5F5;         /* Light Gray */
            --white: #FFFFFF;
            --warning: #FFC107;
            --danger: #F44336;
            --success: #4CAF50;
            --info: #2196F3;
            --text-primary: #2E7D32;
            --text-secondary: #666666;
            --border-color: #E0E0E0;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.15);
        }

        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Authentication Pages */
        .auth-body {
            background: linear-gradient(135deg, var(--light-bg) 0%, #E8F5E8 100%);
            min-height: 100vh;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--text-primary);
        }

        .text-primary { color: var(--primary-color) !important; }
        .text-secondary { color: var(--secondary-color) !important; }
        .text-accent { color: var(--accent-color) !important; }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            box-shadow: var(--shadow);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--white) !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-brand:hover {
            color: var(--light-bg) !important;
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--light-bg) !important;
            transform: translateY(-1px);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            background: var(--white);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        /* Utility Classes */
        .text-primary-color {
          color: var(--primary-color);
        }
    </style>
</head>
<body class="auth-body">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
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
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center mb-4 text-primary-color">Contact Us</h1>
                        <p class="lead text-center">Get in touch with our support team</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x text-primary-color mb-3"></i>
                                        <h5 class="text-primary-color">Email</h5>
                                        <p>support@medicore.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-phone fa-2x text-primary-color mb-3"></i>
                                        <h5 class="text-primary-color">Phone</h5>
                                        <p>+63 (9469970406) </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
