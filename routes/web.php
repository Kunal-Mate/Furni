<?php

use App\Http\Controllers\TempImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
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



Route::group(['prefix' => 'policies'], function () {
    Route::get('/terms-of-service', function () {
        return view('frontend\policy\terms-of-service');
    })->name('terms-of-service');

    Route::get('/privacy-policy', function () {
        return view('frontend\policy\privacy-policy');
    })->name('privacy-policy');

    Route::get('/refund-policy', function () {
        return view('frontend\policy\refund-policy');
    })->name('refund-policy');

    Route::get('/shipping-policy', function () {
        return view('frontend\policy\shipping-policy');
    })->name('shipping-policy');


});




Route::get('/location', function () {
    return redirect('https://www.google.com/maps?q=19.250020709045113,73.1224331939146');
})->name('location.redirect');

Route::group(['prefix' => 'Admin', 'middleware' => 'auth:admin'], function () {
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




    Route::group(['prefix' => 'property'], function () {
        Route::get('/', [PropertyController::class, 'index'])->name('property');
        Route::get('/create', [PropertyController::class, 'create'])->name('property.create');
        Route::get('/show/{id}', [PropertyController::class, 'show'])->name('property.show');
        Route::post('/store', [PropertyController::class, 'store'])->name('property.store');
        Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
        Route::put('/update/{id}', [PropertyController::class, 'update'])->name('property.update');
        Route::post('/delete', [PropertyController::class, 'delete'])->name('property.delete');
    });

    Route::prefix('booking')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('booking.index');
        Route::get('/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/store', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
        Route::post('/update/{id}', [BookingController::class, 'update'])->name('booking.update');
        Route::post('/delete/{id}', [BookingController::class, 'destroy'])->name('booking.delete');
        Route::get('/send-whatsapp/{id}', [BookingController::class, 'sendWhatsApp'])->name('booking.send.whatsapp');
        Route::get('/send-email/{id}', [BookingController::class, 'sendEmail'])->name('booking.send.email');
    });

    // category
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categ');
        Route::post('/', [CategoryController::class, 'store'])->name('cate.store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('cate.update');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('cate.delete');
    });

    // product
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/delete', [ProductController::class, 'delete'])->name('products.delete');
        Route::post('/deletePrice', [ProductController::class, 'deletePrice'])->name('products.updatePrice');
    });


    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('orders.edit');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        // Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::post('/delete', [OrderController::class, 'delete'])->name('orders.delete');
        // Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/updateStatus', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    });




    Route::post('/upload-temp-img', [TempImageController::class, 'create'])->name('temp-image.create');
    Route::get('/getSlug', function (Request $request) {
        $slug = '';
        if (!empty($request->title)) {
            $slug = Str::slug($request->title);
        }
        return response()->json(['status' => true, 'slug' => $slug]);
    })->name('getSlug');
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