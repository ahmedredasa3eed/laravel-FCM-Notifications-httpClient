<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    use HasFactory;

    protected $table = 'image_sliders';
    protected $fillable = ['title_ar','title_en','body_ar','body_en','image','status'];

    public function getStatusAttribute($value): string
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
