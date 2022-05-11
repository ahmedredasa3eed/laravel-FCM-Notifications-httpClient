@extends('layouts.admin_master')

@section('title')
    Create New Slider
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Add New Slider </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                             @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Slider Title in Arabic : </label>
                                    <input type="text" name="title_ar" value="{{old('title_ar')}}" required class="form-control" placeholder="">
                                    @error('title_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Slider Title in English : </label>
                                    <input type="text" name="title_en" value="{{old('title_en')}}" required class="form-control" placeholder="">
                                    @error('title_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">Product Description in Arabic : </label>
                                    <textarea name="body_ar" required class="form-control" placeholder="">{{old('body_ar')}}</textarea>
                                    @error('body_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Description in English : </label>
                                    <textarea name="body_en" required class="form-control" placeholder="">{{old('body_en')}}</textarea>
                                    @error('body_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>




                               <div class="form-group">
                                    <input type="file" name="image" value="{{old('image')}}" required class="form-control">
                                    @error('image')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>



                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" class="form-check-input" checked> Active </label>
                                </div>


                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button type="reset" class="btn btn-dark">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>

@stop



