@extends('layouts.app')

@section('title', 'Dashboard - SMM AUTO GALLERY')

@section('content')
<div class="bg-gray-50 py-8 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 px-4 sm:px-0">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Dashboard</span>
        </nav>

        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 border-l-4 border-red-600">
                <h3 class="text-2xl font-bold mb-2 text-gray-900">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-gray-600">Kelola test drive, pesanan, dan profil Anda</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Test Drive & Orders -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Test Drive Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Test Drive Saya
                            </h3>
                            <a href="{{ route('test-drive.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $testDrives = auth()->user()->testDrives()->with('car')->latest()->take(3)->get();
                        @endphp
                        
                        @if($testDrives->count() > 0)
                            <div class="space-y-4">
                                @foreach($testDrives as $testDrive)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900">{{ $testDrive->car->full_name }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    📅 {{ \Carbon\Carbon::parse($testDrive->test_drive_date)->format('d M Y, H:i') }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    📍 {{ $testDrive->location }}
                                                </p>
                                            </div>
                                            @if($testDrive->status == 'approved')
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @elseif($testDrive->status == 'completed')
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @elseif($testDrive->status == 'pending')
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-gray-500">Belum ada jadwal test drive</p>
                                <a href="{{ route('test-drive.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                                    Jadwalkan Test Drive
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Orders Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Pesanan Saya
                            </h3>
                            <a href="{{ route('orders.index') }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $orders = auth()->user()->orders()->with('car')->latest()->take(3)->get();
                        @endphp
                        
                        @if($orders->count() > 0)
                            <div class="space-y-4">
                                @foreach($orders as $order)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900">{{ $order->car->full_name }}</h4>
                                                <p class="text-lg text-red-600 font-bold mt-1">{{ $order->formatted_total_price }}</p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    📅 {{ $order->created_at->format('d M Y') }}
                                                </p>
                                            </div>
                                            @if($order->status == 'completed')
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @elseif($order->status == 'processing')
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                            @elseif($order->status == 'pending')
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-gray-500">Belum ada pesanan</p>
                                <a href="{{ route('catalog.index') }}" class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                                    Lihat Katalog
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: User Profile -->
            <div class="lg:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil Saya
                        </h3>
                    </div>
                    <div class="p-6">
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="08xxxxxxxxxx">
                            </div>

                            <div class="border-t pt-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Ganti Password</h4>
                                
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                                        <input type="password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Kosongkan jika tidak ingin ganti">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                        <input type="password" name="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Minimal 8 karakter">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                        <input type="password" name="new_password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Ketik ulang password baru">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 mt-4 text-white py-3 rounded-lg font-semibold transition">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
