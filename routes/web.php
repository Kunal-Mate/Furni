<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');



Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/setup', [DashboardController::class, 'setup'])->name('setup');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::post('/upload-temp-img', [TempImageController::class, 'create'])->name('temp-image.create');

    // Route::get('/send-testemail', [EmailController::class, 'sendEmail'])->name('sendEmail');

    // Route::get('/email/create', [EmailController::class, 'create'])->name('email.create');
    // Route::get('/email-form', [EmailController::class, 'showForm'])->name('emailForm');
    // Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendEmail');

    //ANCHOR - User Profile
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/userProfile/sessions/{id}', [UserController::class, 'destroySession'])->name('userSessions.destroy');

    //ANCHOR - Roles & Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/delete', [PermissionController::class, 'delete'])->name('permissions.delete');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete', [RoleController::class, 'delete'])->name('roles.delete');
});


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