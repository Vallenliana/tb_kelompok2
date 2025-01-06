<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0">Pemesanan Tiket Umroh</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('jamaah.bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Pilih Paket Umroh</label>
                        <select name="umroh_ticket_id" class="form-select @error('umroh_ticket_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach($availableTickets as $ticket)
                                <option value="{{ $ticket->id }}" 
                                        data-price="{{ $ticket->price }}"
                                        {{ old('umroh_ticket_id') == $ticket->id ? 'selected' : '' }}>
                                    {{ $ticket->package }} - {{ $ticket->departure_date->format('d M Y') }} 
                                    (Rp {{ number_format($ticket->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('umroh_ticket_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" rows="3" 
                                  class="form-control @error('notes') is-invalid @enderror"
                                  placeholder="Masukkan catatan jika ada...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle fs-4 me-2"></i>
                            <div>
                                <h6 class="mb-1">Informasi Pembayaran:</h6>
                                <p class="mb-0">Setelah melakukan pemesanan, Anda akan diarahkan ke halaman pembayaran untuk melakukan pembayaran.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jamaah.packages.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>
                            Buat Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Untuk menampilkan preview harga saat memilih paket
        document.querySelector('select[name="umroh_ticket_id"]').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.dataset.price;
            if (price) {
                document.getElementById('selected-price').textContent = 
                    new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' })
                    .format(price);
            }
        });
    </script>
    @endpush
</x-jamaah-layout> 