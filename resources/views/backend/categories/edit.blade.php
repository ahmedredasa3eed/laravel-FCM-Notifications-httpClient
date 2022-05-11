@extends('layouts.admin_master')

@section('title')
    Edit Category
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Edit Category </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            @isset($category)
                            <form action="{{route('categories.update',$category)}}" method="post" class="forms-sample">
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label for="exampleInputName1">Category Name in Arabic : </label>
                                    <input type="text" name="name_ar" value="{{$category->name_ar}}" required class="form-control" placeholder="">
                                    @error('name_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Category Name in English : </label>
                                    <input type="text" name="name_en" value="{{$category->name_en}}" required class="form-control" placeholder="">
                                    @error('name_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status"
                                         class="form-check-input" @if($category->status=='Active') checked @endif > Active </label>
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
