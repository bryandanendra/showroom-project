<x-guest-layout>
    @section('title', 'Lupa Password - SMM AUTO GALLERY')
    
    <h2 class="auth-card-title">Lupa Password?</h2>
    <p class="auth-card-subtitle">
        Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link untuk mereset password Anda.
    </p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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
                   placeholder="nama@email.com">
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary">
            Kirim Link Reset Password
        </button>

        <!-- Back to Login -->
        <div class="auth-links" style="justify-content: center; margin-top: 1.5rem;">
            <a href="{{ route('login') }}" class="auth-link">
                ← Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
