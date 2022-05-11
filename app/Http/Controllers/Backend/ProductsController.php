<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

        $products = Product::with('category','brand')->get();
        return view('backend.products.index',compact('products'));
    }

    public function create(){

        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        return view('backend.products.create',['categories'=> $categories,'brands' => $brands,'tags'=>$tags]);
    }

    public function store(ProductsRequest $request){

        //dd($request);
        try {

            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }

            if($request->has('main_image')){
                $product = new Product();
                $image_path = $product->upload($request,'main_image');
                $data['main_image'] = $image_path;
            }

            $product = Product::create($data);

            $product->tags()->sync($request->tags_id);

            if($product){
                notify()->success('Product Added Successfully');
                return redirect()->route('products.index');
            }

            DB::commit();

        }catch (\Exception $ex)
        {
            DB::rollBack();
            notify()->error($ex->getMessage());
        }
    }

    public function edit($product){
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $product = Product::findOrFail($product);
        return view('backend.products.edit',compact('product','categories','brands','tags'));
    }

    public function update(ProductsRequest $request, $product){
        try {

            $product = Product::findOrFail($product);

            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }

            if($request->has('main_image')){
                $prod = new Product();
                $image_path = $prod->upload($request,'main_image');
                $data['main_image'] = $image_path;
            }

            $product->tags()->sync($request->tags_id);

            $product_updated = $product->update($data);
            if($product_updated){
                notify()->success('Product Updated Successfully');
            }else{
                notify()->error('Error Happened');
            }
            return redirect()->route('products.index');

        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($product){
        $product = Product::findOrFail($product);
        $product->delete();
        File::delete(public_path('images/products/'.$product->main_image));
        notify()->success('Product Deleted Successfully');
        return redirect()->route('products.index');
    }

    public function searchProduct(Request $request){

        $searchText = $request->searchText;

        $products = Product::with('category','brand')
            ->where('name_ar', 'LIKE', "%{$searchText}%")
            ->orWhere('name_en', 'LIKE', "%{$searchText}%")
            ->get();

        return view('backend.products.search_result',compact('products'));
    }

    public function changeProductFeaturedStatus($product){

        $product = Product::findOrFail($product);
        $isFeatured = $product->featured == 1 ? 0 : 1;
        $product->update(['featured' => $isFeatured]);
        notify()->success('Product Featured Changed Successfully');
        return redirect()->route('products.index');


    }
}
