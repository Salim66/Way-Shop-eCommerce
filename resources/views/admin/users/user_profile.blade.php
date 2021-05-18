@extends('admin.layouts.master')

@section('title', 'User Profile')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon"><i class="fa fa-user-circle-o"></i></div>
        <div class="header-title">
            <h1>Profile</h1>
            <small>Show user data in clear profile design</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-3"></div>
            <div class="col-sm-12 col-md-5">
                <div class="card">
                    <div class="card-header">
                        {{-- <div class="card-header-headshot"></div> --}}
                        <img src="{{ URL::to('') }}/uploads/users/{{ $data->photo }}"
                            style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid #fff;"
                            class="shadow" alt="" onerror="this.src='/uploads/users/avatar3.png';">
                    </div>
                    <div class="card-content">
                        <div class="card-content-member text-center">
                            <h4 class="mt-2">{{ $data->name }}</h4>
                            <p class="m-t-0">{{ $data->address }}</p>
                        </div>
                        <table class="table table-striped">
                            <tr>
                                <td>Email</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ $data->mobile }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $data->city }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $data->state }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{ $data->country }}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{ $data->pincode }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.profile.edit', $data->id) }}"
                            class="text-white btn btn-block btn-success"
                            style="height: 40px; font-size: 16px; border-radius: 0px 20px 20px 0px"><i
                                class="fa fa-pencil text-white"></i>
                            Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection