<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card p-4">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="mb-4">
                            <span class="bg-primary bg-gradient p-3 rounded-circle d-inline-block">
                                <i class="bi bi-key text-white fs-3"></i>
                            </span>
                        </div>
                        <h4 class="fw-bold mb-1">Lupa Password?</h4>
                        <p class="text-muted">
                            Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" 
                                    placeholder="nama@example.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-send me-2"></i>Kirim Link Reset Password
                        </button>

                        <!-- Back to Login -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke halaman login
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Additional Info -->
                <div class="text-center mt-4 text-white">
                    <small>
                        <i class="bi bi-info-circle me-1"></i>
                        Link reset password akan dikirim ke email Anda
                    </small>
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
        
        .alert {
            border: none;
            border-radius: 10px;
        }
        
        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }
        
        .btn-close {
            filter: none;
        }
    </style>
</x-guest-layout>
