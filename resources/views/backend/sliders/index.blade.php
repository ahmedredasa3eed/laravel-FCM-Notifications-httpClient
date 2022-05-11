@extends('layouts.admin_master')

@section('title')
Sliders List
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Sliders List </h3>
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
                                        <th>Title Arabic</th>
                                        <th>Title English</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @isset($sliders)
                                        @forelse($sliders as $slider)
                                        <tr>
                                            <td>{{$slider->id}}</td>
                                            <td>{{$slider->title_ar}}</td>
                                            <td>{{$slider->title_en}}</td>
                                            <td>
                                                <img src="{{asset('images/sliders/'.$slider->image)}}" style="height:50px;width:100px;border-radius:0px;">
                                            </td>
                                            <td>
                                                <label class="badge @if($slider->status == 'Active') badge-success @else badge-danger @endif">
                                                    {{$slider->status}}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{route('sliders.edit',$slider)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{route('sliders.destroy',$slider)}}" class="btn btn-sm btn-danger">Delete</a>
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
