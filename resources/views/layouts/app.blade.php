<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMM AUTO GALLERY - Showroom Mobil Bekas Berkualitas')</title>
    
    <!-- Pure CSS - No Node.js Dependencies -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-content">
                <!-- Logo -->
                <div class="navbar-logo">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="navbar-logo-icon">
                            <span class="text-white font-bold text-xl">SMM</span>
                        </div>
                        <div class="navbar-logo-text">
                            <span class="text-lg font-bold tracking-wide">SMM AUTO GALLERY</span>
                            <span class="text-xs text-gray-400">Premium Used Cars</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="navbar-menu">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Menu -->
                            @php
                                $pendingTestDrives = \App\Models\TestDrive::where('status', 'pending')->count();
                                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                                $totalNotifications = $pendingTestDrives + $pendingOrders;
                            @endphp
                            <div class="dropdown" data-dropdown>
                                <a href="{{ route('admin.dashboard') }}" class="relative navbar-link" data-dropdown-toggle>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    @if($totalNotifications > 0)
                                        <span class="notification-badge">
                                            {{ $totalNotifications > 9 ? '9+' : $totalNotifications }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                Admin Panel
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="navbar-link">
                                    Logout
                                </button>
                            </form>
                        @else
                            <!-- User Menu -->
                            @php
                                $userTestDrives = \App\Models\TestDrive::where('user_id', auth()->id())
                                    ->whereIn('status', ['approved', 'rejected'])
                                    ->latest()
                                    ->get();
                                $userOrders = \App\Models\Order::where('user_id', auth()->id())
                                    ->whereIn('status', ['approved', 'rejected', 'completed'])
                                    ->latest()
                                    ->get();
                                $userNotifications = $userTestDrives->count() + $userOrders->count();
                            @endphp
                            <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                Beranda
                            </a>
                            <a href="{{ route('catalog.index') }}" class="navbar-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">
                                Katalog
                            </a>
                            <a href="{{ route('test-drive.index') }}" class="navbar-link {{ request()->routeIs('test-drive.*') ? 'active' : '' }}">
                                Test Drive
                            </a>
                            <a href="{{ route('contact') }}" class="navbar-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                                Kontak
                            </a>
                            
                            <!-- User Notification Dropdown -->
                            <div class="dropdown" data-dropdown>
                                <button class="relative navbar-link" data-dropdown-toggle>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    @if($userNotifications > 0)
                                        <span class="notification-badge">
                                            {{ $userNotifications > 9 ? '9+' : $userNotifications }}
                                        </span>
                                    @endif
                                </button>
                                
                                <!-- Dropdown -->
                                <div class="dropdown-menu" data-dropdown-menu>
                                    <div class="dropdown-header">
                                        <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                    </div>
                                    <div class="dropdown-content">
                                        @forelse($userTestDrives as $td)
                                            <a href="{{ route('test-drive.index') }}" class="dropdown-item">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0 w-10 h-10 {{ $td->status === 'approved' ? 'bg-green-100' : 'bg-red-100' }} rounded-full flex items-center justify-center">
                                                        @if($td->status === 'approved')
                                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div class="ml-3 flex-1">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            Test Drive {{ $td->status === 'approved' ? 'Disetujui' : 'Ditolak' }}
                                                        </p>
                                                        <p class="text-xs text-gray-500">{{ $td->car->brand }} {{ $td->car->model }}</p>
                                                        <p class="text-xs text-gray-400 mt-1">{{ $td->updated_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                        @endforelse
                                        
                                        @forelse($userOrders as $order)
                                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0 w-10 h-10 
                                                        {{ $order->status === 'approved' ? 'bg-green-100' : ($order->status === 'completed' ? 'bg-blue-100' : 'bg-red-100') }} 
                                                        rounded-full flex items-center justify-center">
                                                        @if($order->status === 'approved')
                                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        @elseif($order->status === 'completed')
                                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div class="ml-3 flex-1">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            Pesanan 
                                                            @if($order->status === 'approved') Disetujui
                                                            @elseif($order->status === 'completed') Selesai
                                                            @else Ditolak
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-500">{{ $order->car->brand }} {{ $order->car->model }}</p>
                                                        <p class="text-xs text-gray-400 mt-1">{{ $order->updated_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @empty
                                        @endforelse
                                        
                                        @if($userNotifications == 0)
                                            <div class="p-8 text-center text-gray-500">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                                <p class="mt-2">Tidak ada notifikasi</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('dashboard') }}" class="navbar-link">
                                Dashboard
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="navbar-link">
                                    Logout
                                </button>
                            </form>
                        @endif
                    @else
                        <!-- Guest Menu -->
                        <a href="{{ route('home') }}" class="navbar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('catalog.index') }}" class="navbar-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">
                            Katalog
                        </a>
                        <a href="{{ route('contact') }}" class="navbar-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                            Kontak
                        </a>
                        <a href="{{ route('login') }}" class="navbar-link">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="navbar-mobile-toggle">
                    <button data-mobile-menu-toggle class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="navbar-mobile-menu" data-mobile-menu>
                <div class="navbar-mobile-menu-content">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Mobile Menu -->
                            <a href="{{ route('admin.dashboard') }}" class="navbar-mobile-link">Admin Panel</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="navbar-mobile-link w-full text-left">Logout</button>
                            </form>
                        @else
                            <!-- User Mobile Menu -->
                            <a href="{{ route('home') }}" class="navbar-mobile-link">Beranda</a>
                            <a href="{{ route('catalog.index') }}" class="navbar-mobile-link">Katalog</a>
                            <a href="{{ route('test-drive.index') }}" class="navbar-mobile-link">Test Drive</a>
                            <a href="{{ route('contact') }}" class="navbar-mobile-link">Kontak</a>
                            <a href="{{ route('dashboard') }}" class="navbar-mobile-link">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="navbar-mobile-link w-full text-left">Logout</button>
                            </form>
                        @endif
                    @else
                        <!-- Guest Mobile Menu -->
                        <a href="{{ route('home') }}" class="navbar-mobile-link">Beranda</a>
                        <a href="{{ route('catalog.index') }}" class="navbar-mobile-link">Katalog</a>
                        <a href="{{ route('contact') }}" class="navbar-mobile-link">Kontak</a>
                        <a href="{{ route('login') }}" class="navbar-mobile-link">Login</a>
                        <a href="{{ route('register') }}" class="navbar-mobile-link bg-red-600 text-center">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @if(!Request::is('contact'))
    <footer class="footer">
        <div class="footer-content">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-red-500">Tentang Kami</h3>
                    <p class="text-gray-400 text-sm">
                        Showroom mobil bekas terpercaya dengan pilihan kendaraan berkualitas dan harga kompetitif.
                    </p>
                </div>

                <!-- Quick Links -->
               

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-red-500">Kontak</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Jl. Showroom No. 123, Jakarta</li>
                        <li>Telp: (021) 1234-5678</li>
                        <li>WA: 0812-3456-7890</li>
                        <li>Email: info@showroom.com</li>
                    </ul>
                </div>

                <!-- Hours -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-red-500">Jam Operasional</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Senin - Jumat: 09:00 - 18:00</li>
                        <li>Sabtu: 09:00 - 16:00</li>
                        <li>Minggu: Tutup</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SMM AUTO GALLERY. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif
    
    <!-- Pure JavaScript - No Node.js Dependencies -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
