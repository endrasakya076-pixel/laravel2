<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasController;

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


 Route::get('/', function () {
     return view('welcome');
 })->name('welcome');

 //login 
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'loginProses'])->name('loginProses');

    //logout
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::middleware('checkLogin')->group(function () {
    // Protected routes go here
 //dashboard
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
//user
    Route::get('user',[UserController::class,'index'])->name('user');
    Route::get('user/create',[UserController::class,'create'])->name('userCreate');
    Route::post('user/store',[UserController::class,'store'])->name('userStore');
     Route::get('user/edit/{id}',[UserController::class,'edit'])->name('userEdit');
     Route::post('user/update/{id}',[UserController::class,'update'])->name('userUpdate');
     Route::delete('user/destroy/{id}',[UserController::class,'destroy'])->name('userDestroy');
//tugas
    Route::get('tugas',[TugasController::class,'index'])->name('tugas');
    Route::get('tugas/spesimen',[TugasController::class,'spesimen'])->name('tugasSpesimen');
    Route::post('tugas/store',[TugasController::class,'store'])->name('tugasStore');
    Route::get('tugas/edit/{id}',[TugasController::class,'edit'])->name('tugasEdit');
    Route::post('tugas/update/{id}',[TugasController::class,'update'])->name('tugasUpdate');
    Route::delete('tugas/destroy/{id}',[TugasController::class,'destroy'])->name('tugasDestroy');
    Route::get('/tugasSearch',[TugasController::class,'search'])->name('tugasSearch');

//activity log
    Route::get('activity-log',[TugasController::class,'index'])->name('activityLog');
 });
