(function($){
    $(document).ready(function(){

        //datatable
        $('table#datatable').DataTable();

        //user status update
        $('.user_status_update').change(function (event) { 
            let id = $(this).attr('data-id');
            
            //Input checkbox checked or uncheck under jquery prop() function
            if($(this).prop('checked') == true){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: '/admin/users/status-update',
                    data: {id: id, status: 1},
                    success: function(data) {
                        $.notify("User Status Active!", {globalPosition: 'top right', className: 'success'});
                    },
                    error: function(){
                        $.notify("Something is wrong! plase try again");
                    }
                });
            }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: '/admin/users/status-update',
                    data: {id: id, status: 0},
                    success: function(data) {
                        $.notify("User Status Inactive!", {globalPosition: 'top right', className: 'danger'});
                    },
                    error: function(){
                        $.notify("Something is wrong! plase try again");
                    }
                });
            }
         });

         //data delete
         $(document).on('click', '#delete', function(event){
             event.preventDefault();
             let form = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false},
                function (isConfirm) {
                    if (isConfirm) {
                        form.submit();
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
         });

         //user profile load
         $(document).on('change', '#user_photo', function(event){
             let image_url = URL.createObjectURL(event.target.files[0]);
             $('#user_photo_load').attr('src', image_url);
         });

         //category status update
         $('.category_status_update').change(function(){
             let id = $(this).attr('data-id');
             
             //input checkbox checked or unchecked under jQuery prop() function 
             if($(this).prop("checked") == true){
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                     },
                     type: "POST",
                     url: "/categories/status-update",
                     data: {id: id, status: 1},
                     success: function(data){
                         $.notify("Category Active", {globalPosition: 'top right', className: 'success'});
                     },
                     error: function() {
                         $.notify("Something is wrong", {globalPosition: 'top right', className: 'info'});
                     }
                 });
             }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: "/categories/status-update",
                    data: {id: id, status: 0},
                    success: function(data){
                        $.notify("Category Inactive", {globalPosition: 'top right', className: 'danger'});
                    },
                    error: function() {
                        $.notify("Something is wrong", {globalPosition: 'top right', className: 'info'});
                    }
                });
             }
         });

         // product image load
         $(document).on('change', '#product_image', function(event){
             let product_image = URL.createObjectURL(event.target.files[0]);
             $('#product_image_load').attr('src', product_image);
         });

         // product status update
         $('.product_status_update').change(function(){
             let id = $(this).attr('data-id');
             
             //input checkbox checked or unchecked under jquery prop() function
             if($(this).prop('checked') == true){
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                     },
                     type: "POST",
                     url: '/products/status-update',
                     data: {id: id, status: 1},
                     success: function(data){
                         $.notify("Product Active", {globalPosition: 'top right', className: 'success'});
                     },
                     error: function(data){
                         $.notify("Sorry! something is wrong.", {globalPosition: 'top right', className: 'danger'});
                     }
                 });
             }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: '/products/status-update',
                    data: {id: id, status: 0},
                    success: function(data){
                        $.notify("Product Inactive", {globalPosition: 'top right', className: 'warning'});
                    },
                    error: function(data){
                        $.notify("Sorry! something is wrong.", {globalPosition: 'top right', className: 'danger'});
                    }
                });
             }
         });

         // Featured product status update
         $('.featured_product_update').change(function(event){
             let id = $(this).attr('data-id');
             
             // Input checkbox checked or unchecked under jQuery prop() function
             if($(this).prop("checked") == true){
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                     },
                     type: "POST",
                     url: "/products/featured-product/status-update",
                     data: {id: id, status: 1},
                     success: function(data){
                         $.notify("Featured product added successfully ): ", {globalPosition: 'top right', className: 'success'});
                     },
                     error: function(data){
                         $.notify("Sorry! something is wrong", {globalPosition: 'top right', className: 'danger'});
                     }
                 });
             }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: "/products/featured-product/status-update",
                    data: {id: id, status: 0},
                    success: function(data){
                        $.notify("Featured product remvoe from frontend!", {globalPosition: 'top right', className: 'warning'});
                    },
                    error: function(data){
                        $.notify("Sorry! something is wrong", {globalPosition: 'top right', className: 'danger'});
                    }
                });
             }
         });

         // Banner image upload
         $(document).on('change', '#banner_image', function(event){
             let image_url = URL.createObjectURL(event.target.files[0]);
             $('#banner_image_load').attr('src', image_url);
         });

         // Banner status update
         $('.banner_status_update').change(function(){
             let id = $(this).attr('data-id');
            
             // Input checkbox checked or unchecked undec jQueey prop() function
             if($(this).prop("checked") == true){
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                     },
                     type: "POST",
                     url: "/banners/status-update",
                     data: {id: id, status: 1},
                     success: function(data){
                         $.notify("Banner Active", {globalPosition: 'top right', className: 'success'});
                     },
                     error: function(data){
                        $.notify("Sorry! something is wrong", {globalPosition: 'top right', className: 'danger'});
                     }
                 });
             }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    type: "POST",
                    url: "/banners/status-update",
                    data: {id: id, status: 0},
                    success: function(data){
                        $.notify("Banner Inactive", {globalPosition: 'top right', className: 'error'});
                    },
                    error: function(data){
                       $.notify("Sorry! something is wrong", {globalPosition: 'top right', className: 'danger'});
                    }
                });
             }
         });

         // Product attribute images upload
         $(document).on('change', '#product_attr_image', function(event){

            for(let i=0; i<event.target.files.length; i++){
                let images_url = URL.createObjectURL(event.target.files[i]);
                $('#attr_image').append('<img id="product_attr_image_load" src="'+images_url+'" alt=""'+
                'style="width: 60px; height: 60px; margin-top: 5px; margin-left: 20px;">');
            }
             
         });

    });
})(jQuery);