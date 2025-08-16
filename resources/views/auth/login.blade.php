<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-info fade-in mb-4">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>
                {{ __('Email Address') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" 
                       type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Enter your email address">
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="fas fa-lock me-2"></i>
                {{ __('Password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" 
                       type="password" 
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Enter your password">
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="mb-3">
            <div class="form-check">
                <input id="remember_me" 
                       type="checkbox" 
                       class="form-check-input" 
                       name="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-muted" for="remember_me">
                    <i class="fas fa-check-square me-2"></i>
                    {{ __('Remember me') }}
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>
                {{ __('Sign In') }}
            </button>
        </div>

        <!-- Forgot Password Link -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-muted" href="{{ route('password.request') }}">
                    <i class="fas fa-key me-1"></i>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Divider -->
        <div class="text-center my-4">
            <span class="text-muted">or</span>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <span class="text-muted">Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-bold">
                <i class="fas fa-user-plus me-1"></i>
                Register here
            </a>
        </div>
    </form>

    <style>
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }
    </style>
</x-guest-layout>
