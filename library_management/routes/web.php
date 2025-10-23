<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;

Route::get('/export/pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');

// 🏠 Trang chủ → chuyển hướng đến danh sách sách
Route::get('/', function () {
    return redirect()->route('books.index');
});

// 🔐 Các route yêu cầu đăng nhập (user bình thường)
Route::middleware(['auth'])->group(function () {
    // 📊 Dashboard động
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 👤 Hồ sơ người dùng (do Breeze tạo)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📚 Quản lý sách (user bình thường)
    Route::resource('books', BookController::class);

    // 📖 Quản lý mượn – trả sách
    Route::resource('borrows', BorrowController::class);
});

// 🔐 Các route dành riêng cho admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 📊 Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 📚 Quản lý sách cho admin
    Route::resource('/books', BookController::class);
});

require __DIR__ . '/auth.php';
