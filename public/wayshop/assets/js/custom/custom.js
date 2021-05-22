(function($){
    $(document).ready(function(){


        // Select size find the this size price real time using ajax
        $('.isSize').change(function(event){
            let value = $(this).val();
        
            //send route this value by ajax
            $.ajax({
                url: '/products/size_attribute_to_price_search',
                type: "GET",
                data: {size: value},
                success: function(data){
                    $('#pro_price').html('$'+data);
                    $('#cart_price').val(data);
                },
                error: function(data){
                    $.notify("Something is wrong", {globalPosition: 'top right', className: 'error'});
                }
            });
        });

        // Billing to shipping address copy
        $('#billtoship').click(function(){
            if(this.checked){
                $('#shipping_name').val($('#billing_name').val());
                $('#shipping_address').val($('#billing_address').val());
                $('#shipping_city').val($('#billing_city').val());
                $('#shipping_state').val($('#billing_state').val());
                $('#shipping_country').val($('#billing_country').val());
                $('#shipping_pincode').val($('#billing_pincode').val());
                $('#shipping_mobile').val($('#billing_mobile').val());
            }else {
                $('#shipping_name').val("");
                $('#shipping_address').val("");
                $('#shipping_city').val("");
                $('#shipping_state').val("");
                $('#shipping_country').val("");
                $('#shipping_pincode').val("");
                $('#shipping_mobile').val("");
            }
        });

    });
})(jQuery);