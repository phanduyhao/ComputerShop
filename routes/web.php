<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\MainPostController;
use App\Http\Controllers\MainProductController;
use App\Http\Controllers\MainCartController;
use App\Http\Controllers\MainCheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\AddressController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [MainPostController::class, 'index'])->name('post');
Route::get('/posts/{slug}', [MainPostController::class, 'details'])->name('posts.details');

// Danh sách sản phẩm theo danh mục
Route::get('/shop', [MainProductController::class, 'shop'])->name('products.shop');
Route::get('/products/{categorySlug}', [MainProductController::class, 'ShowProduct'])->name('products.showProduct');

// Chi tiết sản phẩm
Route::get('/products/details/{slug}', [MainProductController::class, 'ProductDetail'])->name('products.details');

Auth::routes();

// Bài viết
Route::get('/about',[PageController::class,'about']);
Route::get('/contact',[PageController::class,'contact']);
Route::get('/search',[App\Http\Controllers\HomeController::class,'search'])->name('search');

Route::middleware(['auth'])->group(function() {
    Route::post("checkout/Payment", [PaymentController::class, "payment"])->name("checkout.payment.vnpay");
    Route::get("checkout/complete/{code}", [PaymentController::class, "complete"])->name("checkout.complete");
    // Thêm vào giỏ hàng
    Route::post('/addToCart',[MainProductController::class,'addToCart']);

// Giỏ hàng
    Route::get('/carts', [MainCartController::class, 'cart'])->name('carts.index');

// Xóa sản phẩm ở  giỏ hàng
    Route::delete('/carts/{id}', [MainCartController::class,'destroy'])->name('carts.destroy');

// Cập nhật sản phẩm ở giỏ
    Route::post('/carts/updateQuantities', [MainCartController::class, 'updateQuantities'])->name('carts.updateQuantities');

// Chuyển sang trang checkout
    Route::get('/checkout', [MainCheckoutController::class, 'ShowToCheckout'])->name('checkout.showcheckout');

// Thực hiện thanh toán
    Route::post('/process-checkout', [MainCheckoutController::class, 'checkout'])->name('checkout.checkout');

// Thanh toán thành công
    Route::get('/checkout-success', [MainCheckoutController::class, 'showOrder'])->name('checkout.success');
    // Admin
    Route::middleware(['auth', 'checkLevel'])->group(function() {
//    Route::post('/logout',[UsersController::class,'logout'])->name('logout');
        Route::prefix('admin')->group(function () {
            Route::get('/', [HomeController::class, 'home'])->name('admin');

            //            User
            Route::get('/userAdmin',[UsersController::class,'userAdmin'])->name('userAdmin');
            Route::get('/user',[UsersController::class,'user'])->name('user');
            Route::post('/userAdmin',[UsersController::class,'store'])->name('user.store');
            Route::patch('/userAdmin/{user}',[UsersController::class,'update'])->name('user.update');
            Route::delete('/users/{id}', [UsersController::class,'destroy'])->name('users.destroy');

            //            Categories
            Route::resource('cates', CategoryController::class);
            Route::delete('/cates/{id}', [CategoryController::class,'destroy'])->name('cates.destroy');
            Route::post('cates/delete-all', [CategoryController::class,'deleteAllCates'])->name('deleteAllCate');

            //            Products
            Route::resource('products', ProductController::class);
            Route::delete('/products/{id}', [ProductController::class,'destroy'])->name('products.destroy');
            Route::post('products/delete-all', [ProductController::class,'deleteAllProducts'])->name('deleteAllProduct');

            //            Posts
            Route::resource('posts', PostController::class);
            // Route::delete('/posts/{id}', [PostController::class,'destroy'])->name('posts.destroy');
            Route::post('posts/delete-all', [PostController::class,'deleteAllPosts'])->name('deleteAllPost');

            //        Address
            Route::resource('addresses', AddressController::class);

            //        Orders
            Route::resource('orders', OrderController::class);
            Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        });
    });
});

