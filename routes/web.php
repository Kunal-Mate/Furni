<?php

use App\Http\Controllers\FrontendController;
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



Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/categories', [FrontendController::class, 'categories'])->name('categories');
Route::get('/catalog', [FrontendController::class, 'catalog'])->name('catalog');

Route::get('/product-details/{id}', [FrontendController::class, 'productDetails'])->name('product.details');
Route::get('/product-general', [FrontendController::class, 'productGeneral'])->name('product-general');
Route::get('/product-review', [FrontendController::class, 'productReview'])->name('product-review');




// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('frontend.index');
// })->name('index');

// Route::get('/categories', function () {
//     return view('frontend.categories');
// })->name('categories');

// Route::get('/catalog', function () {
//     return view('frontend.catalog');
// })->name('catalog');

// Route::get('/product-details', function () {
//     return view('frontend.product-details');
// })->name('product-details');

// Route::get('/product-general', function () {
//     return view('frontend.product-general');
// })->name('product-general');

// Route::get('/product-review', function () {
//     return view('frontend.product-reviews');
// })->name('product-review');