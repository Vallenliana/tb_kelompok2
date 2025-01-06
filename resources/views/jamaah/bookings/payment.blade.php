<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0">Pembayaran Tiket Umroh</h4>
                    </div>
                    <div class="card-body">
                        <!-- Informasi Pemesanan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nomor Pemesanan:</h6>
                                <p class="mb-0 fw-bold">#{{ $booking->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Total Pembayaran:</h6>
                                <h4 class="text-primary mb-0">
                                    Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Form Pembayaran -->
                        <form action="{{ route('jamaah.bookings.payment.store', $booking) }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="transfer_bca">Transfer Bank BCA</option>
                                    <option value="transfer_mandiri">Transfer Bank Mandiri</option>
                                    <option value="transfer_bni">Transfer Bank BNI</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bank-details mb-4 d-none" id="transfer_bca">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">Bank BCA</h6>
                                    <p class="mb-0">No. Rekening: 1234567890</p>
                                    <p class="mb-0">Atas Nama: PT Travel Umroh</p>
                                </div>
                            </div>

                            <div class="bank-details mb-4 d-none" id="transfer_mandiri">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">Bank Mandiri</h6>
                                    <p class="mb-0">No. Rekening: 0987654321</p>
                                    <p class="mb-0">Atas Nama: PT Travel Umroh</p>
                                </div>
                            </div>

                            <div class="bank-details mb-4 d-none" id="transfer_bni">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">Bank BNI</h6>
                                    <p class="mb-0">No. Rekening: 1122334455</p>
                                    <p class="mb-0">Atas Nama: PT Travel Umroh</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Bukti Pembayaran</label>
                                <input type="file" name="payment_proof" 
                                       class="form-control @error('payment_proof') is-invalid @enderror"
                                       accept="image/*" required>
                                <div class="form-text">Upload bukti transfer dalam format gambar (JPG, PNG)</div>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('jamaah.bookings.show', $booking) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Konfirmasi Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Panduan Pembayaran</h5>
                        <ol class="ps-3">
                            <li class="mb-2">Pilih metode pembayaran yang tersedia</li>
                            <li class="mb-2">Transfer sesuai nominal yang tertera</li>
                            <li class="mb-2">Screenshot/foto bukti transfer</li>
                            <li class="mb-2">Upload bukti transfer pada form</li>
                            <li class="mb-2">Klik tombol konfirmasi pembayaran</li>
                        </ol>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Bantuan</h5>
                        <p class="text-muted mb-3">
                            Jika Anda mengalami kendala dalam pembayaran, silakan hubungi customer service kami:
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

    @push('scripts')
    <script>
        // Show/hide bank details based on selected payment method
        document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
            // Hide all bank details first
            document.querySelectorAll('.bank-details').forEach(el => el.classList.add('d-none'));
            
            // Show selected bank details
            const selectedMethod = this.value;
            if (selectedMethod) {
                document.getElementById(selectedMethod).classList.remove('d-none');
            }
        });
    </script>
    @endpush
</x-jamaah-layout> 