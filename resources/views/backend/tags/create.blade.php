@extends('layouts.admin_master')

@section('title')
    Create New Tag
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Add New Tag </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{route('tags.store')}}" method="post" class="forms-sample">
                             @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Tag Name : </label>
                                    <input type="text" name="name" value="{{old('name')}}" required class="form-control" placeholder="">
                                    @error('name')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
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
