<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestDrive;

class TestDriveController extends Controller
{
    public function index()
    {
        $testDrives = TestDrive::with(['user', 'car'])->latest()->paginate(20);
        return view('admin.test-drives.index', compact('testDrives'));
    }

    public function approve(Request $request, TestDrive $testDrive)
    {
        $testDrive->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Test drive berhasil disetujui!');
    }

    public function reject(Request $request, TestDrive $testDrive)
    {
        $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $testDrive->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Test drive ditolak.');
    }
}
