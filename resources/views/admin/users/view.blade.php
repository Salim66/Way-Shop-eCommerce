@extends('admin.layouts.master')

@section('title', 'Users View')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-user-plus"></i>
        </div>
        <div class="header-title">
            <h1>Users</h1>
            <small>List of User</small>
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
                                <h4>User Details</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="btn-group">
                            <div class="buttonexport">
                                <a href="{{ route('admin.user.add') }}" class="btn btn-add"><i class="fa fa-plus"></i>
                                    Add
                                    Users</a>
                            </div>
                        </div>
                        <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>Photo</th>
                                        <th>User Name</th>
                                        <th>Type</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td><img src="assets/dist/img/m1.png" class="img-circle" alt="User Image"
                                                width="50" height="50"></td>
                                        <td>{{ $user->name }}</td>
                                        <td><span class="label-custom label label-default">{{ $user->user_type }}</span>
                                        </td>
                                        <td width="8%">
                                            <input type="checkbox" class="user_status_update btn btn-success"
                                                data-toggle="toggle" data-size="mini" data-on="Active"
                                                data-off="Inactive" data-id="{{ $user->id }}" data-onstyle="success"
                                                @if($user->status == 1)
                                            checked @endif>
                                        </td>
                                        <td width="10%" class="text-center">
                                            <button type="button" class="btn btn-add btn-sm" data-toggle="modal"
                                                data-target="#update"><i class="fa fa-pencil"></i></button>
                                            <form style="display: inline"
                                                action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="delete" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash-o"></i> </button>
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