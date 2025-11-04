@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Kelola Pesanan</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Transaksi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode Bayar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-mono font-semibold text-gray-900">{{ $order->order_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $order->car->brand }} {{ $order->car->model }}</div>
                            <div class="text-sm text-gray-500">{{ $order->car->year }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $order->formatted_price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($order->payment_method === 'cash')
                                💵 Cash
                            @elseif($order->payment_method === 'transfer')
                                🏦 Transfer
                            @else
                                💳 Kredit
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                @if($order->status === 'pending') Menunggu
                                @elseif($order->status === 'processing') Diproses
                                @elseif($order->status === 'completed') Selesai
                                @else Ditolak
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                            @if($order->status === 'pending')
                                <form action="{{ route('admin.orders.approve', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Setujui</button>
                                </form>
                                <button onclick="showRejectModal({{ $order->id }})" class="text-red-600 hover:text-red-900">Tolak</button>
                            @elseif($order->status === 'processing')
                                <form action="{{ route('admin.orders.complete', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-600 hover:text-blue-900">Selesaikan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>

<script>
function showRejectModal(id) {
    const notes = prompt('Alasan penolakan:');
    if (notes) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/orders/' + id + '/reject';
        form.innerHTML = '@csrf @method("PATCH") <input type="hidden" name="admin_notes" value="' + notes + '">';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
