<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageSlider;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){

        $categories = Category::with('subCategories')->get();

        $latest_products = Product::with('category')->orderBy('id', 'desc')->take(7)->get();
        $featured_products = Product::with('category')->where('featured','=', 1)->get();

        $sliders = ImageSlider::where('status', 1)->get();

        return view('frontend.index',compact('categories','sliders','latest_products','featured_products'));
    }
}
