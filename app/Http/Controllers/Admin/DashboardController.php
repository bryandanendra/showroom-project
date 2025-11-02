<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\TestDrive;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'sold_cars' => Car::where('status', 'sold')->count(),
            'pending_test_drives' => TestDrive::where('status', 'pending')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recentTestDrives = TestDrive::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();

        $recentOrders = Order::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentTestDrives', 'recentOrders'));
    }
}
