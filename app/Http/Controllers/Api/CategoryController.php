<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function indexCategory(){
        $category=Category::latest()->get();
        return view('dashboard.catgories.indexCategory',[
            'category'=>$category
        ]);
    }
    public function formcategory(){
        return view('dashboard.catgories.formCategory');
    }
    public function storeCategory(Request $request){
        $request->validate([
            'name'=>'required|max:300'
        ]);
        $category=new Category();
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->description=$request->description;
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$imageName);
            $category->image='uploads/'.$imageName;
        }
        $category->save();
        return redirect()->route('indexCategory')->with('success','Category Added Successfuly');
    }
    public function editCategory($id){
        $category=Category::findOrFail($id);
        return view('dashboard.catgories.editCategory',[
            'category'=>$category
        ]);
    }
    public function updateCategory(Request $request ,$id){
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->description=$request->description;
        if($request->hasFile('image')){
            if($category->image){
                $path=public_path($category->image);
                if($path){
                    unlink($path);
                }
            }
            $image=$request->file('image');
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$imageName);
            $category->image='uploads/'.$imageName;
        }
        $category->save();
        return redirect()->route('indexCategory')->with('success','Category Updated Successfully');
    }
    public function deleteCategory($id){
        $category=Category::findOrFail($id);
        if($category->image){
            $path=public_path($category->image);
            if(file_exists($path)){
                unlink($path);
            }
        }
        $category->delete();
        return redirect()->route('indexCategory')->with('success','Category Deleted Successfully');
    }





}
