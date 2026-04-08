<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

Route::get('/',[DashboardController::class,'home'])->name('home')->middleware('auth');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('auth');
Route::post('/profile', [ProfileController::class, 'store'])->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth');

Route::post('/welcome',[FormController::class,'welcome']);

Route::middleware(['auth','admin'])->group(function () {
    // Categories Routes
// Create Data
Route::get('/category/create',[CategoriesController::class,'create']);
Route::post('/category',[CategoriesController::class,'store']);

// Read Data
Route::get('/category',[CategoriesController::class,'index']);
Route::get('/category/{id}',[CategoriesController::class,'show']);

// Update Data
Route::get('/category/{id}/edit',[CategoriesController::class,'edit']);
Route::put('/category/{id}',[CategoriesController::class,'update']);

// Delete Data
Route::delete('/category/{id}',[CategoriesController::class,'destroy']);
});


// Product Routes
Route::resource ('/product', ProductController::class);


Route::middleware('guest')->group(function () {
// Auth Routes
// Register
    Route::get('/register',[AuthController::class,'formregister']);
Route::post('/register',[AuthController::class,'register']);

// Login
Route::get('/login', [AuthController::class,'formlogin']);
Route::post('/login', [AuthController::class,'login'])->name('login');
    });

// Logout
Route::post('/logout', [AuthController::class,'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    // Transaction Routes
    Route::get('/transaction', [TransactionController::class, 'index']);
    Route::get('/transaction/create', [TransactionController::class, 'create']);
    Route::post('/transaction', [TransactionController::class, 'store']);
});
