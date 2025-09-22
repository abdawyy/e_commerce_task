<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as WebProductShow;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductLogController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::get('products/webShow/{id}', [HomeController::class, 'show'])->name('products.show');     // products.show



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');





    Route::get('products', [ProductController::class, 'index'])->name('products.index');     // products.index
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create'); // products.create
    Route::post('products', [ProductController::class, 'store'])->name('products.store');    // products.store
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // products.edit
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update'); // products.update
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // products.destroy
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');     // products.index
    Route::delete('products/{product}/image', [ProductController::class, 'deleteImage'])->name('products.deleteImage');



    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/data', [CategoryController::class, 'data'])->name('categories.data');

    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');


    Route::get('product-logs', [ProductLogController::class, 'index'])->name('product-logs.index');
    Route::get('product-logs/data', [ProductLogController::class, 'data'])->name('product-logs.data');
    Route::delete('product-logs/{productLog}', [ProductLogController::class, 'destroy'])->name('product-logs.destroy');



    Route::get('admins', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admins/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admins/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admins/{admin}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('admins/{admin}/delete', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/data', [AdminController::class, 'data'])->name('admin.data');



    Route::get('/guest', [GuestController::class, 'index'])->name('guests.index');      // guests.index
    Route::get('/guest/{id}', [GuestController::class, 'show'])->name('guests.show'); // guests.show


    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');   // orders.index
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('orders.show'); // orders.show
});

require __DIR__ . '/auth.php';
