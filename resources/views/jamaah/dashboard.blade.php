<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-0">Dashboard Jamaah</h2>
                <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
            <div class="date text-muted">
                <i class="bi bi-calendar3"></i> {{ now()->format('d F Y') }}
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Pemesanan -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Pemesanan</h6>
                                <h4 class="mb-0">{{ $stats['total_bookings'] }}</h4>
                            </div>
                            <div class="ms-3">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-ticket text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menunggu Konfirmasi -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Menunggu Konfirmasi</h6>
                                <h4 class="mb-0">{{ $stats['pending_bookings'] }}</h4>
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

            <!-- Pemesanan Dikonfirmasi -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Pemesanan Dikonfirmasi</h6>
                                <h4 class="mb-0">{{ $stats['confirmed_bookings'] }}</h4>
                            </div>
                            <div class="ms-3">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pembayaran -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Pembayaran</h6>
                                <h4 class="mb-0">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h4>
                            </div>
                            <div class="ms-3">
                                <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-wallet2 text-info fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Pemesanan Terbaru -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pemesanan Terbaru</h5>
                            <a href="{{ route('jamaah.bookings.index') }}" class="btn btn-sm btn-primary">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Paket</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recent_bookings as $booking)
                                        <tr>
                                            <td class="px-4 py-3">{{ $booking->ticket->package }}</td>
                                            <td class="px-4 py-3">{{ $booking->ticket->departure_date->format('d M Y') }}</td>
                                            <td class="px-4 py-3">
                                                <span class="badge rounded-pill px-3 py-2
                                                    {{ $booking->status === 'confirmed' ? 'bg-success' : 
                                                       ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
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

            <!-- Paket Tersedia -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Paket Tersedia</h5>
                            <a href="{{ route('jamaah.packages.index') }}" class="btn btn-sm btn-primary">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @forelse($available_tickets as $ticket)
                                <div class="col-md-6">
                                    <div class="card h-100 border">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $ticket->package }}</h6>
                                            <p class="card-text text-muted small mb-0">
                                                Keberangkatan: {{ $ticket->departure_date->format('d M Y') }}
                                            </p>
                                            <p class="card-text mb-3">
                                                <span class="fw-bold text-primary">
                                                    Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                                </span>
                                            </p>
                                            <a href="{{ route('jamaah.bookings.create') }}" class="btn btn-sm btn-outline-primary">
                                                Pesan Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center text-muted mb-0">
                                        Belum ada paket tersedia
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-jamaah-layout> 