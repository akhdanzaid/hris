<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AkunController;


/*
|--------------------------------------------------------------------------
| HRIS Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

/* =====================
| Dashboard
===================== */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

/* =====================
| Data Karyawan
===================== */
Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('index');
    Route::get('/create', [KaryawanController::class, 'create'])->name('create');
    Route::post('/', [KaryawanController::class, 'store'])->name('store');
    Route::get('/{id}', [KaryawanController::class, 'detail'])->name('detail');
    Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
    Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('destroy');
});


/* =====================
| Cuti
===================== */
Route::prefix('cuti')->name('cuti.')->group(function () {
    Route::get('/', [CutiController::class, 'index'])->name('index');
});

/* =====================
| Detail Cuti
===================== */
Route::get('/cuti/{id}', [CutiController::class, 'show'])
    ->name('cuti.detail');

/* =====================
| Gaji
===================== */
Route::prefix('gaji')->name('gaji.')->group(function () {
    // List data gaji
    Route::get('/', [GajiController::class, 'index'])
        ->name('index');
    // Form tambah gaji
    Route::get('/create', [GajiController::class, 'create'])
        ->name('create');
    // Simpan data gaji
    Route::post('/', [GajiController::class, 'store'])
        ->name('store');
    // Form edit gaji
    Route::get('/{id}/edit', [GajiController::class, 'edit'])
        ->name('edit');
    // Update data gaji
    Route::put('/{id}', [GajiController::class, 'update'])
        ->name('update');
});
Route::get('/ajax/karyawan-by-nik/{nik}', function ($nik) {
    return \App\Models\Karyawan::where('nik', $nik)->first();
});


/* =====================
| Laporan
===================== */
Route::prefix('laporan')->name('laporan.')->group(function () {

    // Halaman utama laporan (list)
    Route::get('/', [LaporanController::class, 'index'])
        ->name('index');

    // Halaman rincian laporan (detail absensi)
    Route::get('/{id}', [LaporanController::class, 'show'])
        ->name('detail');

});

/* =====================
| Pengumuman
===================== */
Route::prefix('pengumuman')->name('pengumuman.')->group(function () {

    // Halaman list pengumuman
    Route::get('/', [PengumumanController::class, 'index'])
        ->name('index');

    // Form buat pengumuman
    Route::get('/create', [PengumumanController::class, 'create'])
        ->name('create');

    // Simpan pengumuman
    Route::post('/', [PengumumanController::class, 'store'])
        ->name('store');

    // (Opsional) Detail pengumuman
    Route::get('/{id}', [PengumumanController::class, 'show'])
        ->name('show');

});

/* =====================
| Akun Edit
===================== */
Route::prefix('akun')->name('akun.')->group(function () {

    // Halaman edit (dummy)
    Route::get('/edit', [AkunController::class, 'edit'])
        ->name('edit');

    // Simpan perubahan (dummy)
    Route::put('/update', [AkunController::class, 'update'])
        ->name('update');
});
