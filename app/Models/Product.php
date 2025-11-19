<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'pName','slug','category_id','subCategory_id','price','stock','sizes','description','colors','images'
    ];
    protected $casts=[
        'colors'=>'array',
        'images'=>'array',
        'sizes'=>'array'
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subCategory_id','id');
    }
}
