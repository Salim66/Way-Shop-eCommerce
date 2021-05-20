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
                    // $.notify("Something is wrong", {globalPosition: 'top right', className: 'error'});
                    alert('Error');
                }
            });
        });


    });
})(jQuery);