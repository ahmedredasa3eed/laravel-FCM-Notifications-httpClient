<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index(){

        $brands = Brand::all();
        return view('backend.brands.index',compact('brands'));
    }

    public function create(){
        return view('backend.brands.create');
    }

    public function store(BrandsRequest $request){

        try {
            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $brand = Brand::create($data);
            if($brand){
                notify()->success('Brand Added Successfully');
                return redirect()->route('brands.index');
            }
        }catch (\Exception $ex)
        {
            notify()->error($ex->getMessage());
        }
    }

    public function edit($brand){
        $brand = Brand::findOrFail($brand);
        return view('backend.brands.edit',compact('brand'));
    }

    public function update(BrandsRequest $request, $brand){
        try {
            $brand = Brand::findOrFail($brand);
            $data = $request->except('status');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $brand_updated = $brand->update($data);
            if($brand_updated){
                notify()->success('Brand Updated Successfully');
                return redirect()->route('brands.index');
            }else{
                notify()->error('Error Happened');
                return redirect()->route('brands.index');
            }
        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($brand){
        $brand = Brand::findOrFail($brand);
        $brand->delete();
        notify()->success('Brand Deleted Successfully');
        return redirect()->route('brands.index');
    }
}
