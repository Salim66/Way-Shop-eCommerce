@extends('admin.layouts.master')

@section('title', 'Page Add')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
            <h1>Add Page</h1>
            <small>Pages list</small>
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
                            <a class="btn btn-add " href="{{ route('pages.view') }}">
                                <i class="fa fa-list"></i> Pages List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST" class="col-sm-12" id="pagesAddForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Page Name</label>
                                <input type="text" name="page_name" id="page_name" class="form-control"
                                    placeholder="Page Name">
                                <span
                                    class="text-danger">{{ (@$errors->has('page_name'))? @$errors->first('page_name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control"
                                    placeholder="Meta Title">
                                <span
                                    class="text-danger">{{ (@$errors->has('meta_title'))? @$errors->first('meta_title') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                    placeholder="Meta Keywords">
                                <span
                                    class="text-danger">{{ (@$errors->has('meta_keywords'))? @$errors->first('meta_keywords') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="2" class="form-control"
                                    placeholder="Meta Description"></textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('meta_description'))? @$errors->first('meta_description') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="content_image">Content Image</label>
                                <input type="file" name="content_image" class="form-control" id="content_image">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="banner_image">Banner Image</label>
                                <input type="file" name="banner_image" class="form-control" id="banner_image">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Short Content</label>
                                <textarea name="short_content" id="short_content" rows="2"
                                    class="form-control"></textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('short_content'))? @$errors->first('short_content') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Long Content</label>
                                <textarea name="long_content" id="summernote" rows="5" class="form-control"></textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('long_content'))? @$errors->first('long_content') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-3" style="margin-top: 25px;">
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
        $("#pagesAddForm").validate({
            rules: {
                page_name: "required",
                meta_title: "required",
                meta_keywords: "required",
                meta_description: "required",
                short_content: "required",
                long_content: "required",
            },
            messages: {
                page_name: "Please enter page name",
                meta_title: "Please enter meta title",
                meta_keywords: "Please enter meta keywords",
                meta_description: "Please enter meta description",
                short_content: "Please enter short content",
                long_content: "Please enter long content",
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