<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Users\FrontController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;


use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\Admin\ProductImageController;

 





//  login
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('process-register', [AuthController::class,'processRegister'])->name("processRegister");    
Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');







// profile
Route::get('/orders', [AuthController::class,'orders'])->name('account.orders');
Route::get('order-detail/{orderId}', [AuthController::class,'orderDetail'])->name('account.orderDetail');
Route::post('/add-to-wishlist', [AuthController::class,'addWishlist'])->name('account.addWishlist');
Route::get('my-wishlist', [AuthController::class,'wishlist'])->name('account.wishlist');
Route::post('remove-product-from-wishlist', [AuthController::class,'removeProductFromWishlists'])->name('account.removeProductFromWishlists');









// Home 
Route::get('/',[FrontController::class,'index'])->name('user.home');
Route::get('/shop/{slug}',[FrontController::class,'shop'])->name('user.shop');
Route::get('/checkout', [CartController::class,'checkout'])->name('user.checkout');
Route::post('/process-checkout', [CartController::class,'processCheckout'])->name('user.processCheckout');



// categories routes 
Route::get('/categorie/{CategorySlug?}',[FrontController::class,'categorie'])->name('user.categorie');










// The Cart 
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/delete-item', [CartController::class,'deleteItem'])->name('front.deleteItem.cart');
Route::post('/update-cart', [CartController::class,'updateCart'])->name('front.updateCart');













// admin
Route::group(['prefix'=> 'admin'], function () {
    Route::group(['middleware'=> 'admin.auth'], function () {
        Route::get('/dashbordadmin',[DashbordController::class,'dashbord'])->name('admin.dashbord');
        


        // Category Routes
        Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
        Route::get('/categories/create', [CategoryController::class,'create'])->name('category.create');
        Route::post('/categories', [CategoryController::class,'store'])->name('category.store');
        Route::get('/categories/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
        Route::put('/categories/update/{id}', [CategoryController::class,'update'])->name('category.update');
        Route::delete('/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('category.destroy');


        // Category Routes
        Route::get('/product', [ProductController::class,'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
        Route::post('/product', [ProductController::class,'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
        Route::put('/product/update/{id}', [ProductController::class,'update'])->name('product.update');
        Route::delete('/product/destroy/{id}', [ProductController::class,'destroy'])->name('product.destroy');


        // Order Routes 
        Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
        Route::get('/orders/{orderId}',[OrderController::class,'detail'])->name('orders.detail');



 


        // Page User Route
        Route::get('/user', [UserController::class,'index'])->name('user.index');
        Route::delete('/user/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');





        // TempImagesController
        Route::post('/product/upload', [TempImagesController::class, 'create'])->name('temp-images.create');
        Route::delete('/product-images-delete', [TempImagesController::class,'destroy'])->name('temp-images.destroy');

        // ProductImageController
        // Route::post('/product-images/update', [ProductImageController::class,'update'])->name('product-images.store');
        Route::delete('/product-images', [ProductImageController::class,'destroy'])->name('product-images.destroy');





        Route::get('getSlug', function(Request $request){
            $slug = '';
            if(!empty($request->name)){
                $slug = Str::slug(title: $request->name);
            }


            return response()->json([
                'status'=> true,
                'slug'=> $slug,
            ]);
        })->name('getSlug');


    });
});




