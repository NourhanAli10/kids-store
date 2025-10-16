<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\dashboard\BrandController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ColorController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\SizeController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\store\CartController;
use App\Http\Controllers\store\HomeController;
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







// ---------------------------Dashboard---------------------------------- //
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// ['auth', 'admin']
Route::middleware('web')->name('dashboard.')->prefix('/dashboard')->group(function () {
    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');

    //categories//

    Route::controller(CategoryController::class)
        ->group(function () {
            Route::get("/categories", 'index')->name('categories');
            Route::get("/categories/add", 'create')->name('add-category');
            Route::post("/categories/add", 'store');
            Route::get("/categories/edit/{id}", 'edit')->name('update-category');
            Route::put("/categories/edit/{id}", 'update');
            Route::delete("/categories/delete/{id}", 'destroy')->name('delete-category');
        });


    Route::controller(BrandController::class)
        ->group(function () {
            Route::get("/brands", 'index')->name('all-brands');
            Route::get("/brands/add", 'create')->name('add-brand');
            Route::post("/brands/add", 'store');
            Route::get("/brands/edit/{id}", 'edit')->name('update-brand');
            Route::put("/brands/edit/{id}", 'update');
            Route::delete("/brands/delete/{id}", 'destroy')->name('delete-brand');
        });

    Route::resource('/users', UserController::class);
    Route::resource('/colors', ColorController::class);
    Route::resource('/sizes', SizeController::class);
    Route::resource('/products', ProductController::class);

});




// Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
//     ->name('admin.login');

// Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);



// Route::get('/admin/register', [RegisteredUserController::class, 'create'])->name('admin.register');
// Route::post('/admin/register', [RegisteredUserController::class, 'store']);

