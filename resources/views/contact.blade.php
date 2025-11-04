@extends('layouts.app')

@section('title', 'Kontak Kami - SMM AUTO GALLERY')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-xl text-gray-300">Kami siap membantu Anda menemukan mobil impian</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Lokasi & Informasi Kontak</h2>
        
        <div class="flex flex-col md:flex-row gap-8 items-stretch">
            <!-- Google Maps - Kiri (Desktop) / Atas (Mobile) -->
            <div class="w-full md:w-1/2 flex-shrink-0">
                <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg h-full min-h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.1944491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1234567890"
                        width="100%" 
                        height="100%" 
                        style="border:0; pointer-events: none;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Informasi Kontak - Kanan (Desktop) / Bawah (Mobile) -->
            <div class="w-full md:w-1/2 flex-shrink-0">
                <div class="grid grid-cols-2 gap-6">
                    <!-- Alamat -->
                    <div class="flex flex-col items-start">
                        <div class="flex-shrink-0 mb-3">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                            <p class="text-gray-600">Jl. Showroom No. 123<br>Jakarta Selatan 12345<br>Indonesia</p>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="flex flex-col items-start">
                        <div class="flex-shrink-0 mb-3">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                            <div class="text-gray-600 space-y-1">
                                <p>Senin - Jumat: 09:00 - 18:00</p>
                                <p>Sabtu: 09:00 - 16:00</p>
                                <p>Minggu: Tutup</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-red-600 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Menemukan Mobil Impian Anda?</h2>
        <p class="text-xl text-white mb-8">Kunjungi showroom kami atau hubungi tim kami untuk konsultasi gratis</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('catalog.index') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition">
                Lihat Katalog
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                Chat WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
