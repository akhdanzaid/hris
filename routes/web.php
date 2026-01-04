<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KaryawanController,
    CutiController,
    GajiController,
    LaporanController,
    PengumumanController,
    AkunController,
    AbsensiController,
    LoginController,
    RegisterController,
    DatauserController,
    CutikController,
    AbsensikController,
    PengumumankController
};

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/

/* =====================
| Login
===================== */
Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:hrd')
        ->name('dashboard.index');


    Route::get('/dashboardk', [DashboardController::class, 'indexk'])
        ->middleware('role:karyawan')
        ->name('dashboardk.index');

    /*
    |--------------------------------------------------------------------------
    | HRD AREA
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:hrd')->group(function () {

        /* TO DO */
        Route::prefix('dashboard/todo')->name('dashboard.todo.')->group(function () {
            Route::post('/', [DashboardController::class, 'storeTodo'])->name('store');
            Route::patch('/{id}/toggle', [DashboardController::class, 'toggleTodo'])->name('toggle');
            Route::delete('/{id}', [DashboardController::class, 'destroyTodo'])->name('destroy');
        });


        /* DATA KARYAWAN */
        Route::prefix('employee')->name('employee.')->group(function () {
            Route::get('/', [KaryawanController::class, 'index'])->name('index');
            Route::get('/create', [KaryawanController::class, 'create'])->name('create');
            Route::post('/', [KaryawanController::class, 'store'])->name('store');
            Route::get('/{id}', [KaryawanController::class, 'detail'])->name('detail');
            Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('destroy');
        });

        /* DATA USER */
        Route::prefix('datauser')->name('datauser.')->group(function () {
            Route::get('/', [DatauserController::class, 'index'])->name('index');
            Route::delete('/{id}', [DatauserController::class, 'destroy'])->name('destroy');
            Route::post('/register', [RegisterController::class, 'register'])->name('register');
        });

        /* CUTI HRD */
        Route::prefix('cuti')->name('cuti.')->group(function () {
            Route::get('/', [CutiController::class, 'index'])->name('index');
            Route::get('/create', [CutiController::class, 'create'])->name('create');
            Route::post('/', [CutiController::class, 'store'])->name('store');
            Route::put('/{id}/approve', [CutiController::class, 'approve'])->name('approve');
            Route::put('/{id}/reject', [CutiController::class, 'reject'])->name('reject');
            Route::put('/{id}/reset', [CutiController::class, 'reset'])->name('reset');
            Route::get('/{id}', [CutiController::class, 'show'])->name('detail');
        });

        /* ABSENSI HRD */
        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('/', [AbsensiController::class, 'index'])->name('index');
            Route::post('/session/start', [AbsensiController::class, 'startSession'])->name('session.start');
            Route::post('/session/{id}/close', [AbsensiController::class, 'closeSession'])->name('session.close');
            Route::post('/store', [AbsensiController::class, 'store'])->name('store');
        });

        /* GAJI */
        Route::prefix('gaji')->name('gaji.')->group(function () {
            Route::get('/', [GajiController::class, 'index'])->name('index');
            Route::get('/create', [GajiController::class, 'create'])->name('create');
            Route::post('/', [GajiController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [GajiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [GajiController::class, 'update'])->name('update');
        });

        /* LAPORAN */
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('index');
            Route::get('/{id}', [LaporanController::class, 'show'])->name('detail');
        });

        /* PENGUMUMAN HRD */
        Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
            Route::get('/', [PengumumanController::class, 'index'])->name('index');
            Route::get('/create', [PengumumanController::class, 'create'])->name('create');
            Route::post('/', [PengumumanController::class, 'store'])->name('store');
            Route::get('/{id}', [PengumumanController::class, 'show'])->name('show');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | KARYAWAN AREA
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:karyawan')->group(function () {

        /* CUTI KARYAWAN */
        Route::prefix('cutik')->name('cutik.')->group(function () {
            Route::get('/', [CutikController::class, 'index'])->name('index');
            Route::get('/create', [CutikController::class, 'create'])->name('create');
            Route::post('/', [CutikController::class, 'store'])->name('store');
            Route::get('/{id}', [CutikController::class, 'show'])->name('detail');
        });

        /* ABSENSI KARYAWAN */
        Route::prefix('absensik')->name('absensik.')->group(function () {
            Route::get('/', [AbsensikController::class, 'index'])->name('index');
            Route::post('/store', [AbsensikController::class, 'store'])->name('store');
        });

        /* PENGUMUMAN KARYAWAN */
        Route::prefix('pengumumank')->name('pengumumank.')->group(function () {
            Route::get('/', [PengumumankController::class, 'index'])->name('index');
            Route::get('/{id}', [PengumumankController::class, 'show'])->name('detail');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | AKUN (SEMUA ROLE)
    |--------------------------------------------------------------------------
    */
    Route::prefix('akun')->name('akun.')->group(function () {
        Route::get('/edit', [AkunController::class, 'edit'])->name('edit');
        Route::put('/update', [AkunController::class, 'update'])->name('update');
    });

    /*
    |--------------------------------------------------------------------------
    | AJAX INTERNAL (AUTH ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/ajax/karyawan-by-nik/{nik}', function ($nik) {
        return \App\Models\Karyawan::where('nik', $nik)->first();
    });
});
