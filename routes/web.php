<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;

Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('admin.dashboard');
    Route::get('pengaduan', [Admin\PengaduanController::class, 'index'])->name('admin.pengaduan');

    Route::post('pengaduan/update', [Admin\PengaduanController::class, 'update'])->name('admin.pengaduan.update');
    Route::get('pengaduan/pending', [Admin\PengaduanController::class, 'pending'])->name('admin.pengaduan.pending');
    Route::get('pengaduan/diterima', [Admin\PengaduanController::class, 'diterima'])->name('admin.pengaduan.diterima');
    Route::get('pengaduan/diproses', [Admin\PengaduanController::class, 'diproses'])->name('admin.pengaduan.diproses');
    Route::get('pengaduan/tutup', [Admin\PengaduanController::class, 'close'])->name('admin.pengaduan.close');

    Route::get('pengaduan/show/{id}', [Admin\PengaduanController::class, 'show'])->name('admin.pengaduan.show');
    Route::post('pengaduan/destroy', [Admin\PengaduanController::class, 'destroy'])->name('admin.pengaduan.destroy');

    Route::post('chat/store', [Admin\ChatController::class, 'store'])->name('admin.chat.store');
});

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/', User\DashboardController::class)->name('user.dashboard');
    Route::get('pengaduan', [User\PengaduanController::class, 'index'])->name('user.pengaduan');

    Route::get('pengaduan/pending', [User\PengaduanController::class, 'pending'])->name('user.pengaduan.pending');
    Route::get('pengaduan/diterima', [User\PengaduanController::class, 'diterima'])->name('user.pengaduan.diterima');
    Route::get('pengaduan/diproses', [User\PengaduanController::class, 'diproses'])->name('user.pengaduan.diproses');
    Route::get('pengaduan/tutup', [User\PengaduanController::class, 'close'])->name('user.pengaduan.close');

    Route::get('pengaduan/show/{id}', [User\PengaduanController::class, 'show'])->name('user.pengaduan.show');
    Route::post('pengaduan/store', [User\PengaduanController::class, 'store'])->name('user.pengaduan.store');
    Route::post('pengaduan/destroy', [User\PengaduanController::class, 'destroy'])->name('user.pengaduan.destroy');

    Route::post('chat/store', [User\ChatController::class, 'store'])->name('user.chat.store');
});
Route::get('pengaduan/create', [User\PengaduanController::class, 'create'])->name('user.pengaduan.create');
Route::get('stream/{filename}', \App\Http\Controllers\FileController::class)->name('file')->middleware('auth');
Route::get('privacy-policy', function () {
    return view('privacy');
});

Auth::routes();
