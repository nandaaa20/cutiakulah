<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CutiController;

Route::get('/', function () {
    return view('welcome');
});

// Redirect ke dashboard sesuai role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Profil user (akses oleh semua yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/cuti', [AdminController::class, 'cutiIndex'])->name('admin.cuti.index');
    Route::post('/admin/cuti/{id}/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.cuti.verifikasi');
    Route::get('/admin/employees', [App\Http\Controllers\AdminController::class, 'employees'])->name('admin.employees');

    
    // Tambahkan route admin lainnya di sini, seperti: verifikasi cuti, daftar pengajuan, dll.
});

// Route untuk user
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Pengajuan cuti user
    Route::prefix('user')->name('cuti.')->group(function () {
    Route::get('/cuti', [CutiController::class, 'index'])->name('index');
    Route::get('/cuti/create', [CutiController::class, 'create'])->name('create');
    Route::post('/cuti', [CutiController::class, 'store'])->name('store');    });
    // Tambahkan route user lainnya di sini, seperti: pengajuan cuti, riwayat cuti, dll.
});


require __DIR__.'/auth.php';
