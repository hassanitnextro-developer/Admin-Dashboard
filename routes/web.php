<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategaoryController;
use App\Http\Controllers\Api\ProductController;
// Login Routes
Route::get('admin/login', [AdminController::class, 'showLogin'])->name('showLogin');
Route::post('admin/checkLogin', [AdminController::class, 'login'])->name('login');

// Protected Routes (Dashboard)
Route::prefix('admin/dashboard')
    ->middleware('auth') // ✅ Our custom middleware (role check + login check)
    ->group(function () {
        Route::get('panel', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('form', [AdminController::class, 'form1'])->name('form1');
        Route::get('table', [AdminController::class, 'table'])->name('table');
        Route::get('Update/profile', [AdminController::class, 'profile'])->name('update.profile');
        Route::put('Update/profile', [AdminController::class, 'updateProfile'])->name('update');
        // category form
        Route::get('addCategory', [CategoryController::class,'formCategory'])->name('addCategory');
        Route::post('storeCategory', [CategoryController::class,'storeCategory'])->name('storeCategory');
        Route::get('indexCategory', [CategoryController::class,'indexCategory'])->name('indexCategory');
        Route::get('editCategory/{id}', [CategoryController::class,'editCategory'])->name('editCategory');
        Route::put('updateCategory/{id}', [CategoryController::class,'updateCategory'])->name('updateCategory');
        Route::delete('deleteCategory/{id}', [CategoryController::class,'deleteCategory'])->name('deleteCategory');
        // sub category
        route::get('addSubCategory',[SubCategaoryController::class,'formSubCat'])->name('showSub');
        route::post('storeSubCategory',[SubCategaoryController::class,'storeSub'])->name('storeSub');
        route::get('indexSubCategory',[SubCategaoryController::class,'indexSubCategory'])->name('indexSub');
        route::get('editSubCategory/{id}',[SubCategaoryController::class,'editSub'])->name('editSub');
        route::put('updateSubCategory/{id}',[SubCategaoryController::class,'updateSub'])->name('updateSub');
        Route::delete('deleteSubCategory/{id}', [SubCategaoryController::class,'deleteSub'])->name('deleteSub');
        // Add product
        route::get('add/product',[ProductController::class,'addProduct'])->name('addProduct');
        route::post('store/product',[ProductController::class,'storeProduct'])->name('storeProduct');
        route::get('view/product',[ProductController::class,'indexProduct'])->name('indexProduct');
        route::get('filterCategory',[ProductController::class,'SubCategory'])->name('filterSub');
        route::get('editProduct/{id}',[ProductController::class,'editProduct'])->name('editProduct');
        route::put('updateProduct/{id}',[ProductController::class,'updateProduct'])->name('updateProduct');
        route::delete('deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
        route::get('detailProduct/{id}',[ProductController::class,'detailProduct'])->name('detailProduct');


        route::get('logout',[AdminController::class,'logout'])->name('logout');

    });







