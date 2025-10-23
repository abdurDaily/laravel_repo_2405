<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Frontend\HoomePageController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\UserProfile\UserProfileUpdateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//* BACKEND

Route::middleware('auth')->prefix('profile-update')->name('profile.')->group(function () {
    Route::get('/index', [UserProfileUpdateController::class,'index'])->name('user.update');
    Route::put('/user-info', [UserProfileUpdateController::class,'userInfoUpdate'])->name('user.info.update');
    Route::put('/user-profile-update', [UserProfileUpdateController::class,'userprofileUpdate'])->name('profile.update');
});


//* CATEGORY

Route::middleware('auth')->prefix('category')->name('category.')->group(function () {
    Route::get('/index', [CategoryController::class,'index'])->name('index');
    Route::post('/index', [CategoryController::class,'store'])->name('store');
    Route::get('/show', [CategoryController::class,'show'])->name('show');
    Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('edit');
    Route::put('/update/{id}', [CategoryController::class,'update'])->name('update');
    Route::get('/delete/{id}', [CategoryController::class,'delete'])->name('delete');
});


//* PRODUCT

Route::middleware('auth')->prefix('product')->name('product.')->group(function () {
    Route::get('/index', [ProductController::class,'index'])->name('index');
    Route::post('/index', [ProductController::class,'storeProduct'])->name('store');
    Route::get('/show', [ProductController::class,'showProduct'])->name('show');
    Route::get('/product-images', [ProductController::class,'productImages'])->name('product.images');
    Route::get('/product-images-show', [ProductController::class,'productImagesShow'])->name('product.images.show');
    Route::post('/product-images-store', [ProductController::class,'storeProductImages'])->name('images.store');
});


Route::get('/', [HoomePageController::class,'index'])->name('index');



// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END






require __DIR__.'/auth.php';
