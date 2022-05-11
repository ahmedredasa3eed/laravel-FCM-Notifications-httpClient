<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name_ar','name_en','status'];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function getStatusAttribute($value): string
    {
         return $value == 1 ? 'Active' : 'Inactive';
    }
}
