<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KartuController;

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
    return view('Welcome');
});

// Resource routes
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('kelas', KelasController::class);
Route::resource('presensi', PresensiController::class);
Route::resource('notifikasi', NotifikasiController::class);
Route::resource('kartu', KartuController::class);