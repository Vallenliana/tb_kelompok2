<x-admin-layout>
    <div class="container-fluid px-4 py-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-dark fw-bold mb-0">Dashboard Admin</h2>
                <p class="text-muted mb-0">Selamat datang di panel admin umroh</p>
            </div>
            <div class="date text-secondary d-flex align-items-center">
                <i class="bi bi-calendar3 me-2"></i>
                <span>{{ now()->format('l, d F Y') }}</span>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-5">
            <!-- Total Pemesanan -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Pemesanan</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--primary-color)">
                                        {{ $stats['total_bookings'] }}
                                    </h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up"></i> +12%
                                    </small>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="p-3 rounded-circle" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color))">
                                    <i class="bi bi-ticket-detailed text-white fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menunggu Konfirmasi -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Menunggu Konfirmasi</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--warning-color)">
                                        {{ $stats['pending_bookings'] }}
                                    </h2>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="p-3 rounded-circle" style="background: linear-gradient(135deg, var(--warning-color), #FFA502)">
                                    <i class="bi bi-clock-history text-white fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jamaah -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Jamaah</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--success-color)">
                                        {{ $stats['total_jamaah'] }}
                                    </h2>
                                    <small class="text-success">
                                        <i class="bi bi-people"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-people text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Pendapatan</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--primary-color)">
                                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-wallet2 text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Pending -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Pemesanan Pending</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--warning-color)">
                                        {{ $stats['pending_bookings'] }}
                                    </h2>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-clock-history text-warning fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Pending -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Pembayaran Pending</h6>
                                <div class="d-flex align-items-baseline">
                                    <h2 class="mb-0 me-2" style="color: var(--warning-color)">
                                        {{ $stats['unpaid_bookings'] }}
                                    </h2>
                                </div>
                            </div>
                            <div class="ms-3">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-credit-card text-warning fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Tables Section -->
        <div class="row g-4">
            <!-- Grafik Statistik -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header bg-transparent border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Statistik Pemesanan {{ date('Y') }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Export Data</a></li>
                                    <li><a class="dropdown-item" href="#">Print</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="bookingsChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pemesanan Terbaru -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header bg-transparent border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pemesanan Terbaru</h5>
                            <a href="{{ route('admin.bookings.index') }}" 
                               class="btn btn-sm" 
                               style="background: var(--primary-color); color: white;">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <tbody>
                                    @forelse($recent_bookings as $booking)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3">
                                                        <div class="avatar-title rounded-circle">
                                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $booking->user->name }}</h6>
                                                        <small class="text-muted">{{ $booking->ticket->package }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-3">
                                                <span class="badge rounded-pill px-3 py-2
                                                    {{ $booking->status === 'confirmed' ? 'bg-success' : 
                                                       ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                Belum ada pemesanan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bookingsChart');
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const monthlyData = @json($monthly_bookings);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthNames,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: Array(12).fill(0).map((_, index) => {
                        const found = monthlyData.find(item => item.month === index + 1);
                        return found ? found.total : 0;
                    }),
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
    @endpush

    <style>
        .avatar {
            width: 40px;
            height: 40px;
        }
        
        .avatar-title {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
    </style>
</x-admin-layout> 