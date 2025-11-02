@extends('layouts.app')

@section('title', 'Test Drive Saya - SMM AUTO GALLERY')

@section('content')
<div class="bg-white py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-900 font-medium">Test Drive Saya</span>
        </nav>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Test Drive Saya</h1>
                <p class="text-gray-600 mt-1">Kelola jadwal test drive Anda</p>
            </div>
            <a href="{{ route('test-drive.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                + Jadwalkan Test Drive
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($testDrives->count() > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Mobil</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6">Tanggal & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/8">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">Catatan Admin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($testDrives as $testDrive)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($testDrive->car->main_image)
                                                <img class="h-12 w-12 rounded object-cover" src="{{ asset('storage/' . $testDrive->car->main_image) }}" alt="{{ $testDrive->car->full_name }}">
                                            @else
                                                <div class="h-12 w-12 rounded bg-gray-200 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $testDrive->car->brand }} {{ $testDrive->car->model }}</div>
                                            <div class="text-sm text-gray-500">{{ $testDrive->car->year }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($testDrive->test_drive_date)->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($testDrive->test_drive_date)->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $testDrive->location ?? 'Showroom SMM AUTO GALLERY' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($testDrive->status === 'pending')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($testDrive->status === 'approved')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ $testDrive->admin_notes ?? '-' }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $testDrives->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="mt-2 text-xl font-semibold text-gray-900">Belum ada test drive</h3>
                <p class="mt-1 text-gray-500">Jadwalkan test drive untuk mobil yang Anda minati</p>
                <div class="mt-6">
                    <a href="{{ route('test-drive.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Jadwalkan Test Drive
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
