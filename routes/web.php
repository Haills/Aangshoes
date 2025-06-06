<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ForgotPasswordController,
    Auth\ResetPasswordController,
    CategoryController,
    ProductController,
    ProductImageController,
    OrderController,
    OrderItemController,
    CartController,
    HomeController,
    ProfileController
};

/* 
|--------------------------------------------------------------------------
| RUTE PUBLIK (Untuk Pengunjung/Tamu)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login');
    });

    // Registrasi
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register');
    });

    // Reset Password
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
        Route::post('password/reset', 'reset')->name('password.update');
    });
});

// Tentang Kami
Route::view('/tentang-kami', 'about')->name('about');

// Produk detail bisa diakses publik tanpa login
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');


/* 
|--------------------------------------------------------------------------
| RUTE TERPROTEKSI (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Redirect Otomatis Berdasarkan Role
    Route::get('/', function () {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    });

    // Dashboard User Biasa
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Order History untuk semua user
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    /* 
    |--------------------------------------------------------------------------
    | RUTE KHUSUS ADMIN (prefix admin + middleware admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware('admin')->group(function () {
        // Dashboard Admin
        Route::get('dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

        // Manajemen Kategori
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Manajemen Produk (admin bisa CRUD)
        Route::resource('products', ProductController::class)->except(['show']); // show di public route

        Route::delete('products/{product}/images/{image}', [ProductImageController::class, 'destroy'])
            ->name('product-images.destroy');

        // Manajemen Pesanan
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.update-status');
    });

    /* 
    |--------------------------------------------------------------------------
    | RUTE UNTUK SEMUA USER TERAUTENTIKASI
    |--------------------------------------------------------------------------
    */
    // Keranjang Belanja
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/add/{product}', 'add')->name('cart.add');
        Route::put('/update/{product}', 'update')->name('cart.update');
        Route::delete('/remove/{product}', 'remove')->name('cart.remove');
        Route::delete('/clear', 'clear')->name('cart.clear');
        Route::post('/checkout', 'checkout')->name('cart.checkout');
    });

    // Item Pesanan
    Route::resource('order-items', OrderItemController::class)->only(['update', 'destroy']);
});
