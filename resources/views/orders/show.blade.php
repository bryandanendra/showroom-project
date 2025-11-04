@extends('layouts.app')

@section('title', 'Nota-' . $order->order_number . '-' . $order->user->name)

@section('content')
<!-- Print Styles v2.0 -->
<style>
    @media print {
        /* Hide elements when printing */
        nav, .print\:hidden, footer, button, aside, header, .breadcrumb {
            display: none !important;
            visibility: hidden !important;
        }
        
        /* Force hide Tailwind utilities */
        .bg-gray-50, .py-8, .min-h-screen {
            background: white !important;
        }
        
        /* Adjust layout for print and remove scrollbar */
        body {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
            font-size: 12pt !important;
            overflow: hidden !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Remove all scrollbars */
        * {
            overflow: visible !important;
            max-width: 100% !important;
        }
        
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        .bg-white, .bg-gray-50 {
            box-shadow: none !important;
            border: none !important;
        }
        
        /* Make sure content fits on page */
        .max-w-5xl {
            max-width: 100% !important;
            padding: 0 !important;
        }
        
        /* Adjust grid for print */
        .lg\:grid-cols-3 {
            grid-template-columns: 1fr !important;
        }
        
        .lg\:col-span-2 {
            grid-column: span 1 !important;
        }
        
        /* Add page breaks */
        .shadow-lg {
            page-break-inside: avoid;
            margin-bottom: 15px;
        }
        
        /* Print header */
        @page {
            margin: 1.5cm;
            size: A4;
        }
        
        /* Hide URL and page numbers in print */
        @page {
            margin-top: 1.5cm;
            margin-bottom: 1.5cm;
        }
        
        /* Remove header and footer from print */
        body::before,
        body::after {
            display: none !important;
        }
        
        /* Hide browser default header/footer */
        html {
            margin: 0 !important;
        }
        
        /* Show print header */
        .print-header {
            display: block !important;
            border-bottom: 3px solid #dc2626;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .print-header-logo {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .print-header-info {
            text-align: right;
            font-size: 11px;
            line-height: 1.4;
        }
        
        .print-company-name {
            font-size: 24px;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 5px;
        }
        
        .print-tagline {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }
        
        .print-title {
            display: block !important;
            text-align: center;
            background: #dc2626;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            letter-spacing: 2px;
        }
        
        .print-order-info {
            display: flex !important;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background: #f3f4f6;
            border-left: 4px solid #dc2626;
        }
        
        .print-section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        
        .print-section-title {
            background: #f9fafb;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 14px;
            border-left: 4px solid #dc2626;
            margin-bottom: 10px;
        }
        
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .print-table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .print-table td:first-child {
            width: 35%;
            color: #6b7280;
            font-weight: 500;
        }
        
        .print-footer {
            display: block !important;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
        
        .print-signature {
            display: flex !important;
            justify-content: space-between;
            margin-top: 50px;
            padding: 0 40px;
        }
        
        .print-signature-box {
            text-align: center;
            width: 200px;
        }
        
        .print-signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 5px;
        }
        
        /* Hide sidebar on print */
        .lg\:col-span-1 {
            display: none !important;
        }
        
        /* Price highlight */
        .print-total {
            background: #fef2f2;
            padding: 15px;
            border: 2px solid #dc2626;
            margin-top: 10px;
        }
        
        /* Fix container width */
        .max-w-5xl {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }
        
        .lg\:col-span-2 {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .rounded-lg {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        
        /* Ensure content fits */
        .bg-white {
            width: 100% !important;
            max-width: 100% !important;
            overflow: hidden !important;
        }
        
        .shadow-lg {
            width: 100% !important;
            max-width: 100% !important;
        }
    }
    
    .print-header, .print-title, .print-order-info, .print-footer, .print-signature {
        display: none;
    }
</style>
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 print:hidden">
                {{ session('success') }}
            </div>
        @endif

        <!-- Print Header - Kop Surat -->
        <div class="print-header" style="display: none;">
            <div class="print-header-logo" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <div>
                    <div class="print-company-name" style="font-size: 24px; font-weight: bold; color: #dc2626; margin-bottom: 5px;">SMM AUTO GALLERY</div>
                    <div class="print-tagline" style="font-size: 12px; color: #666; font-style: italic;">Premium Used Cars - Your Trusted Partner</div>
                </div>
                <div class="print-header-info" style="text-align: right; font-size: 11px; line-height: 1.4;">
                    <div><strong>Alamat:</strong> Jl. Showroom No. 123, Jakarta Selatan 12345</div>
                    <div><strong>Telp:</strong> (021) 1234-5678 | <strong>HP:</strong> 0812-3456-7890</div>
                    <div><strong>Email:</strong> info@smmautogallery.com | <strong>Web:</strong> www.smmautogallery.com</div>
                </div>
            </div>
        </div>

        <!-- Print Title -->
        <div class="print-title" style="display: none;">NOTA PEMESANAN KENDARAAN</div>

        <!-- Print Order Info -->
        <div class="print-order-info" style="display: none;">
            <div>
                <div><strong>No. Transaksi:</strong> {{ $order->order_number }}</div>
                <div><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y') }}</div>
            </div>
            <div style="text-align: right;">
                <div><strong>Status:</strong> 
                    @if($order->status === 'completed')
                        <span style="color: #16a34a;">✓ SELESAI</span>
                    @elseif($order->status === 'processing')
                        <span style="color: #2563eb;">⟳ DIPROSES</span>
                    @elseif($order->status === 'pending')
                        <span style="color: #ca8a04;">⏱ PENDING</span>
                    @else
                        <span style="color: #dc2626;">✗ DITOLAK</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-6 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                <p class="text-gray-600 mt-1">Order #{{ $order->order_number }}</p>
            </div>
            <button onclick="window.print()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2 print:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Nota
            </button>
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

                <!-- Timeline Pesanan -->
                <div class="bg-white shadow-lg rounded-lg p-6 print-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 print-section-title">Timeline Pesanan</h3>
                    <div class="space-y-4">
                        <!-- Pesanan Dibuat -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-semibold text-gray-900">Pesanan Dibuat</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Disetujui/Diproses -->
                        @if($order->approved_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Pesanan Disetujui</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($order->approved_at)->format('d M Y, H:i') }} WIB</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($order->approved_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Selesai -->
                        @if($order->completed_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Pesanan Selesai</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($order->completed_at)->format('d M Y, H:i') }} WIB</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($order->completed_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif

                        @if($order->status === 'rejected')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Pesanan Ditolak</p>
                                    <p class="text-sm text-gray-600">{{ $order->updated_at->format('d M Y, H:i') }} WIB</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $order->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Car Details -->
                <div class="bg-white shadow-lg rounded-lg p-6 print-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 print-section-title">Detail Mobil</h3>
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
                <div class="bg-white shadow-lg rounded-lg p-6 print-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 print-section-title">Detail Pembayaran</h3>
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
                @if($order->credit_approval_path)
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Dokumen</h3>
                        <div class="space-y-3">
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
                        </div>
                    </div>
                @endif

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

        <!-- Print Signature -->
        <div class="print-signature" style="display: none;">
            <div class="print-signature-box" style="text-align: center; width: 200px;">
                <div style="font-weight: bold; margin-bottom: 5px;">Pihak Pertama</div>
                <div style="font-size: 11px; color: #6b7280;">(Pembeli)</div>
                <div class="print-signature-line" style="border-top: 1px solid #000; margin-top: 60px; padding-top: 5px;">
                    {{ $order->user->name }}
                </div>
            </div>
            <div class="print-signature-box" style="text-align: center; width: 200px;">
                <div style="font-weight: bold; margin-bottom: 5px;">Pihak Kedua</div>
                <div style="font-size: 11px; color: #6b7280;">(SMM AUTO GALLERY)</div>
                <div class="print-signature-line" style="border-top: 1px solid #000; margin-top: 60px; padding-top: 5px;">
                    Authorized Signature
                </div>
            </div>
        </div>

        <!-- Print Footer -->
        <div class="print-footer" style="display: none;">
            <div style="margin-bottom: 10px; font-weight: 600; color: #374151;">Terima kasih atas kepercayaan Anda</div>
            <div style="margin-bottom: 5px;">Dokumen ini adalah bukti sah transaksi pemesanan kendaraan</div>
            <div>SMM AUTO GALLERY - Premium Used Cars | Est. 2020</div>
            <div style="margin-top: 10px; font-size: 9px;">
                Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB
            </div>
        </div>
    </div>
</div>
@endsection
