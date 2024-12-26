@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h1 class="h3 mb-0 py-2">Tambah Jamaah Umroh</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('umroh.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama"
                                           minlength="3"
                                           maxlength="255"
                                           required>
                                    <label for="name">Nama Lengkap</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Minimal 3 karakter, maksimal 255 karakter</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           name="passport_number" 
                                           id="passport_number" 
                                           class="form-control @error('passport_number') is-invalid @enderror" 
                                           value="{{ old('passport_number') }}" 
                                           placeholder="Masukkan nomor paspor"
                                           required>
                                    <label for="passport_number">Nomor Paspor</label>
                                    @error('passport_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="package" 
                                            id="package" 
                                            class="form-select @error('package') is-invalid @enderror" 
                                            required>
                                        <option value="">Pilih Paket Umroh</option>
                                        <option value="ekonomi" {{ old('package') == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                        <option value="standard" {{ old('package') == 'standard' ? 'selected' : '' }}>Standard</option>
                                        <option value="premium" {{ old('package') == 'premium' ? 'selected' : '' }}>Premium</option>
                                    </select>
                                    <label for="package">Paket Umroh</label>
                                    @error('package')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" 
                                           name="price" 
                                           id="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price') }}" 
                                           placeholder="Masukkan harga"
                                           min="0"
                                           required>
                                    <label for="price">Harga (Rp)</label>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" 
                                           name="departure_date" 
                                           id="departure_date" 
                                           class="form-control @error('departure_date') is-invalid @enderror" 
                                           value="{{ old('departure_date') }}" 
                                           min="{{ date('Y-m-d') }}"
                                           required>
                                    <label for="departure_date">Tanggal Keberangkatan</label>
                                    @error('departure_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('umroh.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Format currency input
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, "");
        if (value !== "") {
            value = parseInt(value);
            this.value = value;
        }
    });

    // Set minimum date for departure_date
    const departureDateInput = document.getElementById('departure_date');
    const today = new Date().toISOString().split('T')[0];
    departureDateInput.setAttribute('min', today);
</script>
@endpush
@endsection