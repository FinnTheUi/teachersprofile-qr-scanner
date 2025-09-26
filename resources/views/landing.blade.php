<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LNU QR Scanner') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: url('{{ asset("images/lnu-background.jpg") }}') center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
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
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.75), rgba(11, 94, 215, 0.75));
            backdrop-filter: blur(1px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            padding: 4rem 0;
        }

        .logo-container {
            width: 180px;
            height: 180px;
            margin: 0 auto 2.5rem;
            border-radius: 50%;
            padding: 0;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 160px;
            height: 160px;
            object-fit: contain;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 3rem;
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

        .auth-section, .scan-section {
            padding: 0.75rem;
        }

        .auth-content, .scan-content {
            text-align: center;
        }

        .auth-title, .scan-title {
            color: white;
            font-weight: 600;
            font-size: 1.15rem;
        }

        .scan-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .divider-vertical {
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
            position: relative;
            margin: 0 1rem;
        }

        .divider-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.5rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .qr-icon-container {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
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

        .feature-section {
            padding: 6rem 0;
            background: white;
        }

        .feature-card {
            background: white;
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 1.5rem;
            background: rgba(13, 110, 253, 0.1);
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .btn-hero {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .action-box {
                padding: 1rem;
            }
            .auth-section, .scan-section {
                padding: 1.5rem 1rem;
            }
            .auth-section {
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            .divider-vertical {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content text-center">
            <div class="logo-container">
                <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo">
            </div>
            <h1 class="hero-title">LNU Teacher Profile Scanner</h1>
            <p class="hero-subtitle">Access faculty profiles instantly through QR code scanning</p>
            
            <div class="action-box">
                <div class="d-flex flex-column gap-2">
                    <!-- Login -->
                    <div class="auth-section py-2">
                        <div class="auth-content">
                            <h4 class="auth-title mb-3">Account Access</h4>
                            <div class="d-grid">
                                <a href="{{ route('login') }}" class="btn btn-hero btn-outline-light mb-2">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Register -->
                    @if (Route::has('register'))
                    <div class="auth-section py-2">
                        <div class="auth-content">
                            <div class="d-grid">
                                <a href="{{ route('register') }}" class="btn btn-hero btn-outline-light">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- QR Scanner -->
                    <div class="scan-section py-2">
                        <div class="scan-content">
                            <div class="qr-icon-container mb-2">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h4 class="scan-title mb-2">Quick Scan</h4>
                            <p class="scan-subtitle mb-3">No account needed for profile viewing</p>
                            <a href="{{ route('scan.form') }}" class="btn btn-hero btn-primary">
                                <i class="fas fa-qrcode me-2"></i>Scan QR Code
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="mb-3">Instant Access</h4>
                        <p class="text-muted mb-0">Scan QR codes to instantly view comprehensive teacher profiles and contact information</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="mb-3">Secure System</h4>
                        <p class="text-muted mb-0">Role-based access control ensures data security and proper information management</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h4 class="mb-3">Always Updated</h4>
                        <p class="text-muted mb-0">Access the latest faculty information, updated and maintained by administrators</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-light">
        <div class="container text-center">
            <p class="text-muted mb-0">© {{ date('Y') }} Leyte Normal University. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>