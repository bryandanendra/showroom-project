<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMM AUTO GALLERY - Showroom Mobil Bekas Berkualitas')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg sticky top-0 z-50 relative" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-xl">SMM</span>
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class="text-lg font-bold tracking-wide">SMM AUTO GALLERY</span>
                            <span class="text-xs text-gray-400">Premium Used Cars</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Menu -->
                            @php
                                $pendingTestDrives = \App\Models\TestDrive::where('status', 'pending')->count();
                                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                                $totalNotifications = $pendingTestDrives + $pendingOrders;
                            @endphp
                            <div class="relative">
                                <a href="{{ route('admin.dashboard') }}" class="relative hover:text-red-500 transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    @if($totalNotifications > 0)
                                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                            {{ $totalNotifications > 9 ? '9+' : $totalNotifications }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded transition">
                                Admin Panel
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-red-500 transition">
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
                            <a href="{{ route('home') }}" class="hover:text-red-500 transition {{ request()->routeIs('home') ? 'text-red-500' : '' }}">
                                Beranda
                            </a>
                            <a href="{{ route('catalog.index') }}" class="hover:text-red-500 transition {{ request()->routeIs('catalog.*') ? 'text-red-500' : '' }}">
                                Katalog
                            </a>
                            <a href="{{ route('test-drive.index') }}" class="hover:text-red-500 transition {{ request()->routeIs('test-drive.*') ? 'text-red-500' : '' }}">
                                Test Drive
                            </a>
                            <a href="{{ route('contact') }}" class="hover:text-red-500 transition {{ request()->routeIs('contact') ? 'text-red-500' : '' }}">
                                Kontak
                            </a>
                            
                            <!-- User Notification Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="relative hover:text-red-500 transition flex items-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    @if($userNotifications > 0)
                                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                            {{ $userNotifications > 9 ? '9+' : $userNotifications }}
                                        </span>
                                    @endif
                                </button>
                                
                                <!-- Dropdown -->
                                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50">
                                    <div class="p-4 border-b">
                                        <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                    </div>
                                    <div class="max-h-96 overflow-y-auto">
                                        @forelse($userTestDrives as $td)
                                            <a href="{{ route('test-drive.index') }}" class="block p-4 hover:bg-gray-50 border-b">
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
                                            <a href="{{ route('dashboard') }}" class="block p-4 hover:bg-gray-50 border-b">
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
                            
                            <a href="{{ route('dashboard') }}" class="hover:text-red-500 transition">
                                Dashboard
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-red-500 transition">
                                    Logout
                                </button>
                            </form>
                        @endif
                    @else
                        <!-- Guest Menu -->
                        <a href="{{ route('home') }}" class="hover:text-red-500 transition {{ request()->routeIs('home') ? 'text-red-500' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('catalog.index') }}" class="hover:text-red-500 transition {{ request()->routeIs('catalog.*') ? 'text-red-500' : '' }}">
                            Katalog
                        </a>
                        <a href="{{ route('contact') }}" class="hover:text-red-500 transition {{ request()->routeIs('contact') ? 'text-red-500' : '' }}">
                            Kontak
                        </a>
                        <a href="{{ route('login') }}" class="hover:text-red-500 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded transition">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-1"
                 class="absolute top-16 left-0 right-0 bg-gray-900 md:hidden shadow-lg z-50 border-t border-gray-800"
                 @click.away="mobileMenuOpen = false">
                <div class="px-4 py-4 space-y-2">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Mobile Menu -->
                            <a href="{{ route('admin.dashboard') }}" class="block py-3 px-4 rounded hover:bg-gray-800 text-red-500 transition">Admin Panel</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left py-3 px-4 rounded hover:bg-gray-800 hover:text-red-500 transition">Logout</button>
                            </form>
                        @else
                            <!-- User Mobile Menu -->
                            <a href="{{ route('home') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Beranda</a>
                            <a href="{{ route('catalog.index') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Katalog</a>
                            <a href="{{ route('test-drive.index') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Test Drive</a>
                            <a href="{{ route('contact') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Kontak</a>
                            <a href="{{ route('dashboard') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left py-3 px-4 rounded hover:bg-gray-800 hover:text-red-500 transition">Logout</button>
                            </form>
                        @endif
                    @else
                        <!-- Guest Mobile Menu -->
                        <a href="{{ route('home') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Beranda</a>
                        <a href="{{ route('catalog.index') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Katalog</a>
                        <a href="{{ route('contact') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Kontak</a>
                        <a href="{{ route('login') }}" class="block py-3 px-4 rounded hover:bg-gray-800 transition">Login</a>
                        <a href="{{ route('register') }}" class="block py-3 px-4 rounded bg-red-600 hover:bg-red-700 text-center transition">Daftar</a>
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
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} SMM AUTO GALLERY. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif
</body>
</html>
