<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
class GetPCSController extends Controller
{
    public function getCategory(){
        $category=Category::with('subCategories')->latest()->get();
        return response()->json([
            $category
        ]);
    }
    public function getSubCategory(){
        $subCategory=SubCategory::latest()->get();
        return response()->json([
            $subCategory
        ]);
    }
    public function getProduct(){
        $product=Product::latest()->get();
        return response()->json([
            $product
        ]);
    }
}
