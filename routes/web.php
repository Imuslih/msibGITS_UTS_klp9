<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListTransactionController;
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

Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('index');
  Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
  });

  Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::get('', 'index')->name('transaction');
    Route::get('cek_produk', 'CekProduk')->name('cek_produk');
    Route::post('cek_produk', 'CekProduk')->name('cek_produk');
    Route::get('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::post('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::get('save_transaction', 'save_transaction')->name('transaction.save_transaction');
    Route::post('save_transaction', 'save_transaction')->name('transaction.save_transaction');
    Route::get('reset_cart', 'reset_cart')->name('transaction.reset_cart');
    Route::get('remove_item/{rowId}', 'remove_item')->name('transaction.remove_item');
    // -----------------------------------------------------------
    Route::get('index2', 'index2')->name('index_transaction');
    Route::get('cart', 'cart');
    Route::get('add/{id}', 'add')->where('id','[0-9]+');
    Route::get('hapus/{id}', 'hapus')->where('id','[0-9]+');

    Route::get('kirimWA', 'kirimWA')->name('kirimWA');
  });
  //cek


  Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
    Route::get('add','create')->name('category.add');
    Route::post('add','store')->name('category.store');
    Route::get('edit/{id}', 'edit')->name('category.edit');
    Route::post('edit/{id}','update')->name('category.update');
    Route::get('destroy/{id}','destroy')->name('category.destroy');
  });

  Route::controller(ProductsController::class)->prefix('products')->group(function () {
    Route::get('', 'index')->name('products');
    Route::get('add','create')->name('products.add');
    Route::post('add','store')->name('products.store');
    Route::get('edit/{id}','edit')->name('products.edit');
    Route::post('edit/{id}','update')->name('products.update');
    Route::get('destroy/{id}','destroy')->name('products.destroy');
  });

   Route::controller(ListTransactionController::class)->prefix('list_transaction')->group(function () {
      Route::get('', 'index')->name('list_transaction');
      Route::get('list_detail/{id}', 'detail')->name('list_detail');
      Route::get('print_list_transaction/{id}', 'print_list_transaction')->name('print_list_transaction');
    });

});

  Route::get('login', [AuthController::class, 'index'])->name('login');
  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::get('register', [AuthController::class, 'register_view'])->name('register');
  Route::post('register', [AuthController::class, 'register'])->name('register');

  Route::get('home', [AuthController::class, 'home'])->name('home');
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');

