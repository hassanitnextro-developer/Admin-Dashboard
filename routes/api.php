<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\GetPCSController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
;
// Route::get('indexCategory', [CategoryController::class,'indexCategory'])->name('indexCategory');
// route::get('indexSubCategory',[SubCategaoryController::class,'indexSubCategory'])->name('indexSub');
// route::get('view/product',[ProductController::class,'indexProduct'])->name('indexProduct');
route::get('categories',[GetPCSController::class,'getCategory'])->name('category');
route::get('getSubCategory',[GetPCSController::class,'getSubCategory'])->name('subCategory');
route::get('getProduct',[GetPCSController::class,'getProduct'])->name('product');