@extends('layouts.admin_master')

@section('title')
    Edit Product
@stop

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Edit Product </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            @isset($product)
                            <form action="{{route('products.update',$product)}}" method="post" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Name in Arabic : </label>
                                    <input type="text" name="name_ar" value="{{$product->name_ar}}" required class="form-control" placeholder="">
                                    @error('name_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Name in English : </label>
                                    <input type="text" name="name_en" value="{{$product->name_en}}" required class="form-control" placeholder="">
                                    @error('name_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleSelectGender">Select Category</label>
                                    <select name="category_id" required class="form-control">
                                        @isset($categories)
                                            @foreach($categories as $category)
                                                <option @if($category->id == $product->category_id) selected @endif value="{{$category->id}}">{{$category->name_en}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Select Brand</label>
                                    <select name="brand_id" required class="form-control">
                                        @isset($brands)
                                            @foreach($brands as $brand)
                                                <option @if($brand->id == $product->brand_id) selected @endif value="{{$brand->id}}">{{$brand->name_en}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleSelectGender">Select Tags</label>
                                    <select name="tags_id[]" multiple required class="form-control">
                                        @isset($tags)
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">Price : </label>
                                    <input type="number" name="price" value="{{$product->price}}" required class="form-control" placeholder="">
                                    @error('price')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">discount : </label>
                                    <input type="number" name="discount" value="{{$product->discount}}" required class="form-control" placeholder="">
                                    @error('discount')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Available Stock : </label>
                                    <input type="number" name="stock" value="{{$product->stock}}" required class="form-control" placeholder="">
                                    @error('stock')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Description in Arabic : </label>
                                    <textarea name="desc_ar"  required class="form-control" placeholder="">{{$product->desc_ar}}</textarea>
                                    @error('desc_ar')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Description in English : </label>
                                    <textarea name="desc_en"  required class="form-control" placeholder="">{{$product->desc_en}}</textarea>
                                    @error('desc_en')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label>Product Main Image</label>
                                    <input type="file" name="main_image" value="{{$product->main_image}}" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                    @error('main_image')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" class="form-check-input" @if($product->status='Active') checked @endif> Active </label>
                                </div>


                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button type="reset" class="btn btn-dark">Cancel</button>
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

@section('scripts')
    <script src="{{asset('backend/assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/file-upload.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead.js')}}"></script>
    <script src="{{asset('backend/assets/js/select2.js')}}"></script>
@stop
