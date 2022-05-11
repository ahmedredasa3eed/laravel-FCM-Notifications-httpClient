@extends('layouts.admin_master')

@section('title')
    SubCategories List
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> SubCategories List </h3>
                <a href="{{route('sub_categories.create')}}" class="btn btn-sm btn-success">Add New SubCategory</a>

            </div>
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name Arabic</th>
                                        <th>Name English</th>
                                        <th>Main Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @isset($subCategories)
                                        @forelse($subCategories as $subCategory)
                                        <tr>
                                            <td>{{$subCategory->id}}</td>
                                            <td>{{$subCategory->name_ar}}</td>
                                            <td>{{$subCategory->name_en}}</td>
                                            <td>{{$subCategory->category->name_en}}</td>
                                            <td>
                                                <label class="badge @if($subCategory->status == 'Active') badge-success @else badge-danger @endif">
                                                    {{$subCategory->status}}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{route('sub_categories.edit',$subCategory)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{route('sub_categories.destroy',$subCategory)}}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="6">No Data Found</td>
                                        @endforelse
                                    @endisset

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@stop
