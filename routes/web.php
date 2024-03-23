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
Route::post('/admin/create/product', [ProductsController::class, 'createProduct']);
Route::delete('/home/product/{id}', [ProductsController::class, 'deleteProductById']);
Route::post('/admin/edit/product/{id}', [ProductsController::class, 'editProductById']);
// Trong file routes/web.php



//category
Route::get('/admin/categories', [CategoriesController::class, 'viewAdminCategories'])->name('admin.categories');
Route::post('/admin/create/category', [CategoriesController::class, 'createCategory']);
Route::delete('/home/category/{id}', [CategoriesController::class, 'deleteCategoryById']);
Route::post('/admin/edit/category/{id}', [CategoriesController::class, 'editCategoryById']);


//brands
Route::get('/admin/brands', [BrandsController::class, 'viewAdminBrands'])->name('admin.brands');
Route::post('/admin/create/brand', [BrandsController::class, 'createBrand']);
Route::delete('/home/brand/{id}', [BrandsController::class, 'deleteBrandById']);
Route::post('/admin/edit/brand/{id}', [BrandsController::class, 'editBrandById']);


// sua fil nay
Route::post('/search', [\App\Http\Controllers\SearchController::class, 'searchByName']);
