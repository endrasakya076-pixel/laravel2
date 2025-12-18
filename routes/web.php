<?php
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

// Route::get('/', function () {
//     //return view('welcome');
//     return "Hallo Hendra Sakya Permana";
// });

// Route::get('/hello', function () {
//     return "Saya akan belajar dengan sungguh-sungguh";
// });

// Route::get('/bisa', function () {
//     return "Mencoba Menjadi yang lebih baika";
// });

// Route::get('/selamat', function () {
//     return view('welcome');
// });

// Route::get('/yakin', function () {
//     return "Saya akan terus mencoba hingga bisa menjadi mahir";
// });

// Route::get('/halo', function () {
//     return view('halo');
// });

// Route::get('/page', function () {
//     return view('page');
// });

// Route::get('/hallo', [HaloController::class, 'index']);

// Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
// Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
// Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
// Route::put('/buku/{id}/update', [BukuController::class, 'update'])->name('buku.update');
// Route::delete('/buku/{id}/delete', [BukuController::class, 'destroy'])->name('buku.delete');


//Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
Route::get('portofolio/index', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/send-message', [PortfolioController::class, 'sendMessage'])->name('portfolio.send-message');