@extends('layouts.admin')

@section('title', 'Kelola Mobil - Admin')

@section('content')
<div class="p-3 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Mobil</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
            + Tambah Mobil
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Table Wrapper - Scrollable on Mobile -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cars as $car)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-16 w-16 flex-shrink-0">
                                    @if($car->main_image)
                                        <img class="h-16 w-16 rounded object-cover" src="{{ asset('storage/' . $car->main_image) }}" alt="{{ $car->full_name }}">
                                    @else
                                        <div class="h-16 w-16 rounded bg-gray-200"></div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $car->brand }} {{ $car->model }}</div>
                                    <div class="text-sm text-gray-500">{{ $car->year }} • {{ number_format($car->mileage) }} km</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $car->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $car->formatted_price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($car->status === 'available') bg-green-100 text-green-800
                                @elseif($car->status === 'sold') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($car->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus mobil ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $cars->links() }}
    </div>
</div>
@endsection
