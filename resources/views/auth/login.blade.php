@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <div class="logo-container">
                        <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo">
                    </div>
                    <h1 class="text-white auth-title">Welcome Back</h1>
                    <p class="text-white-50">Login to manage teacher profiles and access the system</p>
                </div>

                <div class="auth-card">
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="email" type="email" 
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" 
                                    required autocomplete="email" autofocus
                                    placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input id="password" type="password" 
                                    class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Enter your password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" 
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-white" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-white text-decoration-none" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-hero btn-light">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-hero btn-outline-light">
                                        <i class="fas fa-user-plus me-2"></i>Register
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .auth-wrapper {
        background: url('{{ asset("images/lnu-background.jpg") }}') center/cover fixed;
        min-height: calc(100vh - 60px);
        position: relative;
        padding: 2rem 0;
        display: flex;
        align-items: center;
    }

    .auth-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.9), rgba(11, 94, 215, 0.9));
        z-index: 0;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        position: relative;
        z-index: 1;
    }

    .container {
        position: relative;
        z-index: 1;
    }

    .logo-container {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        border-radius: 50%;
        background: white;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .auth-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 8px;
        padding: 12px;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
    }

    .action-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        max-width: 400px;
        margin: 0 auto;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-control {
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        padding: 12px 20px;
        color: white;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: white;
    }

    .btn-hero {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        min-width: 160px;
        font-size: 0.9rem;
    }

    .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-hero.btn-light {
        background: white;
        color: #0d6efd;
    }

    .btn-hero.btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .form-check-label {
        color: white;
    }

    .form-check-input:checked {
        background-color: white;
        border-color: white;
    }

    .auth-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .auth-link:hover {
        color: white;
    }
</style>
@endpush
