<x-guest-layout>
    <h2 class="auth-card-title">Buat Akun Baru</h2>
    <p class="auth-card-subtitle">Daftar untuk mulai mencari mobil impian Anda</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" 
                   class="form-input" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Masukkan nama lengkap Anda">
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" 
                   class="form-input" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
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
                   autocomplete="new-password"
                   placeholder="Minimal 8 karakter">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" 
                   class="form-input" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Ulangi password Anda">
            @error('password_confirmation')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary">
            Daftar Sekarang
        </button>

        <!-- Links -->
        <div class="auth-links">
            <a href="{{ route('home') }}" class="auth-link">
                ← Kembali ke Beranda
            </a>
        </div>

        <!-- Login Link -->
        <div class="auth-footer">
            Sudah punya akun? 
            <a href="{{ route('login') }}">Masuk Sekarang</a>
        </div>
    </form>
</x-guest-layout>
