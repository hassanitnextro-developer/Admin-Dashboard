<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategaoryController extends Controller
{
    public function formSubCat(){
        $category=Category::get();
        return view('dashboard.subCatgories.addSubcategaory',[
            'category'=>$category
        ]);
    }
    public function indexSubCategory(){
        $subCategory = SubCategory::with('category')->latest('id')->get();
        return view('dashboard.subCatgories.indexSubCategaory',[
            'subCategory'=>$subCategory
        ]);
    }
    public function storeSub(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->description = $request->description;
        $subCategory->slug = $request->slug;
        $subCategory->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $subCategory->image = 'uploads/' . $imageName;
        }

        $subCategory->save();
        return redirect()->route('indexSub')->with('success', 'Subcategory added successfully!');
    }
    public function editSub($id){
        $category=Category::get();
        $subCat=SubCategory::findOrFail($id);
        return view('dashboard.subCatgories.editSubCategory',[
            'category'=>$category,
            'subCat'=>$subCat
        ]);
    }
    public function updateSub(Request $request,$id){
        $subCat=SubCategory::findOrFail($id);

        $subCat->name=$request->name;
        $subCat->slug=$request->slug;
        $subCat->description=$request->description;
        $subCat->category_id = $request->category_id;
        if($request->hasFile('image')){
            if($subCat->image){
                $path=public_path($subCat->image);
                if($path){
                    unlink($path);
                }
            }
            $image=$request->file('image');
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$imageName);
            $subCat->image='uploads/'.$imageName;
        }
        $subCat->save();
        return redirect()->route('indexSub')->with('success','SubCategory Updated Successfully');
    }
    public function deleteSub($id){
        $subCat=SubCategory::findOrFail($id);
        if($subCat->image){
            $path=public_path($subCat->image);
            if(file_exists($path)){
                unlink($path);
            }
        }
        $subCat->delete();
        return redirect()->route('indexSub')->with('success','SubCategory Deleted Successfully');
    }
}
