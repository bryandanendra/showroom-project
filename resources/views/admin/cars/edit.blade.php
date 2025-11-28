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
                        <div class="mb-3">
                            <div class="relative w-48 group cursor-pointer overflow-hidden rounded-lg shadow-sm" onclick="if(confirm('Hapus gambar utama?')) deleteCarImage('{{ route('admin.cars.delete-main-image', $car) }}')">
                                <img src="{{ asset('storage/' . $car->main_image) }}" class="w-full h-32 object-cover transition duration-300 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                    <div class="transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center">
                                        <div class="bg-red-600 text-white p-2 rounded-full mb-1 shadow-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </div>
                                        <span class="text-white text-xs font-semibold px-2 py-1 bg-black bg-opacity-50 rounded">Hapus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="main_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Gambar utama yang akan ditampilkan di katalog</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Tambahan</label>
                    
                    @if($car->images->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            @foreach($car->images as $image)
                                <div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-sm" onclick="if(confirm('Hapus gambar ini?')) deleteCarImage('{{ route('admin.cars.delete-image', $image->id) }}')">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-32 object-cover transition duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                        <div class="transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center">
                                            <div class="bg-red-600 text-white p-2 rounded-full mb-1 shadow-lg">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </div>
                                            <span class="text-white text-xs font-semibold px-2 py-1 bg-black bg-opacity-50 rounded">Hapus</span>
                                        </div>
                                    </div>
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
</div>

<script>
    function deleteCarImage(url) {
        // Konfirmasi sudah dilakukan di inline onclick, jadi di sini langsung submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
