<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Umrah App') }}</title>

        <!-- Bootstrap 5.3 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background: linear-gradient(135deg, #1e4d7b 0%, #2a9d8f 100%);
                min-height: 100vh;
                position: relative;
                padding-bottom: 80px;
            }

            .navbar {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
            }

            .navbar-brand {
                font-weight: 700;
                color: white !important;
            }

            .nav-link {
                color: rgba(255, 255, 255, 0.8) !important;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                color: white !important;
                transform: translateY(-2px);
            }

            .hero {
                padding: 100px 0;
                color: white;
                text-align: center;
            }

            .hero h1 {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .hero p {
                font-size: 1.2rem;
                opacity: 0.9;
                max-width: 600px;
                margin: 0 auto 2rem;
            }

            .btn-primary {
                background: white;
                color: #1e4d7b;
                border: none;
                padding: 12px 30px;
                font-weight: 600;
                border-radius: 50px;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background: #f8f9fa;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .features {
                padding: 80px 0;
            }

            .feature-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 30px;
                color: white;
                text-align: center;
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-10px);
                background: rgba(255, 255, 255, 0.15);
            }

            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            .footer {
                background: rgba(0, 0, 0, 0.2);
                backdrop-filter: blur(10px);
                color: white;
                padding: 25px 0;
                position: absolute;
                bottom: 0;
                width: 100%;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .footer-links {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                gap: 20px;
            }

            .footer-links a {
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }

            .footer-links a:hover {
                color: white;
            }

            .copyright {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin: 0;
            }

            @media (max-width: 768px) {
                .footer-content {
                    flex-direction: column;
                    gap: 15px;
                    text-align: center;
                }

                .footer-links {
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-mosque me-2"></i>
                    {{ config('app.name', 'Umrah App') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    @if (Route::has('login'))
                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Perjalanan Ibadah Umrah Anda</h1>
                <p>Nikmati pengalaman ibadah umrah yang nyaman dan terpercaya bersama kami. Kami siap membantu mewujudkan impian ibadah Anda.</p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Mulai Perjalanan
                    </a>
                @endif
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h3>Terpercaya</h3>
                            <p>Layanan umrah resmi dan terpercaya dengan izin resmi dari Kementerian Agama</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <h3>Pelayanan Terbaik</h3>
                            <p>Didampingi pembimbing berpengalaman dan pelayanan prima selama perjalanan</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <h3>Harga Terjangkau</h3>
                            <p>Berbagai pilihan paket dengan harga yang sesuai dengan kebutuhan Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                    <p class="copyright">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
