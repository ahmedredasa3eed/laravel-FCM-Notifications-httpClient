<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesSliderRequest;
use App\Http\Requests\ProductsRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageSlider;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImagesSliderController extends Controller
{
    public function index(){

        $sliders = ImageSlider::all();
        return view('backend.sliders.index',compact('sliders'));
    }

    public function create(){

        return view('backend.sliders.create');
    }

    public function store(ImagesSliderRequest $request){

        //dd($request);
        try {

            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }

            if($request->has('image')){
                $image_path = upload($request,'image','images/sliders/');
                $data['image'] = $image_path;
            }

            //dd($data);
            $slider = ImageSlider::create($data);

            if($slider){
                notify()->success('Slider Added Successfully');
                return redirect()->route('sliders.index');
            }else{
                notify()->error('Some Thing Went error');
                return redirect()->route('sliders.index');
            }

            DB::commit();

        }catch (\Exception $ex)
        {
            DB::rollBack();
            notify()->error($ex->getMessage());
        }
    }

    public function edit($slider_id){

        $slider = ImageSlider::findOrFail($slider_id);
        return view('backend.sliders.edit',compact('slider'));
    }

    public function update(ImagesSliderRequest $request, $slider_id){
        try {

            $slider = ImageSlider::findOrFail($slider_id);

            $data = $request->except('status','_token');
            if($request->has('status')){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }

            if($request->has('image')){
                $image_path = upload($request,'image','images/sliders/');
                $data['image'] = $image_path;
            }

            //dd($data);
            $slider_updated = $slider->update($data);
            if($slider_updated){
                notify()->success('Slider Updated Successfully');
            }else{
                notify()->error('Error Happened');
            }
            return redirect()->route('sliders.index');

        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($slider_id){
        $slider = ImageSlider::findOrFail($slider_id);
        $slider->delete();
        File::delete(public_path('images/sliders/'.$slider->image));
        notify()->success('Slider Deleted Successfully');
        return redirect()->route('sliders.index');
    }

}
