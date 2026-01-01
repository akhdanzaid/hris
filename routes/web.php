<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DatauserController;
use App\Http\Controllers\CutikController;
use App\Http\Controllers\AbsensikController;
use App\Http\Controllers\PengumumankController;



/*
|--------------------------------------------------------------------------
| HRIS Routes
|--------------------------------------------------------------------------
*/


/* =====================
| Login
===================== */
Route::get('/',[LoginController::class,'index']);
Route::post('/login',[LoginController::class,'login'])->name('login');


/* =====================
| Logout
===================== */
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// Test AUTH BISA AKSES HANYA JIKA SUDAH LOGIN
Route::middleware('auth')->group(function() {


/* =====================
| Dashboard
===================== */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');
Route::get('/dashboardk', [DashboardController::class, 'indexk'])
    ->name('dashboardk.index');


/* =====================
| Dashboard Todo
===================== */
Route::prefix('dashboard/todo')->name('dashboard.todo.')->group(function () {
    Route::post('/', [DashboardController::class, 'storeTodo'])->name('store');
    Route::delete('/{id}', [DashboardController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/toggle', [DashboardController::class, 'toggle'])->name('toggle');
});



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
| Data User
===================== */
Route::prefix('datauser')->name('datauser.')->group(function () {
    Route::get('/', [DatauserController::class, 'index'])->name('index');
    Route::delete('/{id}', [DatauserController::class, 'destroy'])->name('destroy');
    // Register user dari halaman data user
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

});

/* =====================
| Absensi
===================== */
Route::prefix('absensi')->name('absensi.')->group(function () {

    // halaman tampilan absensi (tanpa auth)
    Route::get('/', function () {
        return view('absensi.index');
    })->name('index');

    // halaman barcode
    Route::get('/barcode/{tipe}', function ($tipe) {
        return view('absensi.barcode', compact('tipe'));
    })->name('barcode');

    // proses absensi (PAKAI CONTROLLER ANDA)
    Route::post('/store', [AbsensiController::class, 'store'])
        ->name('store');
});


/* =====================
| Cuti
===================== */
Route::prefix('cuti')->name('cuti.')->group(function () {

    // INDEX
    Route::get('/', [CutiController::class, 'index'])
        ->name('index');

    // CREATE
    Route::get('/create', [CutiController::class, 'create'])
        ->name('create');

    // STORE
    Route::post('/', [CutiController::class, 'store'])
        ->name('store');

    // APPROVE
    Route::put('/{id}/approve', [CutiController::class, 'approve'])
        ->name('approve');

    // REJECT
    Route::put('/{id}/reject', [CutiController::class, 'reject'])
        ->name('reject');

    // DETAIL (WAJIB PALING BAWAH)
    Route::get('/{id}', [CutiController::class, 'show'])
        ->name('detail');
});



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

/* =====================
| Cuti Karyawan
===================== */
Route::prefix('cutik')->name('cutik.')->group(function () {

    Route::get('/', [CutikController::class, 'index'])
        ->name('index');

    Route::get('/create', [CutikController::class, 'create'])
        ->name('create');

    Route::post('/', [CutikController::class, 'store'])
        ->name('store');

    Route::get('/{id}', [CutikController::class, 'show'])
        ->name('detail');
});

/* =====================
| Absensi Karyawan
===================== */
Route::prefix('absensik')->name('absensik.')->group(function () {

    Route::get('/', [AbsensikController::class, 'index'])
        ->name('index');

    Route::post('/store', [AbsensikController::class, 'store'])
        ->name('store');

    Route::get('/history', [AbsensikController::class, 'history'])
        ->name('history');
});

/* =====================
| Pengumuman Karyawan
===================== */
Route::prefix('pengumumank')->name('pengumumank.')->group(function () {

    Route::get('/', [PengumumankController::class, 'index'])
        ->name('index');

    Route::get('/{id}', [PengumumankController::class, 'show'])
        ->name('detail');
});


/* =====================
| Endpoint AJAX
===================== */
Route::get('/ajax/karyawan-by-nik/{nik}', function ($nik) {
    return \App\Models\Karyawan::where('nik', $nik)->first();
});

});


