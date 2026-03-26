<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\JelajahiController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FormAppointmentController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE (BISA DIAKSES SEMUA)
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/penjelasan', [LandingController::class, 'tentang']);
Route::get('/pelayanan', [LandingController::class, 'pelayanan']);
Route::get('/dokter', [DokterController::class, 'index'])
    ->name('landing.sections.dokter');
Route::get('/appointment', [FormAppointmentController::class, 'create'])->name('landing.sections.appointment');
Route::post('/appointment', [FormAppointmentController::class, 'store'])->name('appointment.store');
Route::get('/blog', [LandingController::class, 'blog']);
Route::get('/kontak', [LandingController::class, 'kontak']);

// Static pages: Privacy, Terms, FAQ
Route::get('/privacy-policy', function () {
    return view('landing.pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('landing.pages.terms');
})->name('terms');

Route::get('/faq', function () {
    return view('landing.pages.faq');
})->name('faq');

/*
|--------------------------------------------------------------------------
| JELAJAHI
|--------------------------------------------------------------------------
*/

Route::get('/jelajahi1', [JelajahiController::class, 'jelajahi1']);
Route::get('/jelajahi2', [JelajahiController::class, 'jelajahi2']);
Route::get('/jelajahi3', [JelajahiController::class, 'jelajahi3']);
Route::get('/jelajahi4', [JelajahiController::class, 'jelajahi4']);
Route::get('/jelajahi5', [JelajahiController::class, 'jelajahi5']);
Route::get('/jelajahi6', [JelajahiController::class, 'jelajahi6']);

/*
|--------------------------------------------------------------------------
| DETAIL PRODUK
|--------------------------------------------------------------------------
*/

// Route untuk halaman kategori produk (landing/produk)
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Route untuk halaman detail produk per kategori (landing/detailproduk)
Route::get('/detailproduk/{kategoriId}', [ProdukController::class, 'show'])->name('detailproduk.show');

// ========================================
// OPTIONAL ROUTES (Fitur Tambahan)
// ========================================

/*
|--------------------------------------------------------------------------
| CUSTOMER AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest:customer')->group(function () {

    // 🔥 LOGIN (WAJIB name = login agar Laravel tidak error)
    Route::get('/login',
        [CustomerAuthController::class, 'showLogin']
    )->name('login');

    Route::post('/login',
        [CustomerAuthController::class, 'login']
    )->name('login.post');

    Route::post('/register',
        [CustomerAuthController::class, 'register']
    )->name('register.post');
});


Route::post('/logout',
    [CustomerAuthController::class, 'logout']
)->middleware('auth:customer')
 ->name('logout');


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:customer')->group(function () {

    Route::get('/profile',
        [CustomerAuthController::class, 'profile']
    )->name('landing.customer.profile');

    // Profile edit routes
    Route::get('/profile/edit', [CustomerAuthController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [CustomerAuthController::class, 'update'])->name('profile.update');


    // ORDER & CHECKOUT
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/process', [OrderController::class, 'process'])->name('order.process');
    Route::get('/order/success/{pemesananId}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');

    Route::prefix('landing/dokter')->group(function () {
        Route::get('/chat/{id}', [DokterController::class, 'chatDokter'])
            ->name('landing.dokter.chat');

        Route::post('/chat/{id}', [DokterController::class, 'storeChat'])
            ->name('landing.dokter.storeChat');

        // Payment routes for chat
        Route::get('/chat/checkout/{chatId}', [DokterController::class, 'checkoutChat'])
            ->name('landing.dokter.checkoutChat');
        Route::post('/chat/pay/{chatId}', [DokterController::class, 'processChatPayment'])
            ->name('landing.dokter.processChatPayment');

        // API untuk chat messages
        Route::post('/message/{chatDokterId}/send', [DokterController::class, 'sendMessage'])
            ->name('landing.dokter.message.send');
        
        Route::get('/message/{chatDokterId}/get', [DokterController::class, 'getMessages'])
            ->name('landing.dokter.message.get');
    });

    Route::get('/appointment-schedule', [FormAppointmentController::class, 'index'])->name('appointment.schedule');

    Route::get('/cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class,'destroy'])->name('cart.remove');

    
});



/*
|--------------------------------------------------------------------------
| DOKTER & KATEGORI (BEBAS DIAKSES)
|--------------------------------------------------------------------------
*/

// kategori
Route::get('/kategori-dokter',
    [DokterController::class,'kategori']
)->name('landing.dokter.kategori');

// list dokter
Route::get('/kategori-dokter/{kategori}',
    [DokterController::class,'dokterByKategori']
)->name('landing.dokter.list');


/*
|--------------------------------------------------------------------------
| CHATBOT (BISA DIAKSES SEMUA)
|--------------------------------------------------------------------------
*/

Route::post('/chatbot/send',
    [ChatbotController::class, 'send']
)->name('chatbot.send');

Route::get('/artikel/kesehatan-investasi', [LandingController::class, 'ksinvestasi'])->name('artikel.ksinvestasi');

Route::get('/artikel/kesehatan-ditanganmu', [LandingController::class, 'ksditanganmu'])->name('artikel.ksditanganmu');

Route::get('/artikel/tubuh-sehat', [LandingController::class, 'tubuhsehat'])->name('artikel.tubuhsehat');

Route::get('/artikel/kesehatan-tubuh-mental', [LandingController::class, 'kstubuhmental'])->name('artikel.kstubuhmental');

Route::get('/artikel/nutrisi', [LandingController::class, 'nutrisi'])->name('artikel.nutrisi');
Route::get('/artikel/mental', [LandingController::class, 'mental'])->name('artikel.mental');
Route::get('/artikel/gaya', [LandingController::class, 'gaya'])->name('artikel.gaya');
Route::get('/fix', function () {
    Artisan::call('session:table');
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Selesai: ' . Artisan::output();
});
Route::get('/debug', function () {
    try {
        DB::connection()->getPdo();
        $dbStatus = 'DB OK';
    } catch (\Exception $e) {
        $dbStatus = 'DB ERROR: ' . $e->getMessage();
    }
    
    return response()->json([
        'db' => $dbStatus,
        'session_driver' => config('session.driver'),
        'cache_store' => config('cache.default'),
        'app_key' => config('app.key') ? 'SET' : 'NOT SET',
        'tables' => DB::select('SHOW TABLES'),
    ]);
});