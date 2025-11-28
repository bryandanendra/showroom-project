<x-guest-layout>
    <h2 class="auth-card-title">Selamat Datang Kembali</h2>
    <p class="auth-card-subtitle">Masuk ke akun Anda untuk melanjutkan</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" 
                   class="form-input" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="nama@email.com">
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" 
                   class="form-input" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Masukkan password Anda">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-checkbox">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Ingat saya</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary">
            Masuk
        </button>

        <!-- Links -->
        <div class="auth-links">
            <a href="{{ route('home') }}" class="auth-link">
                ← Kembali ke Beranda
            </a>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Register Link -->
        <div class="auth-footer">
            Belum punya akun? 
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </form>
</x-guest-layout>
