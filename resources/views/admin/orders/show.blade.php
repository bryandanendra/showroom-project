@extends('layouts.admin')

@section('title', 'Nota-' . $order->order_number . '-' . $order->user->name)

@section('content')
<!-- Print Styles v2.0 -->
<style>
    @media print {
        /* Hide admin layout completely */
        aside, nav, header, button, .print\:hidden {
            display: none !important;
            visibility: hidden !important;
        }
        
        /* Force white background and remove scrollbar */
        body, html {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Remove all scrollbars */
        * {
            overflow: visible !important;
            max-width: 100% !important;
        }
        
        /* Print color adjustment */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        /* Page setup */
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
        
        .print-company-name {
            font-size: 24px;
            font-weight: bold;
            color: #dc2626;
        }
        
        .print-tagline {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }
        
        .print-header-info {
            text-align: right;
            font-size: 11px;
            line-height: 1.4;
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
        
        .print-footer {
            display: block !important;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
        
        /* Adjust main content */
        .p-6 {
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .grid {
            display: block !important;
            width: 100% !important;
        }
        
        .shadow {
            box-shadow: none !important;
        }
        
        /* Fix container width */
        .lg\:grid-cols-2 {
            grid-template-columns: 1fr !important;
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
    }
    
    .print-header, .print-title, .print-order-info, .print-signature, .print-footer {
        display: none;
    }
</style>
<div class="p-6">
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

    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Pesanan</h1>
            <p class="text-gray-600">Order #{{ $order->order_number }}</p>
        </div>
        <button onclick="window.print()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2 print:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Cetak Nota
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Informasi Customer</h2>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm text-gray-500">Nama</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Email</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Telepon</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->user->phone }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Alamat</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->user->address }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Informasi Mobil</h2>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm text-gray-500">Mobil</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->car->brand }} {{ $order->car->model }} ({{ $order->car->year }})</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Harga</dt>
                    <dd class="text-lg font-bold text-red-600">{{ $order->formatted_price }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Metode Pembayaran</dt>
                    <dd class="text-sm font-medium text-gray-900">
                        @if($order->payment_method === 'cash')
                            💵 Cash (Tunai)
                        @elseif($order->payment_method === 'transfer')
                            🏦 Transfer Bank
                        @else
                            💳 Kredit/Leasing
                        @endif
                    </dd>
                </div>
                @if($order->down_payment)
                <div>
                    <dt class="text-sm text-gray-500">DP</dt>
                    <dd class="text-sm font-medium text-gray-900">Rp {{ number_format($order->down_payment, 0, ',', '.') }}</dd>
                </div>
                @endif
            </dl>
        </div>

        @if($order->credit_approval_path)
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h2 class="text-xl font-bold mb-4">Dokumen</h2>
            <div class="space-y-3">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 md:p-6 bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start md:items-center gap-3 md:gap-4 min-w-0 flex-1">
                            <div class="flex-shrink-0">
                                <svg class="w-10 h-10 md:w-12 md:h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-900">Bukti Approval Kredit</p>
                                <!-- <p class="text-xs text-gray-500 mt-1 break-all">{{ basename($order->credit_approval_path) }}</p> -->
                                <p class="text-xs text-gray-400 mt-1">
                                    Diupload: {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                            <a href="{{ route('admin.storage.approval.view', $order) }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                            <a href="{{ route('admin.storage.approval', $order) }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Timeline Pesanan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Timeline Pesanan</h2>
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

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Status Pesanan</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        @if($order->status === 'pending') ⏰ Menunggu
                        @elseif($order->status === 'processing') 🔄 Sedang Diproses
                        @elseif($order->status === 'completed') ✅ Selesai
                        @else ❌ Ditolak
                        @endif
                    </span>
                </div>
                @if($order->admin_notes)
                <div>
                    <p class="text-sm text-gray-500">Catatan Admin</p>
                    <p class="text-sm text-gray-900">{{ $order->admin_notes }}</p>
                </div>
                @endif
                @if($order->customer_notes)
                <div>
                    <p class="text-sm text-gray-500">Catatan Customer</p>
                    <p class="text-sm text-gray-900">{{ $order->customer_notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('admin.orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition">
            Kembali
        </a>
        @if($order->status === 'pending')
            <form action="{{ route('admin.orders.approve', $order) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Setujui Pesanan
                </button>
            </form>
        @elseif($order->status === 'processing')
            <form action="{{ route('admin.orders.complete', $order) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Selesaikan Pesanan
                </button>
            </form>
        @endif
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
@endsection
