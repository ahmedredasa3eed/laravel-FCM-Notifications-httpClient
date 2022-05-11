@extends('layouts.admin_master')

@section('title')
    Edit SubCategory
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Edit SubCategory </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            @isset($subCategory)
                            <form action="{{route('sub_categories.update',$subCategory)}}" method="post" class="forms-sample">
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label for="exampleInputName1">SubCategory Name in Arabic : </label>
                                    <input type="text" name="name_ar" value="{{$subCategory->name_ar}}" required class="form-control" placeholder="">
                                    @error('name_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">SubCategory Name in English : </label>
                                    <input type="text" name="name_en" value="{{$subCategory->name_en}}" required class="form-control" placeholder="">
                                    @error('name_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleSelectGender">Select Category</label>
                                    <select name="category_id" required class="form-control">
                                        @isset($categories)
                                            @foreach($categories as $category)
                                                <option @if($category->id == $subCategory->category_id) selected @endif value="{{$category->id}}">{{$category->name_en}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>


                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status"
                                         class="form-check-input" @if($subCategory->status=='Active') checked @endif > Active </label>
                                </div>


                                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                            </form>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@stop
