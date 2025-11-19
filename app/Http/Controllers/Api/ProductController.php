<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class ProductController extends Controller
{
    public function addProduct(){
        $category=Category::get();
        $subCategory=SubCategory::get();
        return view('dashboard.products.addProduct',[
            'category'=>$category,
            'subCategory'=>$subCategory
        ]);
    }
    public function indexProduct(){
        $product=Product::latest()->get();
        return view('dashboard.products.viewProduct',[
            'product'=>$product
        ]);
    }
        // filter subCategory
        public function SubCategory(Request $request){
            $category_id=$request->category_id;
            $subCategory=SubCategory::where('category_id',$category_id)->get();
            return response()->json([
                'status'=>'success',
                'subCategories'=>$subCategory
            ]);
        }
    public function storeProduct(Request $request){
        // Validate request (optional but recommended)
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'subCategory_id' => 'required|exists:sub_categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'size' => 'nullable|array',
            'colors' => 'nullable|array',
            'images' => 'nullable|array'
        ]);

        $product = new Product();
        $product->pName = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->subCategory_id = $request->subCategory_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        $product->sizes = $request->size ? json_encode($request->size) : null;
        $product->colors = $request->colors ? json_encode($request->colors) : null;
        if($request->has('images')){
            $imagesData = [];
            foreach($request->file('images') as $key => $files){
                $imagesData[$key] = [];
                foreach($files as $file){
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('uploads/products'), $filename);
                    $imagesData[$key][] = $filename;
                }
            }
            $product->images = json_encode($imagesData);
        }

        $product->save();

        return redirect()->route('indexProduct')->with('success', 'Product added successfully!');
    }
    // edit product form show
    public function editProduct($id){
        $category=Category::get();
        $subCategory=SubCategory::get();
        $product=Product::findOrFail($id);
        return view('dashboard.products.editProduct',[
            'product'=>$product,
            'category'=>$category,
            'subCategory'=>$subCategory
        ]);
    }
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Basic info update
        $product->pName = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sizes = $request->size ? json_encode($request->size) : null;
        $product->description = $request->description;

        // Colors
        $colors = $request->colors ?? [];
        $product->colors = json_encode($colors);

        // Final images array
        $finalImages = [];

        // 1️⃣ Old images (agar remove nahi ki gayi)
        if ($request->has('old_images')) {
            foreach ($request->old_images as $colorIndex => $images) {
                $finalImages[$colorIndex] = $images;
            }
        }

        // 2️⃣ New uploaded images (⚠️ fix applied here)
        if ($request->file('images')) {
            foreach ($request->file('images') as $colorIndex => $files) {
                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/products/'), $filename);

                        if (!isset($finalImages[$colorIndex])) {
                            $finalImages[$colorIndex] = [];
                        }
                        $finalImages[$colorIndex][] = $filename;
                    }
                }
            }
        }

        // 3️⃣ Ensure har colorIndex ka ek array ho
        foreach ($colors as $colorIndex => $color) {
            if (!isset($finalImages[$colorIndex])) {
                $finalImages[$colorIndex] = [];
            }
        }

        $product->images = json_encode($finalImages);
        $product->save();

        return redirect()->route('indexProduct')->with('success', 'Product updated successfully!');
    }








    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Colors & Images JSON decode
        $images = json_decode($product->images, true) ?? [];

        // Har image ko delete karo (agar file exist kare)
        foreach ($images as $colorImages) {
            foreach ($colorImages as $img) {
                $path = public_path('uploads/products/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // DB record delete
        $product->delete();

        return redirect()->route('indexProduct')->with('success','Product & Images Deleted Successfully');
    }

    public function detailProduct($id){
        $product=Product::findOrFail($id);
        return view('dashboard.products.details',[
            'product'=>$product
        ]);
    }
}
