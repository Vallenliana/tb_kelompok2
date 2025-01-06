<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card p-4">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="mb-4">
                            <span class="bg-primary bg-gradient p-3 rounded-circle d-inline-block">
                                <i class="bi bi-person-circle text-white fs-3"></i>
                            </span>
                        </div>
                        <h4 class="fw-bold mb-1">Selamat Datang Kembali!</h4>
                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
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

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Ingat Saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">
                                    Daftar Sekarang
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
