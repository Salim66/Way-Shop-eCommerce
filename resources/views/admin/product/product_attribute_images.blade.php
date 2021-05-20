@extends('admin.layouts.master')

@section('title', 'Add Products Attributs Images')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1>Product Attributs</h1>
            <small>List of Products Attributes</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Product Attributes</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('products.attributs.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="">Product Nmae</label> {{ $product->name }}
                            </div>
                            <div class="form-group">
                                <label for="">Product Code</label> {{ $product->code }}
                            </div>
                            <div class="form-group">
                                <label for="">Product Color</label> {{ $product->color }}
                            </div>
                            <div class="form-group">
                                <label for="">Product Price</label> {{ $product->price }}
                            </div>
                            <div class="form-group">
                                <div class="form-group col-sm-6">
                                    <label title="Upload Image" for="product_attr_image"><i
                                            class="fa fa-image fa-5x text-success"></i></label>
                                    <input type="file" name="attr_image[]" class="form-control" multiple
                                        style="display: none;" id="product_attr_image">
                                    <div id="attr_image">
                                        <img id="product_attr_image_load" src="" alt=""
                                            style="width: 100px; margin-left: 20px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <input type="submit" class="btn btn-primary" value="Add Image">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    {{-- <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>View Product Attributes</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('products.attributes.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="info">
                    <th>#</th>
                    <th>Product ID</th>
                    <th>SKU</th>
                    <th>SIZE</th>
                    <th>PRICE</th>
                    <th>STOCK</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pro_attr as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td>{{ $attribute->product_id }}</td>
                    <td style="display: none;">
                        <input type="hidden" name="product_id" class="form-control"
                            value="{{ $attribute->product_id }}">
                    </td>
                    <td>
                        <input type="text" name="sku[]" class="form-control" value="{{ $attribute->sku }}">
                    </td>
                    <td>
                        <input type="text" name="size[]" class="form-control" value="{{ $attribute->size }}">
                    </td>
                    <td>
                        <input type="text" name="price[]" class="form-control" value="{{ $attribute->price }}">
                    </td>
                    <td>
                        <input type="text" name="stock[]" class="form-control" value="{{ $attribute->stock }}">
                    </td>
                    <td width="17%" class="text-center">

                        <button title="Product Attribute Update" type="submit" class="btn btn-sm btn-success"><i
                                class="fa fa-pencil"></i></button>

                        <a title="Product Attribute Delete" class="btn btn-danger btn-sm"
                            href="{{ route('products.attributs.delete', $attribute->id) }}"><i
                                class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </form>
</div>
</div>
</div>
</div>
</section> --}}
<!-- /.content -->

</div>
@endsection