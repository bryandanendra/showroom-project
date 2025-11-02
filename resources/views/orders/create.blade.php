@extends('layouts.app')

@section('title', 'Pesan Mobil - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('catalog.index') }}" class="text-gray-500 hover:text-gray-700">Katalog</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('catalog.show', $car) }}" class="text-gray-500 hover:text-gray-700">{{ $car->brand }} {{ $car->model }}</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Pesan Mobil</span>
        </nav>

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Pesan Mobil</h1>
            <p class="text-gray-600 mt-1">Lengkapi data pemesanan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pemesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    @if($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">

                        <!-- Metode Pembayaran -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran *</label>
                            <div class="space-y-3">
                                <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="payment_method" value="cash" class="mt-1" required>
                                    <div class="ml-3">
                                        <div class="font-semibold text-gray-900">💵 Cash (Tunai)</div>
                                        <p class="text-sm text-gray-600">Pembayaran langsung dengan uang tunai</p>
                                    </div>
                                </label>

                                <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="payment_method" value="transfer" class="mt-1" required>
                                    <div class="ml-3">
                                        <div class="font-semibold text-gray-900">🏦 Transfer Bank</div>
                                        <p class="text-sm text-gray-600">Transfer ke rekening showroom</p>
                                    </div>
                                </label>

                                <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="payment_method" value="credit" class="mt-1" required>
                                    <div class="ml-3">
                                        <div class="font-semibold text-gray-900">💳 Kredit/Leasing</div>
                                        <p class="text-sm text-gray-600">Cicilan melalui bank atau leasing (Upload bukti approval dari bank)</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Down Payment (Optional) -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Uang Muka (DP) - Opsional</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                                <input type="number" name="down_payment" min="0" step="1000000" 
                                    class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika pembayaran penuh</p>
                        </div>

                        <!-- Upload KTP -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload KTP *</label>
                            <input type="file" name="id_card_path" accept="image/*,application/pdf" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, atau PDF (Max: 2MB)</p>
                        </div>

                        <!-- Upload SIM -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload SIM *</label>
                            <input type="file" name="driver_license_path" accept="image/*,application/pdf" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, atau PDF (Max: 2MB)</p>
                        </div>

                        <!-- Upload Bukti Approval Bank (untuk kredit) -->
                        <div class="mb-6" id="credit-approval-section" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Approval Bank/Leasing</label>
                            <input type="file" name="credit_approval_path" accept="image/*,application/pdf"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Upload surat persetujuan kredit dari bank/leasing (Format: JPG, PNG, atau PDF, Max: 2MB)</p>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                            <textarea name="customer_notes" rows="4" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                placeholder="Tulis catatan atau permintaan khusus..."></textarea>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-6">
                            <label class="flex items-start">
                                <input type="checkbox" required class="mt-1">
                                <span class="ml-2 text-sm text-gray-600">
                                    Saya menyetujui <a href="#" class="text-red-600 hover:text-red-700">syarat dan ketentuan</a> yang berlaku
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4">
                            <a href="{{ route('catalog.show', $car) }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-lg font-semibold text-center transition">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                                Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Mobil -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-lg rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                    
                    @if($car->main_image)
                        <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->full_name }}" class="w-full h-40 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    @endif

                    <h4 class="font-bold text-gray-900 mb-2">{{ $car->brand }} {{ $car->model }}</h4>
                    <p class="text-sm text-gray-600 mb-4">{{ $car->year }} • {{ ucfirst($car->transmission) }}</p>

                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Harga</span>
                            <span class="font-semibold text-gray-900">{{ $car->formatted_price }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Kilometer</span>
                            <span class="text-gray-900">{{ number_format($car->mileage) }} km</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Kondisi</span>
                            <span class="text-gray-900">{{ ucfirst($car->condition) }}</span>
                        </div>
                    </div>

                    <div class="border-t mt-4 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-900 font-semibold">Total Harga</span>
                            <span class="text-2xl font-bold text-red-600">{{ $car->formatted_price }}</span>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-xs text-blue-800">
                            <strong>💡 Info:</strong> Setelah pesanan dikirim, admin akan menghubungi Anda untuk proses selanjutnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show/hide credit approval section
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const creditSection = document.getElementById('credit-approval-section');
            const creditInput = document.querySelector('input[name="credit_approval_path"]');
            
            if (this.value === 'credit') {
                creditSection.style.display = 'block';
                creditInput.required = true;
            } else {
                creditSection.style.display = 'none';
                creditInput.required = false;
            }
        });
    });
</script>
@endsection
