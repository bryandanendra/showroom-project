@extends('layouts.admin')

@section('title', 'Tambah Mobil - Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Mobil Baru</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                    <input type="text" name="brand" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                    <input type="text" name="model" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                    <input type="number" name="year" required min="1900" max="{{ date('Y') + 1 }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna *</label>
                    <input type="text" name="color" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                    <select name="transmission" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="manual">Manual</option>
                        <option value="automatic">Automatic</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar *</label>
                    <select name="fuel_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="bensin">Bensin</option>
                        <option value="diesel">Diesel</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="electric">Electric</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kilometer *</label>
                    <input type="number" name="mileage" required min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                    <input type="number" name="price" required min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plat Nomor</label>
                    <input type="text" name="license_plate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mesin (cc)</label>
                    <input type="number" name="engine_capacity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penumpang *</label>
                    <input type="number" name="passengers" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi *</label>
                    <select name="condition" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="fair">Fair</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="available">Available</option>
                        <option value="reserved">Reserved</option>
                        <option value="sold">Sold</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                    <input type="file" name="main_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fitur (pisahkan dengan koma)</label>
                    <textarea name="features" rows="3" placeholder="ABS, Airbag, Power Steering, dll" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"></textarea>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Simpan Mobil
                </button>
                <a href="{{ route('admin.cars.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
