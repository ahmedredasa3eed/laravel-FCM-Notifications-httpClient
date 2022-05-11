<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){

        $categories = Category::all();
        return view('backend.categories.index',compact('categories'));
    }

    public function create(){
        return view('backend.categories.create');
    }

    public function store(CategoriesRequest $request){

        try {
            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $category = Category::create($data);
            if($category){
                notify()->success('Category Added Successfully');
                return redirect()->route('categories.index');
            }
        }catch (\Exception $ex)
        {
            notify()->error($ex->getMessage());
        }
    }

    public function edit($category){
        $category = Category::findOrFail($category);
        return view('backend.categories.edit',compact('category'));
    }

    public function update(CategoriesRequest $request, $category){
        try {
            $category = Category::findOrFail($category);
            $data = $request->except('status');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $category_updated = $category->update($data);
            if($category_updated){
                notify()->success('Category Updated Successfully');
                return redirect()->route('categories.index');
            }else{
                notify()->error('Error Happened');
                return redirect()->route('categories.index');
            }
        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($category){
        $category = Category::findOrFail($category);
        $category->delete();
        notify()->success('Category Deleted Successfully');
        return redirect()->route('categories.index');
    }
}
