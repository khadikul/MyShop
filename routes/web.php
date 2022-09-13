<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

// =========================Category Route ===============
Route::get('/web-admin/category', [CategoryController::class, 'categoryPage']);