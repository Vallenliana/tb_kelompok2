<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0">Detail Pemesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nomor Pemesanan:</h6>
                                <p class="mb-0 fw-bold">#{{ $booking->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Tanggal Pemesanan:</h6>
                                <p class="mb-0">{{ $booking->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Status:</h6>
                                <span class="badge rounded-pill px-3 py-2
                                    {{ $booking->status === 'confirmed' ? 'bg-success' : 
                                       ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Status Pembayaran:</h6>
                                <span class="badge rounded-pill px-3 py-2
                                    {{ $booking->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Detail Paket</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nama Paket:</h6>
                                <p class="mb-0">{{ $booking->ticket->package }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Tanggal Keberangkatan:</h6>
                                <p class="mb-0">{{ $booking->ticket->departure_date->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Total Pembayaran:</h6>
                                <h4 class="text-primary mb-0">
                                    Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        @if($booking->notes)
                            <hr class="my-4">
                            <h5 class="mb-3">Catatan</h5>
                            <p class="mb-0">{{ $booking->notes }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Aksi</h5>
                        @if($booking->status === 'pending')
                            @if($booking->payment_status === 'unpaid')
                                <a href="{{ route('jamaah.bookings.payment', $booking) }}" 
                                   class="btn btn-primary w-100 mb-2">
                                    <i class="bi bi-credit-card me-1"></i>
                                    Lakukan Pembayaran
                                </a>
                            @endif
                            <form action="{{ route('jamaah.bookings.cancel', $booking) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Bantuan</h5>
                        <p class="text-muted mb-3">
                            Jika Anda memiliki pertanyaan atau kendala, silakan hubungi customer service kami:
                        </p>
                        <div class="d-grid gap-2">
                            <a href="https://wa.me/6281234567890" class="btn btn-success">
                                <i class="bi bi-whatsapp me-1"></i>
                                WhatsApp CS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-jamaah-layout> 