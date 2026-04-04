<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CategoriesController;

Route::get('/',[DashboardController::class,'home']);
Route::get('/register',[FormController::class,'register']);
Route::post('/welcome',[FormController::class,'welcome']);



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
