@extends('layouts.admin_master')

@section('title')
Brands List
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Brands List </h3>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @isset($brands)
                                        @forelse($brands as $brand)
                                        <tr>
                                            <td>{{$brand->id}}</td>
                                            <td>{{$brand->name_ar}}</td>
                                            <td>{{$brand->name_en}}</td>
                                            <td>
                                                <label class="badge @if($brand->status == 'Active') badge-success @else badge-danger @endif">
                                                    {{$brand->status}}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{route('brands.edit',$brand)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{route('brands.destroy',$brand)}}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="5">No Data Found</td>
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
