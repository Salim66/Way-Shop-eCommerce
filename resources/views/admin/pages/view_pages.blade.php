@extends('admin.layouts.master')

@section('title', 'Pages View')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-image"></i>
        </div>
        <div class="header-title">
            <h1>Pages</h1>
            <small>List of Pages</small>
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
                                <h4>Page Details</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="btn-group">
                            <div class="buttonexport">
                                <a href="{{ route('pages.add') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                    Add
                                    Page</a>
                            </div>
                        </div>
                        <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>#</th>
                                        <th>Page Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_data as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->page_name }}</td>
                                        <td width="8%">
                                            <input type="checkbox" class="banner_status_update btn btn-success"
                                                data-toggle="toggle" data-size="mini" data-on="Active"
                                                data-off="Inactive" data-id="{{ $data->id }}" data-onstyle="success"
                                                @if($data->status == 1)
                                            checked @endif>
                                        </td>
                                        <td width="10%" class="text-center">
                                            <a title="Edit" href="" class="btn btn-add btn-sm"><i
                                                    class="fa fa-pencil"></i></a>

                                            <form style="display: inline" action="" method="POST">
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