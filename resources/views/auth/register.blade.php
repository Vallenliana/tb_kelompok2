<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card p-4">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="mb-4">
                            <span class="bg-primary bg-gradient p-3 rounded-circle d-inline-block">
                                <i class="bi bi-person-plus text-white fs-3"></i>
                            </span>
                        </div>
                        <h4 class="fw-bold mb-1">Daftar Akun Baru</h4>
                        <p class="text-muted">Silakan lengkapi data diri Anda</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-person text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" 
                                    placeholder="Masukkan nama lengkap" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" 
                                    placeholder="nama@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                    id="password" name="password" 
                                    placeholder="Minimal 8 karakter" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock-fill text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0"
                                    id="password_confirmation" name="password_confirmation" 
                                    placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">
                                    Masuk disini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-text {
            background-color: #f8f9fa;
            border-right: 0;
        }
        
        .form-control {
            border-left: 0;
            padding-left: 0;
        }
        
        .form-control:focus {
            border-color: #dee2e6;
            box-shadow: none;
        }
        
        .form-control:focus + .input-group-text {
            border-color: #dee2e6;
        }
        
        .invalid-feedback {
            font-size: 80%;
        }
    </style>
</x-guest-layout>
