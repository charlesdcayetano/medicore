<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediCore') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-body">
        <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <!-- Logo Section -->
                        <div class="text-center mb-4">
                            <div class="auth-logo mb-3">
                                <i class="fas fa-heartbeat fa-3x text-primary"></i>
                            </div>
                            <h1 class="h3 text-primary fw-bold">MediCore</h1>
                            <p class="text-muted">Healthcare Management System for Bailan District Hospital</p>
                        </div>

                        <!-- Auth Card -->
                        <div class="card auth-card">
                            <div class="card-body p-4">
                                {{ $slot }}
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                &copy; {{ date('Y') }} MediCore. All rights reserved. 2025
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
