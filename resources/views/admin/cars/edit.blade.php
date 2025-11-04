@extends('layouts.admin')

@section('title', 'Edit Mobil - Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Mobil: {{ $car->brand }} {{ $car->model }}</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $car->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                    <input type="text" name="brand" value="{{ $car->brand }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                    <input type="text" name="model" value="{{ $car->model }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                    <input type="number" name="year" value="{{ $car->year }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna *</label>
                    <input type="text" name="color" value="{{ $car->color }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                    <select name="transmission" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="manual" {{ $car->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="automatic" {{ $car->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar *</label>
                    <select name="fuel_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="bensin" {{ $car->fuel_type == 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ $car->fuel_type == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="hybrid" {{ $car->fuel_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="electric" {{ $car->fuel_type == 'electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kilometer *</label>
                    <input type="number" name="mileage" value="{{ $car->mileage }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                    <input type="number" name="price" value="{{ $car->price }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plat Nomor</label>
                    <input type="text" name="license_plate" value="{{ $car->license_plate }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mesin (cc)</label>
                    <input type="number" name="engine_capacity" value="{{ $car->engine_capacity }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penumpang *</label>
                    <input type="number" name="passengers" value="{{ $car->passengers }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi *</label>
                    <select name="condition" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="excellent" {{ $car->condition == 'excellent' ? 'selected' : '' }}>Excellent</option>
                        <option value="good" {{ $car->condition == 'good' ? 'selected' : '' }}>Good</option>
                        <option value="fair" {{ $car->condition == 'fair' ? 'selected' : '' }}>Fair</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="reserved" {{ $car->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="sold" {{ $car->status == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                    @if($car->main_image)
                        <img src="{{ asset('storage/' . $car->main_image) }}" class="w-32 h-32 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="main_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Gambar utama yang akan ditampilkan di katalog</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Tambahan</label>
                    
                    @if($car->images->count() > 0)
                        <div class="grid grid-cols-4 gap-4 mb-4">
                            @foreach($car->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-32 object-cover rounded">
                                    <form action="{{ route('admin.cars.delete-image', $image->id) }}" method="POST" class="absolute top-1 right-1" onsubmit="return confirm('Hapus gambar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white rounded-full p-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <input type="file" name="images[]" accept="image/*" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Tambah gambar baru untuk carousel (Max: 2MB per gambar)</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $car->description }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fitur (pisahkan dengan koma)</label>
                    <textarea name="features" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $car->features }}</textarea>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Update Mobil
                </button>
                <a href="{{ route('admin.cars.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
