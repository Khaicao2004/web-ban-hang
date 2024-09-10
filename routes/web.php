<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('shop/{slug}', [ProductController::class, 'shop'])->name('shop');

Route::get('shop-details/{slug}',[ProductController::class, 'productDetails'])->name('product.detail');

// auth
Route::get('auth/login', [AuthenticationController::class, 'showFormLogin'])->name('auth.login');
Route::post('auth/login', [AuthenticationController::class, 'login']);


Route::post('auth/logout', [AuthenticationController::class , 'logout'])->name('auth.logout');

//cart
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');

// order
Route::get('checkout', [OrderController::class, 'showFormOrder'])->name('checkout');
Route::post('order/save', [OrderController::class, 'saveOrder'])->name('order.save');