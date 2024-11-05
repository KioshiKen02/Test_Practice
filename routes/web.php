<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;


// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Donation route
Route::get('/donation', function () {
    return view('donation');
})->middleware(['auth'])->name('donation');

// Admin Dashboard and User Management routes
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Resource routes for user management
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // Specific routes for viewing and managing users
    Route::get('/users/{user}', [AdminDashboardController::class, 'showUserDashboard'])->name('admin.users.dashboard');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'update'])->name('admin.users.update');
});

// Login route
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// Authenticated user profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar/update', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
    Route::post('/profile/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('avatar.remove');
    Route::delete('/user/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User transactions routes
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::get('/user-dashboard-transaction', [TransactionController::class, 'index'])->name('transactions.user-dashboard-transaction');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
   

});


// Shopping routes with 'shopping' prefix
Route::prefix('shopping')->group(function () {
    Route::get('/', [ShoppingController::class, 'index'])->name('shopping.index');
    Route::get('/cart', [ShoppingController::class, 'shoppingCart'])->name('shopping.cart');
    
    Route::delete('/cart/delete-item', [ShoppingController::class, 'deleteItem'])->name('shopping.delete');
    Route::post('/cart/add-item', [ShoppingController::class, 'addShoppingToCart'])->name('shopping.add_to_cart');
    Route::post('/cart/update-item', [ShoppingController::class, 'updateItem'])->name('shopping.update');
    
    // Checkout route using ShoppingController
    Route::post('/checkout', [ShoppingController::class, 'checkout'])->name('shopping.checkout');
    
    // Optional: You may want to handle cart clearing in the same controller or adjust accordingly
    Route::post('/cart/clear', [ShoppingController::class, 'clearCart'])->name('shopping.cart.clear');
});



// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware(['auth'])->name('logout');

// Load authentication routes
require __DIR__.'/auth.php';

// Fallback route for undefined pages
Route::fallback(function () {
    return view('errors.404'); // Customize the view as needed
})->name('fallback');
