<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jamaah Umroh') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1e4d7b;
            --secondary-color: #2a9d8f;
            --accent-color: #3498DB;
            --success-color: #27AE60;
            --warning-color: #F39C12;
            --danger-color: #E74C3C;
            --light-color: #ECF0F1;
            --dark-color: #1e4d7b;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }

        #wrapper {
            min-height: 100vh;
            display: flex;
        }
        
        #sidebar-wrapper {
            min-height: 100vh;
            width: 280px;
            background: var(--primary-color);
            transition: all 0.35s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        
        #page-content-wrapper {
            flex: 1;
            margin-left: 280px;
            min-height: 100vh;
            background: #f8f9fa;
        }
        
        .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.2rem;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        .list-group-item {
            background: transparent;
            border: none;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            border-radius: 8px;
            margin: 4px 12px;
            transition: all 0.3s ease;
        }
        
        .list-group-item:hover,
        .list-group-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .category-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 20px;
            margin: 20px 0 10px;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-link {
            color: var(--dark-color) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -280px;
            }
            
            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading d-flex align-items-center gap-2">
                <i class="bi bi-building"></i>
                <span>Jamaah Panel</span>
            </div>

            <div class="list-group list-group-flush">
                <span class="category-label">Menu Utama</span>
                
                <a href="{{ route('jamaah.dashboard') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('jamaah.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>

                <a href="{{ route('jamaah.packages.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('jamaah.packages.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i>
                    Paket Umroh
                </a>

                <span class="category-label">Transaksi</span>

                <a href="{{ route('jamaah.bookings.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('jamaah.bookings.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i>
                    Pemesanan Saya
                </a>

                <div class="category-label">Pengaturan</div>
                
                <a href="{{ route('jamaah.profile') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('jamaah.profile') ? 'active' : '' }}">
                    <i class="bi bi-person me-2"></i>Profil
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-link" id="menu-toggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                                   id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <div class="avatar me-2">
                                        <div class="avatar-title rounded-circle bg-primary text-white">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jamaah.profile') }}">
                                            <i class="bi bi-person me-2"></i>Profil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="py-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Toggle Sidebar Script -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("wrapper").classList.toggle("toggled");
        });
    </script>

    @stack('scripts')
</body>
</html> 