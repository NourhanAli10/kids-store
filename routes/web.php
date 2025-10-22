<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\store\CartController;
use App\Http\controllers\store\HomeController;
use App\Http\Controllers\store\ShopController;
use App\Http\Controllers\store\OrderController;
use App\Http\Controllers\store\ReviewController;
use App\Http\Controllers\store\AddressController;
use App\Http\Controllers\store\ContactController;
use App\Http\Controllers\store\ProductController;
use App\Http\Controllers\store\ProfileController;
use App\Http\Controllers\store\CheckoutController;
use App\Http\Controllers\store\WishlistController;


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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [HomeController::class, 'AboutUs'])->name('home.about-us');

Route::get('/contact-us', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'sendEmail'])->name('contact.submit');



Route::get('/products/{id}-{slug}', [ProductController::class, 'showProduct'])->name('home.product-details');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('home.add-to-cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('home.cart');
Route::get('/cart/save/{id}', [CartController::class, 'saveCartToDatabase']);
Route::delete('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('remove-products-cart');


// *******************profile********************
Route::middleware('auth')->group(function() {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/my-account', 'index')->name('account');
        Route::get('/my-account/profile','show')->name('profile.show');
        Route::get('/my-account/profile/edit','edit')->name('profile.edit');
        Route::put('/my-account/profile/update','update')->name('profile.update');
        Route::put('/my-account/profile/change-password','changePassword')->name('profile.change-password');
    });



Route::controller(AddressController::class)->group(function () {
    Route::get('/my-account/address','show')->name('address.show');
    Route::get('/my-account/add-address','create')->name('address.create');
    Route::post('/my-account/add-address','store')->name('address.store');
    Route::get('/my-account/address/edit/{id}','edit')->name('address.edit');
    Route::put('/my-account/address/update/{id}','update')->name('address.update');
    Route::put('/my-account/address/change-password','changePassword')->name('profile.change-password');
});

Route::controller(OrderController::class)->group(function(){
    Route::get('/my-account/my-orders', 'index')->name('orders');
    Route::get('/order/success/{id}', 'orderSuccess')->name('order.success');


});
});


Route::controller(ShopController::class)->group(function() {
    Route::get('/shop', 'index')->name('shop');

});


Route::controller(CheckoutController::class)->group( function() {
    Route::get('/checkout','index')->name('checkout');
    Route::post('/checkout', 'processOrder')->name('processOrder');
    Route::post('/checkout/shipping-cost', 'getShippingCost')->name('checkout.shipping-cost');

});


Route::controller(ReviewController::class)->group(function() {
    Route::post('products/{product}/reviews', 'store')->name('reviews.store');
    Route::put('reviews/{id}/update', 'update')->name('reviews.update');
    Route::delete('reviews/{id}/delete', 'destroy')->name('reviews.destroy');
});

// *******************Reviews******************
Route::get('products/{id}-{slug}/reviews', [ReviewController::class, 'index'])->name('products.reviews.index');;
Route::post('products/{id}-{slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');;


Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::delete('/wishlist', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::get('my-account/my-orders/manage/{id}' , [OrderController::class, 'manageOrder'])->name('orders.manage');


require __DIR__ . '/auth.php';
