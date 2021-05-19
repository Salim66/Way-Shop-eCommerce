@extends('admin.layouts.master')

@section('title', 'Products View')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1>Products</h1>
            <small>List of Products</small>
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
                                <h4>Product Details</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="btn-group">
                            <div class="buttonexport">
                                <a href="{{ route('products.add') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                    Add
                                    Product</a>
                            </div>
                        </div>
                        <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Featured Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_data as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->category->name }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->color }}</td>
                                        <td>
                                            <img src="{{ URL::to('') }}/uploads/products/{{ $data->image }}" alt=""
                                                width="50" height="50">
                                        </td>
                                        <td width="8%">
                                            <input type="checkbox" class="product_status_update btn btn-success"
                                                data-toggle="toggle" data-size="mini" data-on="Active"
                                                data-off="Inactive" data-id="{{ $data->id }}" data-onstyle="success"
                                                @if($data->status == 1)
                                            checked @endif>
                                        </td>
                                        <td width="8%" class="text-center">
                                            <input type="checkbox" class="featured_product_update btn btn-success"
                                                data-toggle="toggle" data-size="mini" data-on="Active"
                                                data-off="Inactive" data-id="{{ $data->id }}"
                                                @if($data->featured_product == 1) checked
                                            @endif>
                                        </td>
                                        <td width="10%" class="text-center">
                                            <a title="Edit" href="{{ route('categories.edit', $data->id) }}"
                                                class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <form style="display: inline"
                                                action="{{ route('categories.delete', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Delete" type="submit" id="delete"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection