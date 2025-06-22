<?php

use App\Http\Controllers\AnalisisPresensiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::prefix('auth')->group(function () {
    Route::get('masuk', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/', [AuthController::class, 'postSignin'])->name('auth.post_login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('/create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('/', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::post('/{id}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

    Route::prefix('presensi')->group(function () {
        Route::get('/', [PresensiController::class, 'index'])->name('presensi.index');
        Route::get('riwayat', [PresensiController::class, 'history'])->name('presensi.history');
        Route::get('/create', [PresensiController::class, 'create'])->name('presensi.create');
        Route::post('/', [PresensiController::class, 'store'])->name('presensi.store');;
        Route::delete('/{id}', [PresensiController::class, 'destroy'])->name('presensi.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::prefix('orangtua')->group(function () {
            Route::get('/create', [UserController::class, 'createOrangtua'])->name('orangtua.create');
            Route::post('/', [UserController::class, 'storeOrangtua'])->name('orangtua.store');
            Route::get('/edit/{id}', [UserController::class, 'editOrangtua'])->name('orangtua.edit');
            Route::post('/update/{id}', [UserController::class, 'updateOrangtua'])->name('orangtua.update');
        });

        Route::prefix('siswa')->group(function () {
            Route::get('/create', [UserController::class, 'createSiswa'])->name('siswa.create');
            Route::post('/', [UserController::class, 'storeSiswa'])->name('siswa.store');
            Route::get('/{id}', [UserController::class, 'editSiswa'])->name('siswa.edit');
            Route::post('/update/{id}', [UserController::class, 'updateSiswa'])->name('siswa.update');
        });

        Route::prefix('guru')->group(function () {
            Route::get('/create', [UserController::class, 'createGuru'])->name('guru.create');
            Route::post('/', [UserController::class, 'storeGuru'])->name('guru.store');
            Route::get('/{id}', [UserController::class, 'editGuru'])->name('guru.edit');
            Route::post('/update/{id}', [UserController::class, 'updateGuru'])->name('guru.update');
        });

        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        });

        Route::prefix('analisis')->group(function () {
            Route::get('/', [AnalisisPresensiController::class, 'index'])->name('analisis.index');
        });
    });
});
