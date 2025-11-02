<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Showroom</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-900 text-white transition-all duration-300 flex-shrink-0">
            <div class="flex items-center justify-between p-4 border-b border-gray-800">
                <div x-show="sidebarOpen" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">SMM</span>
                    </div>
                    <span class="font-bold text-sm">Admin Panel</span>
                </div>
                <div x-show="!sidebarOpen" class="flex items-center justify-center w-full">
                    <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xs">SMM</span>
                    </div>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-white" x-show="sidebarOpen">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-600' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('admin.cars.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-800 transition {{ request()->routeIs('admin.cars.*') ? 'bg-red-600' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Kelola Mobil</span>
                </a>

                <a href="{{ route('admin.test-drives.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-800 transition {{ request()->routeIs('admin.test-drives.*') ? 'bg-red-600' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Test Drive</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-800 transition {{ request()->routeIs('admin.orders.*') ? 'bg-red-600' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Pemesanan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    
                    <div class="flex items-center space-x-6">
                        @php
                            $pendingTestDrives = \App\Models\TestDrive::where('status', 'pending')->count();
                            $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                            $totalNotifications = $pendingTestDrives + $pendingOrders;
                        @endphp
                        
                        <!-- Notification Bell -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                @if($totalNotifications > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                        {{ $totalNotifications > 9 ? '9+' : $totalNotifications }}
                                    </span>
                                @endif
                            </button>
                            
                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50">
                                <div class="p-4 border-b">
                                    <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    @if($pendingTestDrives > 0)
                                        <a href="{{ route('admin.test-drives.index') }}" class="block p-4 hover:bg-gray-50 border-b">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $pendingTestDrives }} Test Drive Baru</p>
                                                    <p class="text-xs text-gray-500">Menunggu persetujuan</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    
                                    @if($pendingOrders > 0)
                                        <a href="{{ route('admin.orders.index') }}" class="block p-4 hover:bg-gray-50 border-b">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $pendingOrders }} Pesanan Baru</p>
                                                    <p class="text-xs text-gray-500">Menunggu persetujuan</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    
                                    @if($totalNotifications == 0)
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

                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
