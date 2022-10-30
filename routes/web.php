<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'publicHome']);
Auth::routes();

// ========================User Route ==================
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// =====================Admin Route===================
Route::get('/web-admin', [AdminController::class, 'adminHome']);
Route::get('/admin-login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm']);
Route::post('/admin-login', [App\Http\Controllers\Admin\LoginController::class, 'login']);

// ========================= Product Category Route ===============
Route::get('/web-admin/category', [CategoryController::class, 'categoryPage'])->name('product.category');
Route::post('/product-category', [CategoryController::class, 'saveCategory']);
Route::get('/web-admin/category-edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/update-category', [CategoryController::class, 'updateCategory']);
Route::get('/web-admin/category-delete/{id}', [CategoryController::class, 'deleteCategory']);

//============================= Product Cupon =======================
Route::get('/web-admin/coupon', [AdminController::class, 'Coupon']);
Route::post('/coupon', [AdminController::class, 'couponSubmit']);
Route::get('/coupon-delete/{id}', [AdminController::class, 'couponDelete']);
Route::post('/apply-coupon',[CartController::class, 'applyCoupon']);

// =========================== Product Branding Route ================
Route::get('/web-admin/product-brand',[BrandController::class, 'productBrand'])->name('product.brand');
Route::post('/product-brand', [BrandController::class, 'saveBrand']);
Route::get('/web-admin/brand-edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/update-brand', [BrandController::class, 'updateBrand']);
Route::get('/web-admin/brand-delete/{id}', [BrandController::class, 'deleteBrand']);

// ============================= Products Route ========================
Route::get('/web-admin/all-product', [ProductController::class, 'allProduct'])->name('admin.product');
Route::get('/web-admin/add-new', [ProductController::class, 'addNew']);
Route::post('/insert-product', [ProductController::class, 'addProduct']);
Route::get('/web-admin/product-edit/{id}', [ProductController::class, 'productEdit']);
Route::post('/update-product', [ProductController::class, 'updateProduct']);
Route::get('/web-admin/product-delete/{id}', [ProductController::class, 'deleteProduct']);

// ==================================Product Cart ==============================
Route::post('/add-to-cart', [CartController::class, 'addTocart']);
Route::get('/cart', [CartController::class, 'cartPage']);
Route::get('/cart-product-delete/{id}', [CartController::class, 'cartProductDelete']);
Route::post('/cart-quantity-increase', [CartController::class, 'cartQuantityIncrease']);
Route::post('/cart-quantity-decrease', [CartController::class, 'cartQuantityDecrease']);

//=================================== Product Shop Page ===========================
Route::get('/shop', [PublicController::class, 'shopPage']);