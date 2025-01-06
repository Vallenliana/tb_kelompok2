<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">Daftar Pemesanan Saya</h2>
            <a href="{{ route('jamaah.packages.index') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Pesan Tiket
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">No.</th>
                                <th class="px-4 py-3">Paket</th>
                                <th class="px-4 py-3">Tanggal Keberangkatan</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Pembayaran</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $booking->ticket->package }}</td>
                                    <td class="px-4 py-3">{{ $booking->ticket->departure_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge rounded-pill px-3 py-2
                                            {{ $booking->status === 'confirmed' ? 'bg-success' : 
                                               ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge rounded-pill px-3 py-2
                                            {{ $booking->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('jamaah.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($booking->status === 'pending' && $booking->payment_status === 'unpaid')
                                                <a href="{{ route('jamaah.bookings.payment', $booking) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-credit-card"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada pemesanan</p>
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
</x-jamaah-layout> 