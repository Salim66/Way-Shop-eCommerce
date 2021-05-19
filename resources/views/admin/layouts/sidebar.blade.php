@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            @if(Auth::user()->user_type == 'Super Admin')
            <li class="treeview {{(@$prefix == '/admin')? 'active' : ""}}">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-user-circle"></i><span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.user.add') }}">Add User</a></li>
                    <li><a href="{{ route('admin.users') }}">User List</a></li>
                </ul>
            </li>
            @endif
            <li class="treeview {{(@$prefix == '/user')? 'active' : ""}}">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i><span>User Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('user.profile.view') }}">View User</a></li>
                    <li><a href="{{ route('user.change.password') }}">Change Password</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/categories')? 'active' : ""}}">
                <a href="#">
                    <i class="glyphicon glyphicon-th-list"></i><span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('user.profile.view') }}">View Categories</a></li>
                    <li><a href="{{ route('user.change.password') }}">Add Category</a></li>
                </ul>
            </li>
            <li>
                <a href="company.html">
                    <i class="fa fa-home"></i> <span>Companies</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->