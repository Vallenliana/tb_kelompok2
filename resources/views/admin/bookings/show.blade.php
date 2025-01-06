<x-admin-layout>
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
                                <h6 class="text-muted mb-1">Status Pemesanan:</h6>
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
                                    {{ $booking->payment_status === 'paid' ? 'Lunas' : 'Pending' }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Data Jamaah</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nama:</h6>
                                <p class="mb-0">{{ $booking->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Email:</h6>
                                <p class="mb-0">{{ $booking->user->email }}</p>
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
                            @if($booking->payment_method)
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Metode Pembayaran:</h6>
                                <p class="mb-0">
                                    {{ str_replace('_', ' ', ucfirst($booking->payment_method)) }}
                                </p>
                            </div>
                            @endif
                        </div>

                        @if($booking->payment_proof)
                            <hr class="my-4">
                            <h5 class="mb-3">Bukti Pembayaran</h5>
                            <div class="text-center">
                                <img src="{{ Storage::url($booking->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 400px;">
                            </div>
                        @endif

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
                            @if($booking->payment_proof && $booking->payment_status === 'unpaid')
                                <form action="{{ route('admin.bookings.confirm', $booking) }}" 
                                      method="POST" 
                                      class="mb-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                            class="btn btn-success w-100"
                                            onclick="return confirm('Konfirmasi pembayaran dan pemesanan ini?')">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Konfirmasi Pembayaran & Pemesanan
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.bookings.reject', $booking) }}" 
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="btn btn-danger w-100"
                                        onclick="return confirm('Tolak pemesanan ini?')">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Tolak Pemesanan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Status Pemesanan</h5>
                        <div class="timeline">
                            <div class="timeline-item">
                                <i class="bi bi-circle-fill text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-1 fw-bold">Pemesanan Dibuat</p>
                                    <small class="text-muted">
                                        {{ $booking->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                            @if($booking->payment_proof)
                                <div class="timeline-item mt-3">
                                    <i class="bi bi-circle-fill text-info"></i>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-bold">Bukti Pembayaran Diunggah</p>
                                        <small class="text-muted">
                                            {{ $booking->paid_at ? $booking->paid_at->format('d M Y H:i') : '-' }}
                                        </small>
                                    </div>
                                </div>
                            @endif
                            @if($booking->status === 'confirmed')
                                <div class="timeline-item mt-3">
                                    <i class="bi bi-circle-fill text-success"></i>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-bold">Pemesanan Dikonfirmasi</p>
                                        <small class="text-muted">
                                            {{ $booking->updated_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @elseif($booking->status === 'cancelled')
                                <div class="timeline-item mt-3">
                                    <i class="bi bi-circle-fill text-danger"></i>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-bold">Pemesanan Ditolak</p>
                                        <small class="text-muted">
                                            {{ $booking->updated_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 12px;
        }
        .timeline-item {
            position: relative;
            padding-left: 15px;
            border-left: 2px solid #e9ecef;
        }
        .timeline-item i {
            position: absolute;
            left: -7px;
            top: 4px;
            font-size: 12px;
        }
    </style>
</x-admin-layout> 