<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'car'])->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'car']);
        return view('admin.orders.show', compact('order'));
    }

    public function approve(Request $request, Order $order)
    {
        $order->update([
            'status' => 'processing',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Pesanan berhasil disetujui dan sedang diproses!');
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $order->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        $order->car->update(['status' => 'available']);

        return back()->with('success', 'Pesanan ditolak.');
    }

    public function complete(Order $order)
    {
        $order->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $order->car->update(['status' => 'sold']);

        return back()->with('success', 'Pesanan selesai! Mobil telah terjual.');
    }
}
