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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-white border-end" id="sidebar-wrapper" style="width: 250px;">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-dark border-bottom">
                    <i class="bi bi-mosque"></i> Admin Umrah
                </div>
                <div class="list-group list-group-flush my-3">
                    @if(Auth::user()->usertype === 'admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="list-group-item list-group-item-action bg-transparent second-text {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-ticket-perforated me-2"></i>Kelola Paket Umrah
                    </a>
                    @if(Auth::user()->usertype === 'jamaah')
                        <a href="{{ route('jamaah.bookings.index') }}" 
                           class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="bi bi-ticket-perforated me-2"></i>Pemesanan Saya
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-calendar-check me-2"></i>Pemesanan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-people me-2"></i>Data Jamaah
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-cash-coin me-2"></i>Pembayaran
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-file-earmark-text me-2"></i>Laporan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="bi bi-gear me-2"></i>Pengaturan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper" style="width: calc(100% - 250px);">
                <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-list primary-text fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-4 m-0">Dashboard</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name ?? 'Admin' }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-fill me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill me-2"></i>Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="container-fluid px-4 py-5">
                    @if (isset($header))
                        <header class="bg-white shadow-sm rounded p-3 mb-4">
                            <div class="max-w-7xl mx-auto">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById("menu-toggle").addEventListener("click", function(e) {
                e.preventDefault();
                document.getElementById("wrapper").classList.toggle("toggled");
            });
        </script>
        @stack('scripts')
    </body>
</html>