<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCore - Medical Management System</title>
    
    <!-- Import Google Fonts - Poppins for a modern, professional look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap 5.3 CDN for grid system -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS based on the new, modern color theme -->
    <style>
        /* New MediCore Healthcare Theme - Green and Blue Palette */
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
            --dark-text: #1a4d1d; /* New darker text color */
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
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            scroll-behavior: smooth;
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
        
        .hero-title {
            color: var(--dark-text) !important;
        }

        .text-primary-color { color: var(--primary-color) !important; }
        .text-secondary-color { color: var(--secondary-color) !important; }
        .text-accent-color { color: var(--accent-color) !important; }
        .text-warning-color { color: var(--warning) !important; }
        .text-danger-color { color: var(--danger) !important; }
        .text-success-color { color: var(--success) !important; }
        .text-info-color { color: var(--info) !important; }
        .text-dark-text { color: var(--dark-text) !important; }

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
            color: rgba(255, 255, 255, 0.8) !important;
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero-section {
            /* REPLACED with background image */
            background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('https://placehold.co/1200x800/4CAF50/ffffff?text=Bailan+District+Hospital'); /* Semi-transparent white overlay on a placeholder image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: var(--dark-text); /* Changed text color to match the dark text for better contrast on a lighter background */
            padding: 100px 0;
            box-shadow: var(--shadow);
            
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
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--white);
            border: none;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
            border: none;
            text-transform: none;
            letter-spacing: 0.5px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* New button styles for a darker look */
        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--white);
        }
        
        .btn-secondary:hover {
            background-color: #1a4d1d; /* Slightly darker shade of secondary color for hover effect */
        }
        
        .btn-outline-secondary {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: var(--secondary-color);
            color: var(--white);
            border-color: var(--secondary-color);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: var(--white);
        }

        .btn-accent {
            background: var(--accent-color);
            color: var(--white);
        }

        .btn-accent:hover {
            background: #1976D2;
            color: var(--white);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-warning {
            background: var(--warning);
            color: #333;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        /* Dashboard Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--white), #FAFAFA);
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stats-card .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-card .stats-label {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .card-link {
            text-decoration: none;
            color: var(--text-primary);
        }
        
        /* Testimonial Card specific styles */
        .testimonial-card {
            background: var(--white);
        }
        
        .testimonial-card .testimonial-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--primary-color);
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* New animation for "Welcome to MediCore" text */
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Class to apply the new animation */
        .slide-in-text {
            animation: slideInFromLeft 1s ease-out forwards;
            opacity: 0; /* Ensures the text is hidden before the animation starts */
        }
        
        /* Footer Styling */
        .footer {
            background-color: var(--secondary-color) !important;
            color: var(--white);
            padding: 3rem 0;
            box-shadow: inset 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation - Updated color palette and added links to sections -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Updated brand icon and text -->
            <a class="navbar-brand" href="#home">
                <i class="fas fa-heartbeat me-2"></i>MediCore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a> <!-- New link for the Features section -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a> <!-- New link for the Testimonials section -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light px-4" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container text-center">
            <!-- Added the slide-in-text and hero-title class to apply the animation and a darker color -->
            <h1 class="display-4 fw-bold mb-4 slide-in-text hero-title">Welcome to MediCore</h1>
            <p class="lead mb-4">Comprehensive Medical Management System for Healthcare Professionals</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#services" class="btn btn-light btn-lg">Get Started</a>
                <!-- The "Sign In" button now uses the solid btn-secondary class and triggers the login modal -->
                <a href="auth/login.blade.php" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
            </div>
        </div>
    </section>

    <!-- About Section - New Section -->
    <section class="py-5 bg-white" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://placehold.co/600x400/4CAF50/ffffff?text=About+Us" class="img-fluid rounded-3 shadow" alt="About MediCore">
                </div>
                <div class="col-md-6">
                    <h2 class="text-primary-color mb-3">About MediCore</h2>
                    <p class="lead">MediCore is a state-of-the-art medical management system designed to streamline hospital operations, improve patient care, and enhance administrative efficiency.</p>
                    <p>Our platform provides a centralized solution for managing patient records, scheduling appointments, tracking medicine inventory, and generating detailed reports. We are committed to empowering healthcare providers with the tools they need to focus on what matters most: their patients.</p>
                    <a href="#" class="btn btn-primary mt-3">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services Section - New Section -->
    <section class="py-5" id="services">
        <div class="container">
            <h2 class="text-center mb-5 text-primary-color">Our Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-stethoscope fa-3x text-accent-color mb-3"></i>
                            <h5 class="card-title text-primary-color">Clinical Workflow</h5>
                            <p class="card-text text-secondary-color">Digitize and optimize patient check-ins, medical charting, and consultation processes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-file-invoice fa-3x text-success-color mb-3"></i>
                            <h5 class="card-title text-primary-color">Billing & Invoicing</h5>
                            <p class="card-text text-secondary-color">Automate billing, claims processing, and payment tracking with ease.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-shield-alt fa-3x text-info-color mb-3"></i>
                            <h5 class="card-title text-primary-color">Data Security</h5>
                            <p class="card-text text-secondary-color">Protect patient information with secure, compliant, and encrypted data storage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- New Features Section - Uses images for each feature -->
    <section class="py-5 bg-white" id="features">
        <div class="container">
            <h2 class="text-center mb-5 text-dark-text">Key Features</h2>
            <div class="row g-4">
                <!-- Feature 1: Patient Management -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x250/2E7D32/ffffff?text=Patient+Management" class="card-img-top" alt="Patient Management">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary-color">Patient Management</h5>
                            <p class="card-text text-secondary-color">Keep track of patient history, appointments, and medical records in one secure location.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2: Appointment Scheduling -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x250/2196F3/ffffff?text=Appointment+Scheduling" class="card-img-top" alt="Appointment Scheduling">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary-color">Appointment Scheduling</h5>
                            <p class="card-text text-secondary-color">Easily schedule and manage patient appointments with an intuitive calendar.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3: Medicine Inventory -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x250/4CAF50/ffffff?text=Medicine+Inventory" class="card-img-top" alt="Medicine Inventory">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary-color">Medicine Inventory</h5>
                            <p class="card-text text-secondary-color">Monitor and manage your hospital's medicine and supply stock in real time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Testimonials Section - Uses images for profiles -->
    <section class="py-5" id="testimonials">
        <div class="container">
            <h2 class="text-center mb-5 text-dark-text">What Our Clients Say</h2>
            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 h-100 testimonial-card text-center">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://placehold.co/80x80/2E7D32/ffffff?text=Dr" class="testimonial-image mb-3" alt="Client 1">
                            <p class="text-muted fst-italic">"MediCore has revolutionized our practice. The system is incredibly easy to use and has saved us countless hours on administrative tasks."</p>
                            <p class="fw-bold text-dark-text mb-0">Dr. Sarah Chen</p>
                            <p class="small text-secondary-color">General Practitioner</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 h-100 testimonial-card text-center">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://placehold.co/80x80/2196F3/ffffff?text=RN" class="testimonial-image mb-3" alt="Client 2">
                            <p class="text-muted fst-italic">"The patient management module is a game-changer. We can access all information we need with just a few clicks. Highly recommended!"</p>
                            <p class="fw-bold text-dark-text mb-0">Jane Smith, RN</p>
                            <p class="small text-secondary-color">Head Nurse</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="col-md-6 col-lg-4 d-none d-lg-block">
                    <div class="card p-4 h-100 testimonial-card text-center">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://placehold.co/80x80/4CAF50/ffffff?text=Mr" class="testimonial-image mb-3" alt="Client 3">
                            <p class="text-muted fst-italic">"Since adopting MediCore, our clinic's efficiency has soared. The billing and invoicing system is particularly powerful and accurate."</p>
                            <p class="fw-bold text-dark-text mb-0">Mr. David Lee</p>
                            <p class="small text-secondary-color">Hospital Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard/Statistics Section -->
    <section class="stats-section py-5" id="dashboard">
        <div class="container">
            <h2 class="text-center mb-5 text-primary-color">Dashboard Overview</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <i class="fas fa-users fa-2x text-primary-color mb-2"></i>
                            <h3 class="text-primary-color">1200+</h3>
                            <p class="text-muted">Total Patients</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <i class="fas fa-calendar-check fa-2x text-success-color mb-2"></i>
                            <h3 class="text-success-color">500+</h3>
                            <p class="text-muted">Appointments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <i class="fas fa-pills fa-2x text-info-color mb-2"></i>
                            <h3 class="text-info-color">750+</h3>
                            <p class="text-muted">Medicines</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <i class="fas fa-dollar-sign fa-2x text-warning-color mb-2"></i>
                            <h3 class="text-warning-color">$2.5M+</h3>
                            <p class="text-muted">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Section - New Section -->
    <section class="py-5 bg-white" id="contact">
        <div class="container">
            <h2 class="text-center mb-5 text-primary-color">Get in Touch</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4">
                        <div class="card-body">
                            <form id="contactForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="4" placeholder="Your message"></textarea>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="mailto:cayetanocharlesd92000@gmail.com" class="btn btn-primary">
                                        Submit
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer - Updated color palette -->
    <footer class="footer text-light py-4">
        <div class="container text-center">
            <p>&copy; 2025 MediCore. All rights reserved.</p>
        </div>
    </footer>


    <!-- Login Modal -->
    {{-- <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <p class="text-center text-muted mt-3 mb-0">Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Register here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Register Modal -->
    {{-- <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="registerName" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="registerEmail" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <p class="text-center text-muted mt-3 mb-0">Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for form handling and modal display -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const contactForm = document.getElementById('contactForm');
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));

            // Function to display a simulated message box
            function showSimulatedMessage(message) {
                const messageBox = document.createElement('div');
                messageBox.className = 'modal-backdrop fade show';
                messageBox.innerHTML = `
                    <div class="modal d-block" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <p class="mb-0">${message}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(messageBox);
                setTimeout(() => {
                    document.body.removeChild(messageBox);
                }, 2000);
            }

            // Handle Login form submission
            if (loginForm) {
                loginForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    console.log('Login form submitted!');
                    showSimulatedMessage('Login successful! (Simulated)');
                    loginModal.hide(); // Hide the modal after submission
                });
            }

            // Handle Register form submission
            if (registerForm) {
                registerForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    console.log('Register form submitted!');
                    showSimulatedMessage('Registration successful! (Simulated)');
                    registerModal.hide(); // Hide the modal after submission
                });
            }
            
            // Handle Contact form submission
            if (contactForm) {
                contactForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    console.log('Contact form submitted!');
                    showSimulatedMessage('Your message has been sent! (Simulated)');
                    contactForm.reset(); // Reset form fields
                });
            }
        });
    </script> --}}
</body>
</html>
