@extends('layouts.admin_master')

@section('title')
Products List
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Products List </h3>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @isset($products)
                                        @forelse($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>
                                                <img src="{{asset('images/products/'.$product->main_image)}}">
                                            </td>
                                            <td>{{$product->name_en}}</td>
                                            <td>{{$product->category->name_en}}</td>
                                            <td>{{$product->brand->name_en}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->stock}}</td>
                                            <td>
                                                <label class="badge @if($product->status == 'Active') badge-success @else badge-danger @endif">
                                                    {{$product->status}}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{route('products.edit',$product)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{route('products.destroy',$product)}}" class="btn btn-sm btn-danger">Delete</a>
                                                <a href="{{route('products.changeProductFeaturedStatus',$product)}}" class="btn btn-sm btn-primary">
                                                    @if($product->featured == 0 ) Featured @else UnFeatured @endif
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="9">No Data Found</td>
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
