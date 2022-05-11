@extends('layouts.admin_master')

@section('title')
    Edit Tag
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Edit Tag </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            @isset($tag)
                            <form action="{{route('tags.update',$tag)}}" method="post" class="forms-sample">
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label for="exampleInputName1">Tag Name : </label>
                                    <input type="text" name="name" value="{{$tag->name}}" required class="form-control" placeholder="">
                                    @error('name')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
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
