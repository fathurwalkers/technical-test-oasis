<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [TestController::class, 'index'])->name('index');

Route::get('/soal-one', [TestController::class, 'soal_one'])->name('soal-one');
Route::get('/soal-two', [TestController::class, 'soal_two'])->name('soal-two');
Route::get('/soal-three/{teks1}/{teks2}', [TestController::class, 'soal_three'])->name('soal-three');
Route::get('/soal-four/{input}', [TestController::class, 'soal_four'])->name('soal-four');

Route::get('/soal-five', [TestController::class, 'soal_five'])->name('soal-five');
Route::post('/soal-five/post-tambah-pegawai', [TestController::class, 'post_tambah_pegawai'])->name('post-tambah-pegawai');
Route::post('/soal-five/post-update-pegawai/{id}', [TestController::class, 'post_update_pegawai'])->name('post-update-pegawai');
Route::post('/soal-five/post-hapus-pegawai/{id}', [TestController::class, 'post_hapus_pegawai'])->name('post-hapus-pegawai');

// Route::get('/', function () {
//     Route::get('/soal-one', [TestController::class, 'soal_one'])->name('soal-one');
// });
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
