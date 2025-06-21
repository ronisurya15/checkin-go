<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KartuController;
use App\Models\Kelas;

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
    return view('welcome');
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
    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('/create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('/', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::post('/{id}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });
});

// Resource routes
// Route::resource('users', UserController::class);
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::redirect('/login', '/auth/masuk');


Route::middleware('auth')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Users CRUD routes
    Route::prefix('users')->group(function () {
        Route::get('masuk', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/', [AuthController::class, 'postSignin'])->name('auth.post_login');
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});


// Route::resource('roles', RoleController::class);
// Route::resource('kelas', KelasController::class);
// Route::resource('presensi', PresensiController::class);
// Route::resource('notifikasi', NotifikasiController::class);
// Route::resource('kartu', KartuController::class);