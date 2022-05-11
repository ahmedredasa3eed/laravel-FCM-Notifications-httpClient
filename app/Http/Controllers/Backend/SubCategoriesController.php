<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\SubCategoriesRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{

    public function index($category){

        $category = Category::find($category);
        $subCategories = $category->subCategories;
        return view('backend.sub_categories.index',compact('subCategories'));
    }

    public function create(){
        $categories = Category::all();
        return view('backend.sub_categories.create',compact('categories'));
    }

    public function store(SubCategoriesRequest $request){

        //dd($request);
        try {
            $data = $request->except('status','_token');

            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $subCategory = SubCategory::create($data);
            if($subCategory){
                notify()->success('SubCategory Added Successfully');
                return redirect()->route('sub_categories.index',$request->category_id);
            }
        }catch (\Exception $ex)
        {
            return $ex->getMessage();
            notify()->error($ex->getMessage());
        }
    }

    public function edit($subCategory){

        $subCategory = SubCategory::findOrFail($subCategory);
        $categories = Category::all();
        return view('backend.sub_categories.edit',compact('subCategory','categories'));
    }

    public function update(SubCategoriesRequest $request, $subCategory){
        try {
            $subCategory = SubCategory::findOrFail($subCategory);

            //dd($subCategory);
            $data = $request->except('status');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $subCategory_updated = $subCategory->update($data);
            if($subCategory_updated){
                notify()->success('SubCategory Updated Successfully');
                return redirect()->route('sub_categories.index',$subCategory->category_id);
            }else{
                notify()->error('Error Happened');
                return redirect()->route('sub_categories.index',$subCategory->category_id);
            }
        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($subCategory){
        try {
            $subCategory = SubCategory::findOrFail($subCategory);
            $subCategory->delete();
            notify()->success('SubCategory Deleted Successfully');
            return redirect()->route('sub_categories.index',$subCategory->category_id);
        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }
    }
}
