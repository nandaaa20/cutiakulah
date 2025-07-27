<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CutiController as AdminCutiController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CutiController as UserCutiController;
use App\Http\Controllers\CutiController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard sesuai role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Autentikasi Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  ADMIN 
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/cuti', [AdminCutiController::class, 'CutiIndex'])->name('cuti.index');
    Route::get('/cuti/{id}', [AdminCutiController::class, 'show'])->name('cuti.show');
    Route::resource('/cuti', AdminCutiController::class)->except(['index', 'show', 'verifikasi']);});
    Route::put('/admin/cuti/verifikasi/{id}', [AdminCutiController::class, 'verifikasi']) ->name('admin.cuti.verifikasi');

//  USER 
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::resource('/cuti', UserCutiController::class);
    Route::get('/cuti/create', [UserCutiController::class, 'create'])->name('cuti.create');
    Route::post('/cuti', [UserCutiController::class, 'store'])->name('cuti.store');
    Route::get('/cuti/{id}', [UserCutiController::class, 'show'])->name('cuti.show');
});

//  EMAIL VERIFIKASI 
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

// Auth bawaan
require __DIR__.'/auth.php';
