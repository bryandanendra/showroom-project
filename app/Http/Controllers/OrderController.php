<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Car;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['car', 'user'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(Car $car)
    {
        if ($car->status !== 'available') {
            return redirect()->route('catalog.show', $car)
                ->with('error', 'Mobil ini tidak tersedia untuk dipesan.');
        }

        return view('orders.create', compact('car'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'payment_method' => 'required|in:cash,transfer,credit',
            'down_payment' => 'nullable|numeric|min:0',
            'credit_approval_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'customer_notes' => 'nullable|string',
        ]);

        $car = Car::findOrFail($validated['car_id']);

        // Upload files
        if ($request->hasFile('credit_approval_path')) {
            $validated['credit_approval_path'] = $request->file('credit_approval_path')->store('documents/credit-approvals', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['price'] = $car->price;
        $validated['status'] = 'pending';

        $order = Order::create($validated);

        // Update car status
        $car->update(['status' => 'reserved']);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['car', 'user']);

        return view('orders.show', compact('order'));
    }
}
