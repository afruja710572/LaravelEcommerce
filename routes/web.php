<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified','role:user'])->name('dashboard');


Route::middleware('auth', 'role:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'Index')->name('admindashboard');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category', 'Index')->name('allCategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addCategory');
        Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
        Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');

    });
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-sub-category', 'Index')->name('allSubCategory');
        Route::get('/admin/add-sub-category', 'AddSubCategory')->name('addSubCategory');
        Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}', 'Editsubcat')->name ('editsubcat');
        Route::get('/admin/delete-subcategory/{id}', 'Deletesubcat')->name ('deletesubcat');
        Route::post('/admin/update-subcategory', 'UpdateSubCategory')->name('updateSubcategory');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-product', 'Index')->name('allProduct');
        Route::get('/admin/add-product', 'AddProduct')->name('addProduct');
    });
    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-orders', 'Index')->name('pendingOrder');
    });
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
