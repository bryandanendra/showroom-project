@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Detail Pesanan #{{ $order->id }}</h1>

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

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Dokumen</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500 mb-2">KTP</p>
                    @if($order->id_card_path)
                        <a href="{{ asset('storage/' . $order->id_card_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">📄 Lihat KTP</a>
                    @else
                        <p class="text-sm text-gray-400">Tidak ada</p>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-2">SIM</p>
                    @if($order->driver_license_path)
                        <a href="{{ asset('storage/' . $order->driver_license_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">📄 Lihat SIM</a>
                    @else
                        <p class="text-sm text-gray-400">Tidak ada</p>
                    @endif
                </div>
                @if($order->credit_approval_path)
                <div>
                    <p class="text-sm text-gray-500 mb-2">Bukti Approval Kredit</p>
                    <a href="{{ asset('storage/' . $order->credit_approval_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">📄 Lihat Bukti Approval</a>
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
</div>
@endsection
