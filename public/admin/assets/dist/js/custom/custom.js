(function($){
    $(document).ready(function(){

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


    });
})(jQuery);