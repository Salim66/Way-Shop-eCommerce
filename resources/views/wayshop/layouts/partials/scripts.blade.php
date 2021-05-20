<!-- ALL JS FILES -->

<script src="{{ asset('wayshop/assets/js/')}}/popper.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="{{ asset('wayshop/assets/js/')}}/jquery.superslides.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/bootstrap-select.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/inewsticker.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/bootsnav.js."></script>
<script src="{{ asset('wayshop/assets/js/')}}/images-loded.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/isotope.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/owl.carousel.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/baguetteBox.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/form-validator.min.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/contact-form-script.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/custom/custom.js"></script>
<script src="{{ asset('wayshop/assets/js/')}}/custom.js"></script>

@if(Session::has('success'))
<script type="text/javascript">
    $(function(){
        $.notify("{{ Session::get('success') }}", {globalPosition: 'top right', className: 'success'});
    });
</script>
@endif
@if(Session::has('error'))
<script type="text/javascript">
    $(function(){
        $.notify("{{ Session::get('error') }}", {globalPosition: 'top right', className: 'error'});
    });
</script>
@endif