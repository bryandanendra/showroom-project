@extends('layouts.app')

@section('title', 'Jadwalkan Test Drive - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('test-drive.index') }}" class="text-gray-500 hover:text-gray-700">Test Drive Saya</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Jadwalkan Test Drive</span>
        </nav>

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Jadwalkan Test Drive</h1>
            <p class="text-gray-600 mt-1">Isi form di bawah untuk menjadwalkan test drive</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('test-drive.store') }}" method="POST">
                @csrf

                <!-- Car Selection -->
                <div class="mb-6">
                    <label for="car_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Mobil *</label>
                    <select name="car_id" id="car_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('car_id') border-red-500 @enderror">
                        <option value="">-- Pilih Mobil --</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}" {{ old('car_id', $selectedCarId) == $car->id ? 'selected' : '' }}>
                                {{ $car->brand }} {{ $car->model }} ({{ $car->year }}) - {{ $car->formatted_price }}
                            </option>
                        @endforeach
                    </select>
                    @error('car_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div class="mb-6">
                    <label for="test_drive_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Test Drive *</label>
                    <input type="date" name="test_drive_date" id="test_drive_date" value="{{ old('test_drive_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('test_drive_date') border-red-500 @enderror">
                    @error('test_drive_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Minimal H+1 dari hari ini</p>
                </div>

                <!-- Time -->
                <div class="mb-6">
                    <label for="test_drive_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Test Drive *</label>
                    <select name="test_drive_time" id="test_drive_time" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('test_drive_time') border-red-500 @enderror">
                        <option value="">-- Pilih Waktu --</option>
                        <option value="09:00" {{ old('test_drive_time') == '09:00' ? 'selected' : '' }}>09:00 WIB</option>
                        <option value="10:00" {{ old('test_drive_time') == '10:00' ? 'selected' : '' }}>10:00 WIB</option>
                        <option value="11:00" {{ old('test_drive_time') == '11:00' ? 'selected' : '' }}>11:00 WIB</option>
                        <option value="13:00" {{ old('test_drive_time') == '13:00' ? 'selected' : '' }}>13:00 WIB</option>
                        <option value="14:00" {{ old('test_drive_time') == '14:00' ? 'selected' : '' }}>14:00 WIB</option>
                        <option value="15:00" {{ old('test_drive_time') == '15:00' ? 'selected' : '' }}>15:00 WIB</option>
                        <option value="16:00" {{ old('test_drive_time') == '16:00' ? 'selected' : '' }}>16:00 WIB</option>
                    </select>
                    @error('test_drive_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Test Drive</label>
                    <input type="text" name="location" id="location" value="{{ old('location', 'Showroom SMM AUTO GALLERY') }}" placeholder="Showroom atau alamat lain" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('location') border-red-500 @enderror">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Kosongkan jika ingin test drive di showroom</p>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                    <textarea name="notes" id="notes" rows="4" placeholder="Catatan atau permintaan khusus..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Catatan:</strong> Booking test drive akan dikonfirmasi oleh admin kami. Anda akan menerima notifikasi melalui email atau WhatsApp.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        Jadwalkan Test Drive
                    </button>
                    <a href="{{ route('test-drive.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
