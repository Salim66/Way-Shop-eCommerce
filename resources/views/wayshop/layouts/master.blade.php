<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

@include('wayshop.layouts.head')

<body>

    @include('wayshop.layouts.header')

    @section('main-content')
    @show


    @include('wayshop.layouts.footer')

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    @include('wayshop.layouts.partials.scripts')
</body>

</html>