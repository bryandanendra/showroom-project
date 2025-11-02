@extends('layouts.app')

@section('title', $car->full_name . ' - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('catalog.index') }}" class="text-gray-500 hover:text-gray-700">Katalog</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900">{{ $car->brand }} {{ $car->model }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Image Gallery -->
            <div>
                <div class="bg-gray-200 rounded-lg overflow-hidden mb-4" style="height: 400px;">
                    @if($car->main_image)
                        <img src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->full_name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                @if($car->images->count() > 0)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($car->images as $image)
                            <div class="bg-gray-200 rounded overflow-hidden" style="height: 100px;">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Car image" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Car Details -->
            <div>
                <div class="mb-4">
                    <span class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $car->category->name }}
                    </span>
                    <span class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold ml-2">
                        {{ ucfirst($car->status) }}
                    </span>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $car->brand }} {{ $car->model }}</h1>
                <p class="text-xl text-gray-600 mb-6">Tahun {{ $car->year }}</p>

                <div class="bg-red-50 border-2 border-red-600 rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-600 mb-1">Harga</p>
                    <p class="text-4xl font-bold text-red-600">{{ $car->formatted_price }}</p>
                </div>

                <!-- Specifications -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Kilometer</p>
                        <p class="text-lg font-semibold">{{ number_format($car->mileage) }} km</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Transmisi</p>
                        <p class="text-lg font-semibold">{{ ucfirst($car->transmission) }}</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Bahan Bakar</p>
                        <p class="text-lg font-semibold">{{ ucfirst($car->fuel_type) }}</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Warna</p>
                        <p class="text-lg font-semibold">{{ $car->color }}</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Kapasitas Mesin</p>
                        <p class="text-lg font-semibold">{{ $car->engine_capacity }} cc</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Penumpang</p>
                        <p class="text-lg font-semibold">{{ $car->passengers }} orang</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 mb-6">
                    @auth
                        <a href="{{ route('test-drive.create') }}?car_id={{ $car->id }}" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center py-3 rounded-lg font-semibold transition">
                            Jadwalkan Test Drive
                        </a>
                        <a href="{{ route('orders.create', $car->id) }}" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white text-center py-3 rounded-lg font-semibold transition">
                            Pesan Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center py-3 rounded-lg font-semibold transition">
                            Login untuk Pesan
                        </a>
                    @endauth
                </div>

                <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $car->brand }} {{ $car->model }} {{ $car->year }}" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-lg font-semibold transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>

        <!-- Description & Features -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold mb-4">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">{{ $car->description }}</p>

                @if($car->features)
                    <h3 class="text-xl font-bold mt-6 mb-3">Fitur</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(explode(',', $car->features) as $feature)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ trim($feature) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4">Informasi Tambahan</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Kondisi</p>
                            <p class="font-semibold">{{ ucfirst($car->condition) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Plat Nomor</p>
                            <p class="font-semibold">{{ $car->license_plate ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <span class="inline-block bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-semibold">
                                {{ ucfirst($car->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Cars -->
        @if($similarCars->count() > 0)
            <div>
                <h2 class="text-2xl font-bold mb-6">Mobil Serupa</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach($similarCars as $similar)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                            <div class="relative h-40 bg-gray-200">
                                @if($similar->main_image)
                                    <img src="{{ asset('storage/' . $similar->main_image) }}" alt="{{ $similar->full_name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2">{{ $similar->brand }} {{ $similar->model }}</h3>
                                <p class="text-red-600 font-bold mb-3">{{ $similar->formatted_price }}</p>
                                <a href="{{ route('catalog.show', $similar->id) }}" class="block text-center bg-red-600 hover:bg-red-700 text-white py-2 rounded font-semibold text-sm transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
