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
// use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

// Route::get('/', function () {
//     return view('home');
// });

Route::redirect('dashboard', '/');

Route::get('/', [HomeController::class, 'dashboard'])
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // 'employee'
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

Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('admin');
Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('admin');
Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('admin');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('admin');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('superAdmin');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('superAdmin');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('superAdmin');


Route::get('category', [CategoryController::class, 'index'])->name('category.index')->middleware('employee');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('admin');
Route::post('category', [CategoryController::class, 'store'])->name('category.store')->middleware('admin');
Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show')->middleware('admin');
Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit')->middleware('admin');
Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware('admin');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('admin');


Route::get('goods', [GoodsController::class, 'index'])->name('goods.index')->middleware('employee');
Route::get('goods/create', [GoodsController::class, 'create'])->name('goods.create')->middleware('admin');
Route::post('goods', [GoodsController::class, 'store'])->name('goods.store')->middleware('admin');
Route::get('goods/{good}', [GoodsController::class, 'show'])->name('goods.show')->middleware('admin');
Route::get('goods/{good}/edit', [GoodsController::class, 'edit'])->name('goods.edit')->middleware('admin');
Route::put('goods/{good}', [GoodsController::class, 'update'])->name('goods.update')->middleware('admin');
Route::delete('goods/{good}', [GoodsController::class, 'destroy'])->name('goods.destroy')->middleware('admin');

Route::get('/goods/category/{categoryId}', [GoodsController::class, 'getByCategory'])->name('goods.getByCategory')->middleware('employee');


Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index')->middleware('employee');
Route::get('hotels/create', [HotelController::class, 'create'])->name('hotels.create')->middleware('admin');
Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store')->middleware('admin');
Route::get('hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show')->middleware('employee');
Route::get('hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('hotels.edit')->middleware('admin');
Route::put('hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update')->middleware('admin');
Route::delete('hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy')->middleware('admin');


Route::get('jobTitles', [JobTitleController::class, 'index'])->name('jobTitles.index')->middleware('superAdmin');
Route::get('jobTitles/create', [JobTitleController::class, 'create'])->name('jobTitles.create')->middleware('superAdmin');
Route::post('jobTitles', [JobTitleController::class, 'store'])->name('jobTitles.store')->middleware('superAdmin');
Route::get('jobTitles/{jobTitle}', [JobTitleController::class, 'show'])->name('jobTitles.show')->middleware('superAdmin');
Route::get('jobTitles/{jobTitle}/edit', [JobTitleController::class, 'edit'])->name('jobTitles.edit')->middleware('superAdmin');
Route::put('jobTitles/{jobTitle}', [JobTitleController::class, 'update'])->name('jobTitles.update')->middleware('superAdmin');
Route::delete('jobTitles/{jobTitle}', [JobTitleController::class, 'destroy'])->name('jobTitles.destroy')->middleware('superAdmin');


Route::get('orders', [OrderController::class, 'index'])->name('orders.index')->middleware('employee');
Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('employee');
Route::post('orders', [OrderController::class, 'store'])->name('orders.store')->middleware('employee');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('employee');
Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware('employee');
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware('employee');
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('admin');

// Custom routes for order items
Route::delete('orders/{orderId}/items/{itemId}', [OrderController::class, 'destroyItem'])->name('orders.destroyItem')->middleware('employee');
Route::post('orders/{order}/update-paid', [OrderController::class, 'updatePaid'])->name('orders.updatePaid')->middleware('employee');



Route::get('orderItems', [OrderItemController::class, 'index'])->name('orderItems.index')->middleware('employee');
Route::get('orderItems/create', [OrderItemController::class, 'create'])->name('orderItems.create')->middleware('employee');
Route::post('orderItems', [OrderItemController::class, 'store'])->name('orderItems.store')->middleware('employee');
Route::get('orderItems/{orderItem}', [OrderItemController::class, 'show'])->name('orderItems.show')->middleware('employee');
Route::get('orderItems/{orderItem}/edit', [OrderItemController::class, 'edit'])->name('orderItems.edit')->middleware('employee');
Route::put('orderItems/{orderItem}', [OrderItemController::class, 'update'])->name('orderItems.update')->middleware('employee');
Route::delete('orderItems/{orderItem}', [OrderItemController::class, 'destroy'])->name('orderItems.destroy')->middleware('employee');

// Custom routes for order items management
Route::post('orderItems/update/{id}', [OrderItemController::class, 'updateCount'])->name('orderItem.update')->middleware('employee');
Route::post('orderItems/add/{id}', [OrderItemController::class, 'addItem'])->name('orderItem.addItem')->middleware('employee');


Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index')->middleware('admin');
Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create')->middleware('admin');
Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store')->middleware('admin');
Route::get('suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show')->middleware('admin');
Route::get('suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit')->middleware('admin');
Route::put('suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update')->middleware('admin');
Route::delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy')->middleware('admin');


Route::get('supplierOrders', [SupplierOrderController::class, 'index'])->name('supplierOrders.index')->middleware('admin');
Route::get('supplierOrders/create', [SupplierOrderController::class, 'create'])->name('supplierOrders.create')->middleware('admin');
Route::post('supplierOrders', [SupplierOrderController::class, 'store'])->name('supplierOrders.store')->middleware('admin');
Route::get('supplierOrders/{supplierOrder}', [SupplierOrderController::class, 'show'])->name('supplierOrders.show')->middleware('admin');
Route::get('supplierOrders/{supplierOrder}/edit', [SupplierOrderController::class, 'edit'])->name('supplierOrders.edit')->middleware('admin');
Route::put('supplierOrders/{supplierOrder}', [SupplierOrderController::class, 'update'])->name('supplierOrders.update')->middleware('admin');
Route::delete('supplierOrders/{supplierOrder}', [SupplierOrderController::class, 'destroy'])->name('supplierOrders.destroy')->middleware('admin');

// Custom routes for supplier order items
Route::delete('supplierOrders/{orderId}/items/{itemId}', [SupplierOrderController::class, 'destroyItem'])->name('supplierOrders.destroyItem')->middleware('admin');
Route::post('supplierOrders/{order}/update-paid', [SupplierOrderController::class, 'updatePaid'])->name('supplierOrders.updatePaid')->middleware('admin');



Route::get('supplierOrderItems', [SupplierOrderItemController::class, 'index'])->name('supplierOrderItems.index')->middleware('admin');
Route::get('supplierOrderItems/create', [SupplierOrderItemController::class, 'create'])->name('supplierOrderItems.create')->middleware('admin');
Route::post('supplierOrderItems', [SupplierOrderItemController::class, 'store'])->name('supplierOrderItems.store')->middleware('admin');
Route::get('supplierOrderItems/{supplierOrderItem}', [SupplierOrderItemController::class, 'show'])->name('supplierOrderItems.show')->middleware('admin');
Route::get('supplierOrderItems/{supplierOrderItem}/edit', [SupplierOrderItemController::class, 'edit'])->name('supplierOrderItems.edit')->middleware('admin');
Route::put('supplierOrderItems/{supplierOrderItem}', [SupplierOrderItemController::class, 'update'])->name('supplierOrderItems.update')->middleware('admin');
Route::delete('supplierOrderItems/{supplierOrderItem}', [SupplierOrderItemController::class, 'destroy'])->name('supplierOrderItems.destroy')->middleware('admin');

// Custom route for updating count
Route::post('supplierOrderItems/update/{id}', [SupplierOrderItemController::class, 'updateCount'])->name('supplierOrderItem.update')->middleware('admin');


Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index')->middleware('admin');

// Route::get('totalMonth', [TotalMonthController::class, 'index'])->name('totalMonth.index');
Route::get('/total-month', [TotalMonthController::class, 'index'])->name('totalMonth.index')->middleware('superAdmin');

