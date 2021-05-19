@extends('admin.layouts.master')

@section('title', 'Products Edit')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-pencil"></i>
        </div>
        <div class="header-title">
            <h1>Edit Product</h1>
            <small>Proudcts list</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="{{ route('products.view') }}">
                                <i class="fa fa-list"></i> Products List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('products.update', $data->id) }}" method="POST" class="col-sm-12"
                            id="productEditForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-sm-6">
                                <label>Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ ($data->category_id == $category->id)? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Product Name"
                                    value="{{ $data->name }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('name'))? @$errors->first('name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Product Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Product Code"
                                    value="{{ $data->code }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('code'))? @$errors->first('code') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Product Color</label>
                                <input type="text" name="color" class="form-control" placeholder="Product Color"
                                    value="{{ $data->color }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('color'))? @$errors->first('color') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control">{{ $data->description }}</textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('description'))? @$errors->first('description') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="product_image"><i class="fa fa-image fa-5x text-success"></i></label>
                                <input type="file" name="image" class="form-control" style="display: none;"
                                    id="product_image">
                                <img id="product_image_load"
                                    src="{{ URL::to('/') }}/uploads/products/{{ $data->image }}" alt=""
                                    style="width: 120px; margin-left: 60px;">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Product Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Product Price"
                                    value="{{ $data->price }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('price'))? @$errors->first('price') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-3" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    $(function(){
        $("#productEditForm").validate({
            rules: {
                category_id: "required",
                name: "required",
                code: "required",
                color: "required",
                description: "required",
                price: "required",
            },
            messages: {
                category_d: "Please select category name",
                name: "Please enter product name",
                code: "Please enter product code",
                color: "Please enter product color",
                price: "Please enter product price",
                description: "Please enter category description",
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<style>
    .error {
        color: red;
        font-weight: bold;
    }
</style>
@endsection