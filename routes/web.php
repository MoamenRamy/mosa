<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\SupplierOrderItemController;
use App\Http\Controllers\TotalMonthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

// Route::get('/', function () {
//     return view('home');
// });

Route::redirect('dashboard', '/');

Route::get('/', [HomeController::class, 'dashboard'])->middleware([
    // 'auth:sanctum',
    // config('jetstream.auth_session'),
    // 'verified',
])->name('dashboard');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('layouts.main');
//     })->name('dashboard');
// });

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard'); // Adjust the view name if necessary
//     })->name('dashboard');
// });

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
// });

// Route::get('/dashboard', [OrderController::class, 'showDashboard'])->name('dashboard');

Route::resource('users', UserController::class);

Route::resource('category', CategoryController::class);

Route::resource('goods', GoodsController::class);

Route::resource('hotels', HotelController::class);

Route::resource('jobTitles', JobTitleController::class);

Route::resource('orders', OrderController::class);
Route::delete('/orders/{orderId}/items/{itemId}', [OrderController::class, 'destroyItem'])->name('orders.destroyItem');
Route::post('/orders/{order}/update-paid', [OrderController::class, 'updatePaid'])->name('orders.updatePaid');


Route::resource('orderItems', OrderItemController::class);
Route::post('/orderItems/update/{id}', [OrderItemController::class, 'updateCount'])->name('orderItems.update');
Route::post('/orderItems/add/{id}', [OrderItemController::class, 'addItem'])->name('orderItem.addItem');

Route::resource('suppliers', SupplierController::class);

Route::resource('supplierOrders', SupplierOrderController::class);
Route::delete('/supplierOrders/{orderId}/items/{itemId}', [SupplierOrderController::class, 'destroyItem'])->name('supplierOrders.destroyItem');
Route::post('/supplierOrders/{order}/update-paid', [SupplierOrderController::class, 'updatePaid'])->name('supplierOrders.updatePaid');


Route::resource('supplierOrderItems', SupplierOrderItemController::class);
Route::post('/supplierOrderItems/update/{id}', [SupplierOrderItemController::class, 'updateCount'])->name('supplierOrderItems.update');

Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index');

Route::get('totalMonth', [TotalMonthController::class, 'index'])->name('totalMonth.index');
