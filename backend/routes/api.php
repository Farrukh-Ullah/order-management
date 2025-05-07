<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ItemController;

Route::get('/customers', [CustomerController::class, 'index']); 
Route::get('/items', [ItemController::class, 'index']);     
Route::post('/orders', [OrderController::class, 'store']);       
Route::get('/orders', [OrderController::class, 'index']);        
Route::get('/orders/{id}/summary', [OrderController::class, 'showSummary']);
Route::put('/orders/{id}/edit', [OrderController::class, 'updateOrder']);
