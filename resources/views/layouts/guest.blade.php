<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'SMM AUTO GALLERY'))</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo-transparent.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Pure CSS - No Node.js Dependencies -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <style>
            /* Custom styles for auth pages */
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: #ffffff;
                padding: 2rem 1rem;
            }
            
            .auth-logo-container {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .auth-logo {
                width: 120px;
                height: auto;
                margin: 0 auto 1rem;
                filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            }
            
            .auth-brand-name {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1f2937;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                margin-bottom: 0.25rem;
            }
            
            .auth-brand-tagline {
                font-size: 0.875rem;
                color: #6b7280;
            }
            
            .auth-card {
                width: 100%;
                max-width: 420px;
                background: white;
                border-radius: 1rem;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                padding: 2rem;
                border: 1px solid #e5e7eb;
            }
            
            .auth-card-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.5rem;
                text-align: center;
            }
            
            .auth-card-subtitle {
                font-size: 0.875rem;
                color: #6b7280;
                margin-bottom: 2rem;
                text-align: center;
            }
            
            .form-group {
                margin-bottom: 1.25rem;
            }
            
            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151;
                margin-bottom: 0.5rem;
            }
            
            .form-input {
                width: 100%;
                padding: 0.625rem 1rem;
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                transition: all 0.15s;
            }
            
            .form-input:focus {
                outline: none;
                border-color: #dc2626;
                box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            }
            
            .form-error {
                color: #dc2626;
                font-size: 0.75rem;
                margin-top: 0.25rem;
            }
            
            .form-checkbox {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
            }
            
            .form-checkbox input {
                width: 1rem;
                height: 1rem;
                border-radius: 0.25rem;
                border: 1px solid #d1d5db;
                margin-right: 0.5rem;
            }
            
            .form-checkbox label {
                font-size: 0.875rem;
                color: #4b5563;
                margin: 0;
            }
            
            .btn-primary {
                width: 100%;
                padding: 0.75rem 1rem;
                background: #dc2626;
                color: white;
                font-weight: 600;
                border-radius: 0.5rem;
                border: none;
                cursor: pointer;
                transition: all 0.15s;
                font-size: 0.875rem;
            }
            
            .btn-primary:hover {
                background: #b91c1c;
                transform: translateY(-1px);
                box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
            }
            
            .btn-primary:active {
                transform: translateY(0);
                background: #991b1b;
            }
            
            .auth-links {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
                font-size: 0.875rem;
            }
            
            .auth-link {
                color: #dc2626;
                text-decoration: none;
                transition: color 0.15s;
            }
            
            .auth-link:hover {
                color: #b91c1c;
                text-decoration: underline;
            }
            
            .auth-divider {
                text-align: center;
                margin: 1.5rem 0;
                color: #9ca3af;
                font-size: 0.875rem;
            }
            
            .auth-footer {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid #e5e7eb;
                font-size: 0.875rem;
                color: #6b7280;
            }
            
            .auth-footer a {
                color: #dc2626;
                font-weight: 600;
                text-decoration: none;
            }
            
            .auth-footer a:hover {
                color: #b91c1c;
                text-decoration: underline;
            }
            
            .alert {
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
                font-size: 0.875rem;
            }
            
            .alert-success {
                background-color: #dcfce7;
                color: #15803d;
                border: 1px solid #86efac;
            }
            
            .alert-error {
                background-color: #fee2e2;
                color: #b91c1c;
                border: 1px solid #fca5a5;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <!-- Logo -->
            <div class="auth-logo-container">
                @if(file_exists(public_path('logo-transparent.png')))
                    <img src="{{ asset('logo-transparent.png') }}" alt="SMM AUTO GALLERY" class="auth-logo">
                @else
                    <div style="width: 120px; height: 120px; margin: 0 auto 1rem; background: white; border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <span style="font-size: 2rem; font-weight: 700; color: #667eea;">SMM</span>
                    </div>
                @endif
                <div class="auth-brand-name">SMM AUTO GALLERY</div>
                <div class="auth-brand-tagline">Premium Used Cars</div>
            </div>

            <!-- Card -->
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
