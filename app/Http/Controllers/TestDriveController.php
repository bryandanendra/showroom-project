<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestDrive;
use App\Models\Car;

class TestDriveController extends Controller
{
    public function index()
    {
        // Redirect admin to admin panel
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $testDrives = TestDrive::with(['car', 'user'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('test-drive.index', compact('testDrives'));
    }

    public function create(Request $request)
    {
        $cars = Car::available()->get();
        $selectedCarId = $request->get('car_id');

        return view('test-drive.create', compact('cars', 'selectedCarId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'test_drive_date' => 'required|date|after:today',
            'test_drive_time' => 'required',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        TestDrive::create($validated);

        return redirect()->route('test-drive.index')
            ->with('success', 'Booking test drive berhasil! Menunggu konfirmasi admin.');
    }
}
