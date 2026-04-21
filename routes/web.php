<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\WishlistController;
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

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::post('/adminlogin', [AdminController::class, 'adminloginSubmit'])->name('admin.login');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('about-us', [FrontendController::class, 'aboutus'])->name('product.detail');

Route::controller(FrontendController::class)->group(function () {
   
    Route::get('user/logout', 'logout')->name('user.logout');
  
    Route::get('password/forget', 'showForgotForm')->name('password.request');
    Route::post('password/email', 'sendResetLink')->name('password.email');
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'resetPassword')->name('password.update');
    Route::get('/', 'home')->name('home');
    Route::get('/home', 'index');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/contact', 'contact')->name('contact');
});
Route::middleware('auth')->group(function () {

    Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    Route::put('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
 
    Route::get('/user-order', [HomeController::class, 'orderIndex'])->name('user.order.index');
 
    
    Route::get('/order/show/{id}',[HomeController::class, 'ordershow'])->name('user.order.show');
    Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
    Route::post('/postuser-review', [HomeController::class, 'productReviewStore'])->name('user.productreview.store');
    Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

   
    Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');
    Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

    Route::controller(CartController::class)->group(function () {
        Route::get('/add-to-cart/{slug}', 'addToCart')->name('add-to-cart');
        Route::post('/add-to-cart', 'singleAddToCart')->name('single-add-to-cart');
        Route::get('cart-delete/{id}', 'cartDelete')->name('cart-delete');
        Route::post('cart-update', 'cartUpdate')->name('cart.update');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/orderconfirm', 'orderconfirm')->name('orderconfirm');
    });
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist/{slug}', 'wishlist')->name('add-to-wishlist');
        Route::get('wishlist-delete/{id}', 'wishlistDelete')->name('wishlist-delete');
        Route::get('/wishlist', 'showWishlist')->name('wishlist');
    });
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    Route::post('/esewa/pay', [EsewaController::class, 'pay'])->name('esewa.pay');
    Route::get('/esewa/check', [EsewaController::class, 'check'])->name('esewa.check');
    Route::controller(OrderController::class)->group(function () {
        Route::post('cart/order', 'store')->name('cart.order');
        Route::get('order/pdf/{id}', 'pdf')->name('order.pdf');
        Route::get('/income', 'incomeChart')->name('product.order.income');
    });
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

     Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{id}/mark-as-replied', [ContactController::class, 'markAsReplied'])->name('contacts.mark-as-replied');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/bulk-delete', [ContactController::class, 'destroyBulk'])->name('contacts.bulk-delete');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::post('/admin/category/{id}/child', [CategoryController::class, 'getChild'])->name('category.getChild');

    Route::resource('/review', ProductReviewController::class);
    Route::resource('/blog', BlogController::class)->names([
        'index'   => 'admin.blog.index',
        'create'  => 'admin.blog.create',
        'store'   => 'admin.blog.store',
        'show'    => 'admin.blog.show',
        'edit'    => 'admin.blog.edit',
        'update'  => 'admin.blog.update',
        'destroy' => 'admin.blog.destroy',
    ]);
    Route::resources([
        'banner' => BannerController::class,
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'brand' => BrandController::class,
        'aboutus' => AboutUsController::class,
        'order' => OrderController::class,
    ]);
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent']);
    
});

Route::match(['get', 'post'], '/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');
Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');

// Blog frontend routes
Route::get('/blogs', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('/blogs/{slug}', [FrontendBlogController::class, 'show'])->name('blog.show');