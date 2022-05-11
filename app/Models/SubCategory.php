<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = ['category_id','name_ar','name_en','status'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getStatusAttribute($value): string
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
