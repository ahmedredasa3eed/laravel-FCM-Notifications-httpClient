<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['category_id','brand_id','name_ar','name_en','desc_ar','desc_en','price',
        'discount','stock','main_image','status','featured'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function features(){
        return $this->hasMany(ProductFeature::class,'product_id','id');
    }

    public function cart(){
        return $this->hasMany(Cart::class,'product_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag',
            'product_id','tag_id','id','id');
    }

    public function getStatusAttribute($value){
        return $value == 1 ? 'Active' : 'Inactive';
    }

    public static function upload($request,$name){
        if($request->file($name)){
            $file= $request->file($name);
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            return $filename;
        }
    }
}
