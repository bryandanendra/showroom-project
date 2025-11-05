<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    /**
     * Download approval document for an order
     */
    public function downloadApproval(Order $order)
    {
        // Check if file exists
        if (!$order->credit_approval_path || !Storage::disk('public')->exists($order->credit_approval_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Get file path
        $filePath = storage_path('app/public/' . $order->credit_approval_path);
        
        // Get original filename or create a meaningful one
        $fileName = 'Bukti_Approval_' . $order->order_number . '.' . pathinfo($order->credit_approval_path, PATHINFO_EXTENSION);

        // Return file download response
        return response()->download($filePath, $fileName);
    }

    /**
     * View approval document for an order (inline in browser)
     */
    public function viewApproval(Order $order)
    {
        // Check if file exists
        if (!$order->credit_approval_path || !Storage::disk('public')->exists($order->credit_approval_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Get file path
        $filePath = storage_path('app/public/' . $order->credit_approval_path);
        
        // Get mime type
        $mimeType = Storage::disk('public')->mimeType($order->credit_approval_path);

        // Return file inline (view in browser)
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($order->credit_approval_path) . '"'
        ]);
    }
}
