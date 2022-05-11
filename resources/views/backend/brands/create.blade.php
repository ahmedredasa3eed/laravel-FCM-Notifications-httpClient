@extends('layouts.admin_master')

@section('title')
    Create New Brand
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Add New Brand </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{route('brands.store')}}" method="post" class="forms-sample">
                             @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Brand Name in Arabic : </label>
                                    <input type="text" name="name_ar" value="{{old('name_ar')}}" required class="form-control" placeholder="">
                                    @error('name_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Brand Name in English : </label>
                                    <input type="text" name="name_en" value="{{old('name_en')}}" required class="form-control" placeholder="">
                                    @error('name_en')
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
