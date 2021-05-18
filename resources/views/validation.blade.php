<script type="text/javascript">
    //Success Message
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    //Warnning Message
    @if(Session::has('error'))
        // toastr.warning("{{ Session::get('warning') }}");
        Lobibox.alert('error', {msg: "{{ Session::get('error') }}" });
    @endif
    //Error Message
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>