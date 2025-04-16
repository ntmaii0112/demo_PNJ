<?php

use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisterController;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check-email');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

use App\Http\Controllers\User\UserRoleController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/role',[UserRoleController::class,'index'])->name('admin.index');
    Route::post('/admin/role/{user}/addRole',[UserRoleController::class,'addRole'])->name('admin.addRole');
    Route::delete('/admin/role/{user}/removeRole/{role}',[UserRoleController::class,'removeRole'])->name('admin.removeRole');
});

use App\Http\Controllers\Admin\CategoryController;
Route::middleware(['auth', 'is_admin'])->group(function (){
    Route::resource('/admin/category', CategoryController::class);
});

use App\Http\Controllers\Admin\ProductController;
Route::middleware(['auth', 'is_admin'])->group(function (){
    Route::resource('/admin/product', ProductController::class);
});

use App\Http\Controllers\ProductPublicController;
Route::get('/',[ProductPublicController::class,'index'])->name('products.public');
Route::get('/products/{product}',[ProductPublicController::class,'show'])->name('products.public.show');

use App\Http\Controllers\User\CartController;
Route::middleware(['auth'])->group(function (){
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add',[CartController::class,'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

});
