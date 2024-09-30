<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('checkGuest')->group(function(){
    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('executelogin');

    // Register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('executeregister');

});

Route::middleware('checkLogin')->group(function(){
    //Search
    Route::get('/search', [SearchController::class, 'index']);
    Route::post('/search', [SearchController::class, 'search'])->name('search');

    //Cart
    Route::post('/addcart{id}', [CartController::class, 'addcart'])->name('addcart');
    Route::get('/cart', [CartController::class, 'index']);
    Route::put('/addQuantity{id}', [CartController::class, 'AddQuantity'])->name('addQuantity');
    Route::put('/minusQuantity{id}', [CartController::class, 'MinusQuantity'])->name('minusQuantity');
    Route::delete('/removecart{id}', [CartController::class, 'RemoveCart'])->name('removeCart');

    //Checkout
    Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::post('/transaction', [TransactionController::class, 'AddTransaction'])->name('addTransaction');

    //Transaction History
    Route::get('/history', [TransactionController::class,'history']);

});

Route::middleware('checkAdmin')->group(function(){
    //Add New Food
    Route::get('/addnewfood', [FoodController::class,'addindex']);
    Route::post('/addnewfood', [FoodController::class, 'addfood'])->name('executeadd');

    //Manage Food
    Route::get('/managefood', [FoodController::class,'manageindex']);
    Route::post('/managefood', [SearchController::class,'managesearch'])->name('managesearch');

    //Update Food
    Route::get('/update{id}', [FoodController::class, 'update'])->name('update');
    Route::put('/update{id}', [FoodController::class, 'updatefood'])->name('executeupdate');
    Route::delete('/delete', [FoodController::class, 'delete'])->name('remove');
});

Route::middleware('checkAuth')->group(function(){
    //Edit Profile
    Route::get('/editprofile', [UserController::class, 'index']);
    Route::put('/editprofile', [UserController::class, 'updateProfile'])->name('updateProfile');

    //Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::get('/', [FoodController::class, 'homepage']);
Route::post('/', [FoodController::class, 'categoryfilter'])->name('filtercategory');

//Food Detail
Route::get('/detail{id}',[FoodController::class, 'detail'])->name('detail');
