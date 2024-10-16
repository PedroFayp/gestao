<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Página Inicial
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect()->route('home');
});

// Produtos
Route::resource('products', ProductController::class);
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Categorias
Route::resource('categories', CategoryController::class);
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Contato
Route::get('/contact', [ContactController::class, 'index'])->name('contacts.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

// Carrinho
Route::get('/cart', [CartController::class, 'index'])->name('cart.cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/products', [AdminController::class, 'showProducts'])->name('admin.products');

    Route::get('/admin/list-log', [AdminController::class, 'manageListLog'])->name('admin.list.log');
    Route::get('/movements/export', [AdminController::class, 'export'])->name('movements.export');
    Route::get('/admin/movements', [AdminController::class, 'index'])->name('admin.movements');

    Route::get('/admin/current-inventory-report', [AdminController::class, 'manageInventoryReport'])->name('admin.current.inventory.report');
    Route::get('/admin/current-inventory-report/export', [AdminController::class, 'exportCurrentInventory'])->name('admin.export.current.inventory');

    Route::get('/admin/ranking', [AdminController::class, 'rankingProducts'])->name('admin.ranking');
    Route::get('/admin/ranking-products', [AdminController::class, 'rankingProducts'])->name('admin.ranking.products');
    Route::get('/admin/export-ranking-csv', [AdminController::class, 'exportRankingToCsv'])->name('admin.export.ranking.csv');
    Route::get('/admin/ranking/export', [AdminController::class, 'exportRanking'])->name('admin.export.ranking');

    Route::post('/products/{id}/exit', [ProductController::class, 'registerExit']);

    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
});

// Rotas admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
});

// Rotas de registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


// Rotas de autenticação
require __DIR__.'/auth.php';
