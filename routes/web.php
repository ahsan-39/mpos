<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Pharmacy\SupplierController;
use App\Http\Controllers\Pharmacy\InventoryController;
use App\Http\Controllers\Pharmacy\StockController;

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
    Route::get('categories', [InventoryController::class,'categories'])->name('category.list');
    Route::get('sub-category', [InventoryController::class,'subCategories'])->name('sub.category.list');
    Route::get('generic', [InventoryController::class,'generic'])->name('generic.list');
    Route::get('item-dosage-forms', [InventoryController::class,'dosageForms'])->name('dosage.forms.list');
    Route::get('item-dosage-routes', [InventoryController::class,'dosageRoutes'])->name('dosage.routes.list');
    Route::get('item-strength', [InventoryController::class,'strength'])->name('strength.list');
    Route::get('item-units', [InventoryController::class,'units'])->name('unit.list');
    Route::get('size-specification', [InventoryController::class,'specification'])->name('size.specification.list');
    Route::get('item-definition', [InventoryController::class,'definition'])->name('item.definition.list');

    //Stock
    Route::get('stock-listing', [StockController::class,'index'])->name('stock.list');
    Route::get('stock-summary', [StockController::class,'summary'])->name('stock.summary.list');

});

