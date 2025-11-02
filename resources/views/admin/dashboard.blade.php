@extends('layouts.admin')

@section('title', 'Admin Dashboard - SMM AUTO GALLERY')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Admin</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Cars -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Mobil</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_cars'] }}</p>
                </div>
            </div>
        </div>

        <!-- Available Cars -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Mobil Tersedia</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['available_cars'] }}</p>
                </div>
            </div>
        </div>

        <!-- Sold Cars -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Mobil Terjual</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['sold_cars'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Test Drives -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Test Drive Pending</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_test_drives'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pesanan Pending</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total User</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Test Drives -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Test Drive Terbaru</h2>
                    <a href="{{ route('admin.test-drives.index') }}" class="text-sm text-red-600 hover:text-red-700 font-semibold">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentTestDrives->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentTestDrives as $testDrive)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">{{ $testDrive->user->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ $testDrive->car->brand ?? 'N/A' }} {{ $testDrive->car->model ?? '' }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($testDrive->test_drive_date)->format('d M Y') }} - {{ $testDrive->test_drive_time }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($testDrive->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($testDrive->status === 'approved') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($testDrive->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada test drive</p>
                @endif
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Pesanan Terbaru</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-red-600 hover:text-red-700 font-semibold">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">{{ $order->user->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->car->brand ?? 'N/A' }} {{ $order->car->model ?? '' }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->car->formatted_price ?? 'N/A' }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'approved') bg-green-100 text-green-800
                                    @elseif($order->status === 'completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada pesanan</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
