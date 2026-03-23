<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\SaleController;
use App\Http\Controllers\Staff\StockInController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AuditController;

Route::get('/', function () {
    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.home');
    }

    if ($user && $user->role === 'staff') {
        return redirect()->route('staff.dashboard');
    }

    abort(403, 'Unauthorized role.');

})->middleware(['auth', 'verified'])->name('dashboard');

// Auth User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Home
    Route::get('/home', function() {
        return view('admin.home');
    })->name('home');

    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');



    // Product Management
    Route::resource('products', ProductController::class);

     // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

     // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Audit History
    Route::get('/audit', [AuditController::class, 'index'])->name('audit');

    // Export Sales Data
    Route::get('/export-sales', [ReportController::class, 'export'])->name('export.sales');
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

    // Stock In
    Route::get('/stock-in', [StockInController::class, 'index'])->name('stock-in.index');
    Route::get('/stock-in/create', [StockInController::class, 'create'])->name('stock-in.create');
    Route::post('/stock-in', [StockInController::class, 'store'])->name('stock-in.store');
    Route::get('/stock-in/{id}', [StockInController::class, 'show']);

    // Sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{id}', [SaleController::class, 'show']);

    Route::get('/z-read', [SaleController::class, 'zRead'])->name('sales.zread');

    // Check Product Stock
    Route::get('/product-stock/{id}', [ProductController::class, 'showStock']);
    
});

require __DIR__.'/auth.php';
