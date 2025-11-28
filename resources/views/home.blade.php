@extends('layouts.app')

@section('title', 'Beranda - SMM AUTO GALLERY')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gray-900 text-white">
    <div class="absolute inset-0 bg-gradient-to-r from-red-600/20 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold mb-6">
                Temukan Mobil Bekas <span class="text-red-500">Berkualitas</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8">
                Pilihan mobil bekas terpercaya dengan harga kompetitif. Kondisi terawat, siap pakai.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('catalog.index') }}" class="bg-red-600 hover:bg-red-700 px-8 py-3 rounded-lg font-semibold transition">
                    Lihat Katalog
                </a>
                <a href="{{ route('test-drive.index') }}" class="bg-white text-gray-900 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">
                    Jadwalkan Test Drive
                </a>
            </div>
        </div>
    </div>
    <!-- Carbon fiber pattern overlay -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>
</section>

<!-- Search Section -->
<section class="bg-white shadow-lg -mt-8 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form action="{{ route('catalog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                <input type="text" name="brand" placeholder="Toyota, Honda, dll" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimal</label>
                <input type="text" 
                       name="max_price_display" 
                       id="max_price_home" 
                       placeholder="Rp 500,000,000" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                       data-rupiah-input
                       autocomplete="off">
                <input type="hidden" name="max_price" id="max_price_value_home">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Cari Mobil
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Categories Section -->
<!-- <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Mobil</h2>
            <p class="text-gray-600">Pilih kategori sesuai kebutuhan Anda</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('catalog.index', ['category' => $category->id]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-600 transition">
                        <svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-red-600">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->cars_count ?? 0 }} mobil</p>
                </a>
            @endforeach
        </div>
    </div>
</section> -->

<!-- Featured Cars Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Mobil Tersedia</h2>
                <p class="text-gray-600">Pilihan mobil bekas berkualitas</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="text-red-600 hover:text-red-700 font-semibold flex items-center">
                Lihat Semua
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredCars as $car)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition group">
                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                        @if($car->main_image)
                            <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->full_name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            {{ ucfirst($car->condition) }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">{{ $car->category->name }}</span>
                            <span class="text-sm text-gray-500">{{ $car->year }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $car->brand }} {{ $car->model }}</h3>
                        <div class="flex items-center text-sm text-gray-600 mb-4 space-x-4">
                            <span>{{ number_format($car->mileage) }} km</span>
                            <span>{{ ucfirst($car->transmission) }}</span>
                            <span>{{ ucfirst($car->fuel_type) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-red-600">{{ $car->formatted_price }}</p>
                            </div>
                            <a href="{{ route('catalog.show', $car->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Mengapa Memilih Kami?</h2>
            <p class="text-gray-400">Komitmen kami untuk kepuasan pelanggan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Kualitas Terjamin</h3>
                <p class="text-gray-400 text-sm">Semua mobil telah melalui inspeksi ketat</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Harga Kompetitif</h3>
                <p class="text-gray-400 text-sm">Harga terbaik di kelasnya</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Proses Mudah</h3>
                <p class="text-gray-400 text-sm">Pembelian cepat dan transparan</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Layanan Purna Jual</h3>
                <p class="text-gray-400 text-sm">Dukungan setelah pembelian</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Menemukan Mobil Impian Anda?</h2>
        <p class="text-xl mb-8 text-red-100">Hubungi kami sekarang atau kunjungi showroom kami</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                WhatsApp
            </a>
            <a href="tel:+622112345678" class="bg-gray-900 hover:bg-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                Telepon Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
