<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\TestDriveController as AdminTestDriveController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog Routes
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{car}', [CatalogController::class, 'show'])->name('catalog.show');

// Auth Routes (Laravel Breeze)
Route::middleware(['auth', 'verified'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Test Drive Routes
    Route::get('/test-drive', [TestDriveController::class, 'index'])->name('test-drive.index');
    Route::get('/test-drive/create', [TestDriveController::class, 'create'])->name('test-drive.create');
    Route::post('/test-drive', [TestDriveController::class, 'store'])->name('test-drive.store');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create/{car}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Car Management
    Route::resource('cars', AdminCarController::class);
    
    // Test Drive Management
    Route::get('/test-drives', [AdminTestDriveController::class, 'index'])->name('test-drives.index');
    Route::patch('/test-drives/{testDrive}/approve', [AdminTestDriveController::class, 'approve'])->name('test-drives.approve');
    Route::patch('/test-drives/{testDrive}/reject', [AdminTestDriveController::class, 'reject'])->name('test-drives.reject');
    
    // Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::patch('/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');
    Route::patch('/orders/{order}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
});

require __DIR__.'/auth.php';
