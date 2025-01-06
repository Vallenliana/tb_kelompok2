<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Umrah') }}</title>

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
            transform: translateX(5px);
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

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.1));
            transform: skewX(-15deg);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .avatar-title {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -280px;
                position: fixed;
            }
            
            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading d-flex align-items-center">
                <i class="bi bi-mosque fs-4 me-2"></i>
                <span class="fs-4 fw-bold">Admin Umrahh</span>
            </div>
            <div class="list-group list-group-flush my-3 px-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
                
                <div class="category-label">Manajemen Umrah</div>
                
                <a href="{{ route('admin.umroh-tickets.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.umroh-tickets.*') ? 'active' : '' }}">
                    <i class="bi bi-ticket-detailed me-2"></i>Paket Umrah
                </a>
                
                <a href="{{ route('admin.bookings.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i>Pemesanan
                </a>
                
                <div class="category-label">Keuangan</div>
                
                <a href="{{ route('admin.payments.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin me-2"></i>Pembayaran
                </a>
                
                <div class="category-label">Pengaturan</div>
                
                <a href="{{ route('admin.profile') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="bi bi-person me-2"></i>Profil
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-link text-dark" id="menu-toggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                                   id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <div class="avatar me-2">
                                        <div class="avatar-title">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
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