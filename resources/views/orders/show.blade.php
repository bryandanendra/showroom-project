@extends('layouts.app')

@section('title', 'Detail Pesanan - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-gray-700">Pesanan Saya</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Detail Pesanan</span>
        </nav>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
            <p class="text-gray-600 mt-1">Order #{{ $order->order_number }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Card -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Status Pesanan</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            @if($order->status === 'pending')
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    ⏰ Menunggu Konfirmasi
                                </span>
                            @elseif($order->status === 'processing')
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    🔄 Sedang Diproses
                                </span>
                            @elseif($order->status === 'completed')
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    ✅ Selesai
                                </span>
                            @else
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    ❌ Ditolak
                                </span>
                            @endif
                            <p class="text-sm text-gray-600 mt-2">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($order->admin_notes)
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-semibold text-gray-700 mb-1">Catatan Admin:</p>
                            <p class="text-sm text-gray-600">{{ $order->admin_notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Car Details -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Detail Mobil</h3>
                    <div class="flex items-start gap-4">
                        @if($order->car->main_image)
                            <img src="{{ asset('storage/' . $order->car->main_image) }}" alt="{{ $order->car->full_name }}" class="w-32 h-32 object-cover rounded-lg">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">{{ $order->car->brand }} {{ $order->car->model }}</h4>
                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p>📅 Tahun: {{ $order->car->year }}</p>
                                <p>🎨 Warna: {{ $order->car->color }}</p>
                                <p>⚙️ Transmisi: {{ ucfirst($order->car->transmission) }}</p>
                                <p>📏 Kilometer: {{ number_format($order->car->mileage) }} km</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Detail Pembayaran</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran</span>
                            <span class="font-semibold text-gray-900">
                                @if($order->payment_method === 'cash')
                                    💵 Cash (Tunai)
                                @elseif($order->payment_method === 'transfer')
                                    🏦 Transfer Bank
                                @else
                                    💳 Kredit/Leasing
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Mobil</span>
                            <span class="font-semibold text-gray-900">{{ $order->formatted_price }}</span>
                        </div>
                        @if($order->down_payment)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Uang Muka (DP)</span>
                                <span class="font-semibold text-green-600">{{ $order->formatted_down_payment }}</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t">
                                <span class="text-gray-600">Sisa Pembayaran</span>
                                <span class="font-semibold text-gray-900">{{ 'Rp ' . number_format($order->price - $order->down_payment, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between pt-3 border-t">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-red-600">{{ $order->formatted_total_price }}</span>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Dokumen</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">KTP</span>
                            </div>
                            <a href="{{ asset('storage/' . $order->id_card_path) }}" target="_blank" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                Lihat →
                            </a>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">SIM</span>
                            </div>
                            <a href="{{ asset('storage/' . $order->driver_license_path) }}" target="_blank" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                Lihat →
                            </a>
                        </div>
                        @if($order->credit_approval_path)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Bukti Approval Kredit</span>
                                </div>
                                <a href="{{ asset('storage/' . $order->credit_approval_path) }}" target="_blank" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                    Lihat →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($order->customer_notes)
                    <!-- Customer Notes -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Catatan Anda</h3>
                        <p class="text-gray-600">{{ $order->customer_notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-lg rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Kontak</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600 mb-1">Showroom</p>
                            <p class="font-semibold text-gray-900">SMM AUTO GALLERY</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Telepon</p>
                            <a href="tel:02112345678" class="font-semibold text-red-600 hover:text-red-700">(021) 1234-5678</a>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">WhatsApp</p>
                            <a href="https://wa.me/6281234567890" target="_blank" class="font-semibold text-red-600 hover:text-red-700">0812-3456-7890</a>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Email</p>
                            <a href="mailto:info@showroom.com" class="font-semibold text-red-600 hover:text-red-700">info@showroom.com</a>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <p class="text-xs text-gray-500">
                            💡 <strong>Info:</strong> Admin akan menghubungi Anda dalam 1x24 jam untuk proses selanjutnya.
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('orders.index') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-lg font-semibold text-center transition">
                            ← Kembali ke Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
