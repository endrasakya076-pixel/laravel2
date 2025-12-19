<?php
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\CheckoutController;


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


Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/send-message', [PortfolioController::class, 'sendMessage'])->name('portfolio.send-message');

// Frontend Routes
Route::get('/', function () {
    return view('portfolio.index');
});

// E-commerce routes
Route::get('/ebooks', [EbookController::class, 'index'])->name('ebooks.index');
Route::get('/ebook/{slug}', [EbookController::class, 'show'])->name('ebooks.show');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.process')->middleware('auth');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failed/{order}', [CheckoutController::class, 'failed'])->name('checkout.failed');
Route::post('/webhook/xendit', [CheckoutController::class, 'webhook'])->name('checkout.webhook');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    
    // Ebooks
    //Route::resource('ebooks', \App\Http\Controllers\Admin\EbookController::class);
    
    // Users
    //Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    // Projects
    //Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    
    // Testimonials
    //Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    
    // Skills
    //Route::resource('skills', \App\Http\Controllers\Admin\SkillController::class);
    
    // Messages
    //Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    //Route::get('/messages/{id}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    //Route::delete('/messages/{id}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');
    
    // Reports
    //Route::get('/reports/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('reports.sales');
    //Route::get('/reports/export/pdf', [\App\Http\Controllers\Admin\ReportController::class, 'exportPDF'])->name('reports.export.pdf');
});
