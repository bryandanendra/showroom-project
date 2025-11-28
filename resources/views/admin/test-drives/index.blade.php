@extends('layouts.admin')

@section('title', 'Kelola Test Drive - Admin')

@section('content')
<div class="p-3 md:p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Kelola Test Drive</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Table Wrapper - Scrollable on Mobile -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal & Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($testDrives as $testDrive)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $testDrive->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $testDrive->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $testDrive->car->brand }} {{ $testDrive->car->model }}</div>
                            <div class="text-sm text-gray-500">{{ $testDrive->car->year }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($testDrive->test_drive_date)->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $testDrive->test_drive_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($testDrive->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($testDrive->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($testDrive->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($testDrive->status === 'pending')
                                <form action="{{ route('admin.test-drives.approve', $testDrive) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Setujui</button>
                                </form>
                                <button onclick="showRejectModal({{ $testDrive->id }})" class="text-red-600 hover:text-red-900">Tolak</button>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $testDrives->links() }}
    </div>
</div>

<script>
function showRejectModal(id) {
    const notes = prompt('Alasan penolakan:');
    if (notes) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/test-drives/' + id + '/reject';
        form.innerHTML = '@csrf @method("PATCH") <input type="hidden" name="admin_notes" value="' + notes + '">';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
