<x-admin-layout>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">Data Pembayaran</h2>
        </div>

        <!-- Statistik Pembayaran -->
        <div class="row g-4 mb-4">
            <!-- Total Pendapatan -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Total Pendapatan</h6>
                                <h4 class="mb-0 text-primary">
                                    Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                                </h4>
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

            <!-- Pembayaran Pending -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Pembayaran Pending</h6>
                                <h4 class="mb-0 text-warning">{{ $stats['pending_payments'] }}</h4>
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

            <!-- Pembayaran Selesai -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2">Pembayaran Selesai</h6>
                                <h4 class="mb-0 text-success">{{ $stats['completed_payments'] }}</h4>
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
        </div>

        <!-- Tabel Pembayaran -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">No.</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Jamaah</th>
                                <th class="px-4 py-3">Paket</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Metode</th>
                                <th class="px-4 py-3">Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $booking->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ $booking->user->name }}</td>
                                    <td class="px-4 py-3">{{ $booking->ticket->package }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge rounded-pill px-3 py-2
                                            {{ $booking->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $booking->payment_status === 'paid' ? 'Lunas' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $booking->payment_method ? str_replace('_', ' ', ucfirst($booking->payment_method)) : '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($booking->payment_proof)
                                            <a href="{{ Storage::url($booking->payment_proof) }}" 
                                               target="_blank"
                                               class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-image"></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada data pembayaran</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 