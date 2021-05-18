@extends('admin.layouts.master')

@section('title', 'Users Edit')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-users"></i>
        </div>
        <div class="header-title">
            <h1>Edit Users</h1>
            <small>Customer list</small>
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
                            <a class="btn btn-add " href="{{ route('admin.users') }}">
                                <i class="fa fa-list"></i> Customer List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.user.update', $data->id) }}" method="POST" class="col-sm-12">
                            @csrf
                            @method('PATCH')
                            <div class="form-group col-sm-6">
                                <label>User Name</label>
                                <input type="text" name="name" class="form-control" placeholder="User Name"
                                    value="{{ $data->name }}" required>
                                <span
                                    class="text-danger">{{ (@$errors->has('name'))? @$errors->first('name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                    value="{{ $data->email }}" required>
                                <span
                                    class="text-danger">{{ (@$errors->has('email'))? @$errors->first('email') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Super Admin"
                                        {{ ($data->user_type == 'Super Admin')? 'selected' : '' }}>Super Admin</option>
                                    <option value="Admin" {{ ($data->user_type == 'Admin')? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="Author" {{ ($data->user_type == 'Author')? 'selected' : '' }}>Author
                                    </option>
                                </select>
                                <span
                                    class="text-danger">{{ (@$errors->has('user_type'))? @$errors->first('user_type') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6" style="margin-top: 25px;">
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
@endsection