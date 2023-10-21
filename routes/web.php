<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Pharmacy\SupplierController;
use App\Http\Controllers\Pharmacy\Item\CategoryController;

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
    return redirect('dashboard');
});

Auth::routes(
    [
        'register' => false,
        'confirm' => false,
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]
);

Route::get('dev-logout', function(){
  Auth::logout();
  return redirect('/login');
})->name('route-logout');

//Users
Route::get('users', [UserController::class,'index'])->name('users.list');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Pharmacy Store
Route::group(['prefix' => 'pharmacy', 'middleware' => 'auth', 'as' => 'pharmacy.'], function () {
    
    //Suppliers
    Route::get('suppliers', [SupplierController::class,'index'])->name('suppliers.list');

    //Items
    Route::get('categories', [CategoryController::class,'categories'])->name('category.list');
    Route::get('sub-category', [CategoryController::class,'subCategories'])->name('sub.category.list');
    
});

