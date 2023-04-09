<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('welcome');
// });



   Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
    Route::get('', 'index')->name('dashboard');
  
  });

   Route::controller(ProductsController::class)->prefix('products')->group(function () {
    Route::get('', 'index')->name('products');
    Route::get('add','create')->name('products.add');
    Route::post('add','store')->name('products.store');
    Route::get('edit/{id}','edit')->name('products.edit');
    Route::post('edit/{id}','update')->name('products.update');
    Route::get('destroy/{id}','destroy')->name('products.destroy');
  });

   Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
    Route::get('add','create')->name('category.add');
    Route::post('add','store')->name('category.store');
    Route::get('edit/{id}', 'edit')->name('category.edit');
    Route::post('edit/{id}','update')->name('category.update');
    Route::get('destroy/{id}','destroy')->name('category.destroy');
  });

  Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::get('', 'index')->name('transaction');
  });

  Route::get('login', [AuthController::class, 'index'])->name('login');
  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::get('register', [AuthController::class, 'register_view'])->name('register');
  Route::post('register', [AuthController::class, 'register'])->name('register');

  Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');

