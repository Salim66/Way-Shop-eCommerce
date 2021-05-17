<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:06:57 GMT -->

@include('admin.layouts.head')

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    {{-- <div id="preloader">
        <div id="status"></div>
    </div> --}}
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        @section('main-content')
        @show()

        @include('admin.layouts.footer')
    </div>
    <!-- /.wrapper -->
    @include('admin.layouts.partials.scripts')
</body>

<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:08:11 GMT -->

</html>
