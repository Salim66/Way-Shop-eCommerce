@extends('admin.layouts.master')

@section('title', 'Products Attributs')

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
                                <div class="field_wrapper">
                                    <div style="display: flex">
                                        <input type="text" name="sku[]" id="sku" class="form-control" placeholder="SKU"
                                            style="width: 120px; margin-right: 5px">
                                        <span>{{ ($errors->has('sku'))? $errors->first('sku') : "" }}</span>
                                        <input type="text" name="size[]" id="size" class="form-control"
                                            placeholder="SIZE" style="width: 120px; margin-right: 5px">
                                        <input type="text" name="price[]" id="price" class="form-control"
                                            placeholder="PRICE" style="width: 120px; margin-right: 5px">
                                        <input type="text" name="stock[]" id="stock" class="form-control"
                                            placeholder="STOCK" style="width: 120px; margin-right: 5px">
                                        <a title="Add Field" href="javascript:void(0);"
                                            class="add_button btn btn-info btn-circle btn-sm"><i
                                                class="fa fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Add Product Attributes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <section class="content">
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
                        <form action="">
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
                                            <td>{{ $attribute->sku }}</td>
                                            <td>{{ $attribute->size }}</td>
                                            <td>{{ $attribute->price }}</td>
                                            <td>{{ $attribute->stock }}</td>
                                            <td width="17%" class="text-center">

                                                <a title="Edit Product" href="#" class="btn btn-add btn-sm"><i
                                                        class="fa fa-pencil"></i></a>

                                                <form style="display: inline" action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Delete Product" type="submit" id="delete"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
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
    </section>
    <!-- /.content -->

</div>
@endsection