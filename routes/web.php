<?php

use App\Http\Controllers\AboutController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public static pages
Route::view('/about', 'about')->name('about');

// Contact routes
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Public product and category routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// User dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         // Name this 'dashboard' so the group's 'admin.' prefix yields 'admin.dashboard'
         Route::get('/', [AdminController::class, 'index'])->name('dashboard');

         // Resource controllers for admin-managed models
         Route::resource('products', AdminProductController::class);
         Route::resource('categories', AdminCategoryController::class);
     });

 Route::fallback(function () {
     return response()->view('errors.404', [], 404);
 });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
