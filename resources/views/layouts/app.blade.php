<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LNU QR Scanner') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d6efd, #0b5ed7);
            --navbar-height: 76px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding-top: var(--navbar-height);
        }

        .navbar {
            background: var(--primary-gradient) !important;
            border: none;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            height: var(--navbar-height);
        }

        .navbar-brand {
            font-weight: 600;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0;
        }

        .navbar-brand img {
            height: 45px;
            padding: 6px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            transition: all 0.3s ease;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0 0.25rem;
        }

        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-1px);
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff !important;
        }

        .navbar-toggler {
            border: none;
            padding: 0.625rem;
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar .container {
            position: relative;
        }

        .navbar-collapse {
            background: var(--primary-gradient);
        }

        @media (max-width: 767.98px) {
            .navbar-collapse {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--primary-gradient);
                padding: 1rem;
                border-radius: 0 0 15px 15px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
        }

        #app {
            padding-top: 76px; /* Height of navbar + some padding */
        }

        /* Clean up - removed unused dropdown styles */

        .dropdown-item {
            color: #495057;
            font-weight: 500;
            padding: 0.875rem 1.25rem;
            border-radius: 12px;
            margin: 0.25rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .dropdown-item i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            color: #6c757d;
            transition: color 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
            color: #0d6efd;
        }

        .dropdown-item:hover i {
            color: #0d6efd;
        }

        .dropdown-item.text-danger {
            color: #dc3545;
        }

        .dropdown-item.text-danger i {
            color: #dc3545;
        }

        .dropdown-item.text-danger:hover {
            background: #fff5f5;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 25px;
            width: 12px;
            height: 12px;
            background: white;
            transform: rotate(45deg);
            border-left: 1px solid rgba(0, 0, 0, 0.05);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            z-index: 0;
        }
        
        .user-dropdown-header {
            padding: 1.25rem;
            border-bottom: 1px solid #f0f0f0;
            margin: -1rem -1rem 1rem -1rem;
            background: #f8f9fa;
            border-radius: 15px 15px 0 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 2px solid white;
            position: relative;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: #212529;
            margin: 0;
            font-size: 1rem;
            line-height: 1.4;
        }

        .user-email {
            font-size: 0.85rem;
            color: #6c757d;
            margin: 0;
            line-height: 1.4;
        }

        .nav-profile-image {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            margin-right: 8px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 2px;
            background: white;
        }

        .navbar .nav-link {
            display: flex;
            align-items: center;
            color: white !important;
            opacity: 0.9;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .navbar .nav-link:hover {
            opacity: 1;
        }

        .navbar .nav-item {
            margin: 0 0.25rem;
            display: flex;
            align-items: center;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-logout:active {
            transform: translateY(1px);
        }

        .btn-logout i {
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .btn-logout {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
            }
        }

        .user-role {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--primary-gradient);
            color: white;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        @if(!request()->is('login') && !request()->is('register'))
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo">
                        <span>{{ config('app.name', 'LNU QR Scanner') }}</span>
                    </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-2">
                            <a class="nav-link d-flex align-items-center" href="{{ route('scan.form') }}">
                                <i class="fas fa-qrcode me-2"></i>
                                <span>Scan QR</span>
                            </a>
                        </li>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item me-2">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.profiles.index') }}">
                                        <i class="fas fa-users me-2"></i>
                                        <span>Admin Panel</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item me-3">
                                <span class="nav-link">
                                    <img src="{{ asset('images/default-avatar.svg') }}" alt="Profile" class="nav-profile-image">
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <button onclick="document.getElementById('logout-form').submit();" 
                                        class="btn btn-logout">
                                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                </button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-2"></i>Register
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Enable Bootstrap dropdowns
            $('.dropdown-toggle').dropdown();
            
            // Handle logout click
            $('.logout-button').on('click', function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            });
        });
    </script>
</body>
</html>
