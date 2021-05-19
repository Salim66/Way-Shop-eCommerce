@extends('admin.layouts.master')

@section('title', 'Banners Edit')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-pencil"></i>
        </div>
        <div class="header-title">
            <h1>Edit Banners</h1>
            <small>Banners list</small>
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
                            <a class="btn btn-add " href="{{ route('banners.view') }}">
                                <i class="fa fa-list"></i> Banners List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('banners.update', $data->id) }}" method="POST" class="col-sm-12"
                            id="bannerEditForm" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group col-sm-6">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Banner Title"
                                    value="{{ $data->title }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('title'))? @$errors->first('title') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Text Style</label>
                                <input type="text" name="text_style" class="form-control"
                                    placeholder="Banner Text Style" value="{{ $data->text_style }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('text_style'))? @$errors->first('text_style') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Sort Order</label>
                                <input type="text" name="sort_order" class="form-control"
                                    placeholder="Banner Sort Order" value="{{ $data->sort_order }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('sort_order'))? @$errors->first('sort_order') : '' }}</span>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Banner Link</label>
                                <input type="text" name="link" class="form-control" placeholder="Banner Link"
                                    value="{{ $data->link }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('link'))? @$errors->first('link') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Sub Title</label>
                                <textarea name="sub_title" id="sub_title" rows="4" class="form-control"
                                    placeholder="Banner Sub Title">{{ $data->sub_title }}</textarea>
                                <span
                                    class="text-danger">{{ (@$errors->has('sub_title'))? @$errors->first('sub_title') : '' }}</span>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="banner_image"><i class="fa fa-image fa-5x text-success"></i></label>
                                <input type="file" name="image" class="form-control" style="display: none;"
                                    id="banner_image">
                                <img id="banner_image_load" src="{{ URL::to('') }}/uploads/banners/{{ $data->image }}"
                                    alt="" style="width: 120px; margin-left: 60px;">
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
        $("#bannerEditForm").validate({
            rules: {
                title: "required",
                text_style: "required",
                sort_order: "required",
                link: "required",
                sub_title: "required",
            },
            messages: {
                title: "Please enter banner title",
                text_style: "Please enter banner text style",
                sort_order: "Please enter banner sort order",
                link: "Please enter banner link",
                sub_title: "Please enter banner sub title",
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