<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'livewire.welcome.home')->name('home');
Route::view('/daftar-aduan-terbaru', 'livewire.welcome.daftar-aduan')->name('welcome.daftar-aduan');
Route::view('/profile-desa', 'livewire.welcome.profile')->name('welcome.profile');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Volt::route('formulir-aduan', 'formulir-aduan')
        ->name('formulir-aduan');
    Volt::route('daftar-aduan', 'daftar-aduan')
        ->name('daftar-aduan');
    Volt::route('laporan-aduan', 'laporan-aduan')
        ->name('laporan-aduan');
    Route::get('/cetak-laporan', [\App\Http\Controllers\Cetak::class, 'index']);
});

require __DIR__.'/auth.php';
