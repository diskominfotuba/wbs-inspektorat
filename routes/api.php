<?php

use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(RegisterController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('pengaduan', PengaduanController::class);
});

Route::get('pengaduan/download/{id}', [PengaduanController::class, 'downloadFile'])->name('pengaduan.downloadFile');
