<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Testing';
});

Route::get('/test-json', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API Jalan',
    ]);
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/create', function () {
    return 'Create Product';
})->name('products.create');

Route::get('/products/{id}', function ($id) {
    return view('products.show', [
        'id' => $id
    ]);
})->whereNumber('id')->name('products.show');


// USER AUTH ROUTES
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// ADMIN ROUTES
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return 'Admin Dashboard';
        })->name('dashboard');

        Route::get('/products', function () {
            return 'Admin Products';
        })->name('products.index');
    });


// PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
