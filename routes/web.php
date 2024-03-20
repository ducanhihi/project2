<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/admin/home', function () {
    return view('admin.home');
})->middleware('auth')->name('admin.home');

Route::get('/customer/home', function () {
    return view('customer.home');
})->name('customer.home');

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'viewRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

///product
Route::get('/admin/products', [ProductsController::class, 'viewAdminProducts'])->name('admin.products');
Route::post('/admin/create/products', [ProductsController::class, 'createProducts']);
Route::delete('/home/products/{id}', [ProductsController::class, 'deleteProductsById']);
Route::post('/admin/edit/products/{id}', [ProductsController::class, 'editProductsById']);




//category
Route::get('admin/categories', [CategoriesController::class, 'viewAdminCategories'])->name('admin.categories');

//brands
Route::get('admin/brands', [BrandsController::class, 'viewAdminBrands'])->name('admin.brands');



// sua fil nay
