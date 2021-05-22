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
                    <li><a href="{{ route('categories.view') }}">View Categories</a></li>
                    <li><a href="{{ route('categories.add') }}">Add Category</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/products')? 'active' : ""}}">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('products.view') }}">View Products</a></li>
                    <li><a href="{{ route('products.add') }}">Add Products</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/banners')? 'active' : ""}}">
                <a href="#">
                    <i class="fa fa-image"></i><span>Banners</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('banners.view') }}">View Banners</a></li>
                    <li><a href="{{ route('banners.add') }}">Add Banners</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/coupons')? 'active' : ""}}">
                <a href="#">
                    <i class="fa fa-gift"></i><span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('coupons.view') }}">View Coupon</a></li>
                    <li><a href="{{ route('coupons.add') }}">Add Coupon</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/orders')? 'active' : ""}}">
                <a href="#">
                    <i class="pe-7s-cart"></i><span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('orders.view') }}">View Orders</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$prefix == '/pages')? 'active' : ""}}">
                <a href="#">
                    <i class="fa fa-file"></i><span>CMS Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('pages.view') }}">View Pages</a></li>
                    <li><a href="{{ route('pages.add') }}">Add Pages</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->