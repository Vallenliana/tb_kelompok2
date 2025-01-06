<x-admin-layout>
    <div class="container-fluid px-4 py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0">Edit Data Tiket</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.umroh-tickets.update', $ticket) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $ticket->name) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Passport</label>
                        <input type="text" 
                               name="passport_number" 
                               class="form-control @error('passport_number') is-invalid @enderror" 
                               value="{{ old('passport_number', $ticket->passport_number) }}" 
                               required>
                        @error('passport_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket Umroh</label>
                        <input type="text" 
                               name="package" 
                               class="form-control @error('package') is-invalid @enderror" 
                               value="{{ old('package', $ticket->package) }}" 
                               required>
                        @error('package')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" 
                               name="price" 
                               class="form-control @error('price') is-invalid @enderror" 
                               value="{{ old('price', $ticket->price) }}" 
                               required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Keberangkatan</label>
                        <input type="date" 
                               name="departure_date" 
                               class="form-control @error('departure_date') is-invalid @enderror" 
                               value="{{ old('departure_date', $ticket->departure_date->format('Y-m-d')) }}" 
                               required>
                        @error('departure_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.umroh-tickets.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout> 