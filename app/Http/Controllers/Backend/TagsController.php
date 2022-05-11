<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(){

        $tags = Tag::all();
        return view('backend.tags.index',compact('tags'));
    }

    public function create(){
        return view('backend.tags.create');
    }

    public function store(TagsRequest $request){

        try {
            $tag = Tag::create($request->all());
            if($tag){
                notify()->success('Tag Added Successfully');
                return redirect()->route('tags.index');
            }
        }catch (\Exception $ex)
        {
            notify()->error($ex->getMessage());
        }
    }

    public function edit($tag){
        $tag = Tag::findOrFail($tag);
        return view('backend.tags.edit',compact('tag'));
    }

    public function update(TagsRequest $request, $tag){
        try {
            $tag = Tag::findOrFail($tag);
            $tag_updated = $tag->update($request->all());
            if($tag_updated){
                notify()->success('Tag Updated Successfully');
                return redirect()->route('tags.index');
            }else{
                notify()->error('Error Happened');
                return redirect()->route('tags.index');
            }
        }catch (\Exception $ex){
            notify()->error($ex->getMessage());
        }

    }

    public function destroy($tag){
        $tag = Tag::findOrFail($tag);
        $tag->delete();
        notify()->success('Tag Deleted Successfully');
        return redirect()->route('tags.index');
    }
}
