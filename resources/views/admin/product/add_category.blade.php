@extends('admin.layouts.master')

@section('title', 'Categories Add')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-users"></i>
        </div>
        <div class="header-title">
            <h1>Add Category</h1>
            <small>Categories list</small>
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
                            <a class="btn btn-add " href="{{ route('categories.view') }}">
                                <i class="fa fa-list"></i> Categories List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('categories.store') }}" method="POST" class="col-sm-12"
                            id="categoryAddForm">
                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Category Name">
                                <span
                                    class="text-danger">{{ (@$errors->has('name'))? @$errors->first('name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="" selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('description'))? @$errors->first('description') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6" style="margin-top: 25px;">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
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
        $("#categoryAddForm").validate({
            rules: {
                name: "required",
                description: "required",
            },
            messages: {
                name: "Please enter category name",
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