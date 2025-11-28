@extends('layouts.app')

@section('title', 'Katalog Mobil - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Katalog</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">Katalog Mobil Bekas</h1>
        <p class="text-gray-600 mb-8">Temukan mobil impian Anda dari koleksi kami</p>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filter -->
            <aside class="lg:w-64 flex-shrink-0">
                <form method="GET" action="{{ route('catalog.index') }}" class="bg-gray-50 rounded-lg p-6 sticky top-20">
                    <h3 class="font-bold text-lg mb-4">Filter</h3>
                    
                    <!-- Category Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->cars_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                        <input type="text" name="brand" value="{{ request('brand') }}" placeholder="Toyota, Honda, dll" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>

                    <!-- Price Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimal</label>
                        <input type="text" 
                               name="max_price_display" 
                               id="max_price_catalog" 
                               value="{{ request('max_price') ? number_format(request('max_price'), 0, ',', ',') : '' }}" 
                               placeholder="Rp 500,000,000" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                               data-rupiah-input
                               autocomplete="off">
                        <input type="hidden" name="max_price" id="max_price_value_catalog" value="{{ request('max_price') }}">
                    </div>

                    <!-- Transmission Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi</label>
                        <select name="transmission" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <option value="">Semua</option>
                            <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                            <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                        </select>
                    </div>

                    <!-- Fuel Type Filter -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar</label>
                        <select name="fuel_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <option value="">Semua</option>
                            <option value="bensin" {{ request('fuel_type') == 'bensin' ? 'selected' : '' }}>Bensin</option>
                            <option value="diesel" {{ request('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="hybrid" {{ request('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('catalog.index') }}" class="block text-center text-sm text-gray-600 hover:text-gray-900 mt-3">
                        Reset Filter
                    </a>
                </form>
            </aside>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Sort & Count -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Menampilkan {{ $cars->count() }} dari {{ $cars->total() }} mobil</p>
                    <form method="GET" action="{{ route('catalog.index') }}" class="flex items-center gap-2">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <label class="text-sm text-gray-600">Urutkan:</label>
                        <select name="sort" data-auto-submit class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 text-sm">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="year_new" {{ request('sort') == 'year_new' ? 'selected' : '' }}>Tahun Terbaru</option>
                            <option value="mileage_low" {{ request('sort') == 'mileage_low' ? 'selected' : '' }}>KM Terendah</option>
                        </select>
                    </form>
                </div>

                <!-- Cars Grid -->
                @if($cars->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($cars as $car)
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
                                <div class="p-5">
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

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $cars->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada mobil ditemukan</h3>
                        <p class="text-gray-500 mb-4">Coba ubah filter pencarian Anda</p>
                        <a href="{{ route('catalog.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
