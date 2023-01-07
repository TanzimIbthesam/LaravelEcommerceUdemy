<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UploadController;
use App\Models\Category;
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

Route::get('/', [ClientController::class,'index'])->name('home');

Route::get('/shop',[ClientController::class,'shop'])->name('shop');
Route::get('/cart',[ClientController::class,'cart'])->name('cart');
Route::get('/login',[ClientController::class,'login'])->name('clientlogin');
Route::get('/checkout',[ClientController::class,'checkout'])->name('checkout');
Route::get('/admin',[AdminController::class,'index'])->name('adminlogin');

Route::get('/orders',[OrderController::class,'index'])->name('orders');

Route::resource('slider', SliderController::class);
Route::resource('category',CategoryController::class);

Route::resource('product',ProductController::class);
// Route::get('/category/{category_name}', [ProductController::class,'view_product_by_category'])
// ->name('productbycategory');
// Route::get('/dashboard', function () {
    //Activate deactivate slider
Route::patch('/activate_product/{id}', [ProductController::class,'activateProduct'])->name('activate.product');
Route::patch('/deactivate_product/{id}', [ProductController::class,'deactivateProduct'])->name('deactivate.product');
Route::patch('/activate_slider/{id}', [SliderController::class,'activateSlider'])->name('activate.slider');
Route::patch('/deactivate_slider/{id}', [SliderController::class,'deactivateSlider'])->name('deactivate.slider');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
// Route::get('/testcategories',function($id){
//       $category=Category::find(2);

//       dump($category);
// });

