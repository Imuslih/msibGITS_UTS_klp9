<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('dashboard', function () {
    return view('dashboard',[
      'title' => 'Halaman Dashboard',
      'menu'=>'dashboard',
      'sub_menu'=>'', 
      'judul'=>'Dashboard',
      'sub_judul'=>'']
    );
  })->name('dashboard');

   Route::controller(ProductsController::class)->prefix('products')->group(function () {
    Route::get('', 'index')->name('products');
  });

   Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
  });

  Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::get('', 'index')->name('transaction');
  });

  Route::get('login', [AuthController::class, 'index'])->name('login');
  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::get('register', [AuthController::class, 'register_view'])->name('register');
  Route::post('register', [AuthController::class, 'register'])->name('register');

  Route::get('dashboard', [AuthController::class, 'dasboard'])->name('dasboard');
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');