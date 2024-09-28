<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\SupplierOrderItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('categories', CategoryController::class);

Route::resource('goods', GoodsController::class);

Route::resource('hotels', HotelController::class);

Route::resource('jobTitles', JobTitleController::class);

Route::resource('orders', OrderController::class);
Route::delete('/orders/{orderId}/items/{itemId}', [OrderController::class, 'destroyItem']);

Route::resource('orderItems', OrderItemController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('supplierOrders', SupplierOrderController::class);
Route::delete('/supplierOrders/{orderId}/items/{itemId}', [SupplierOrderController::class, 'destroyItem']);

Route::resource('supplierOrderItems', SupplierOrderItemController::class);
