<!-- Start Core Plugins
         =====================================================================-->
<!-- jQuery -->

<!-- jquery-ui -->
<script src="{{ asset('admin/assets/')}}/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript">
</script>
<!-- Bootstrap -->
<script src="{{ asset('admin/assets/')}}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel -->
<script src="{{ asset('admin/assets/')}}/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- Pace js -->
<script src="{{ asset('admin/assets/')}}/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/assets/')}}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">
</script>
<!-- FastClick -->
<script src="{{ asset('admin/assets/')}}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- CRMadmin frame -->
<script src="{{ asset('admin/assets/')}}/dist/js/custom.js" type="text/javascript"></script>
<!-- End Core Plugins
         =====================================================================-->
<!-- Start Page Lavel Plugins
         =====================================================================-->
<!-- ChartJs JavaScript -->
<script src="{{ asset('admin/assets/')}}/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
<!-- Counter js -->
<script src="{{ asset('admin/assets/')}}/plugins/counterup/waypoints.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets/')}}/plugins/counterup/jquery.counterup.min.js" type="text/javascript">
</script>
<!-- Bootstrap toggle -->
<script src="{{ asset('admin/assets/')}}/plugins/bootstrap-toggle/bootstrap-toggle.min.js" type="text/javascript">
</script>
<!-- Monthly js -->
<script src="{{ asset('admin/assets/')}}/plugins/monthly/monthly.js" type="text/javascript"></script>
<!-- End Page Lavel Plugins
         =====================================================================-->
<!-- Start Theme label Script
         =====================================================================-->
<!-- Dashboard js -->
<script src="{{ asset('admin/assets/')}}/dist/js/dashboard.js" type="text/javascript"></script>
<!-- End Theme label Script
    =====================================================================-->
<!-- Datatable Js-->
<script src="{{ asset('admin/assets/')}}/dist/js/datatables.min.js" type="text/javascript"></script>
<!-- Toaster Js-->
<script src="{{ asset('admin/assets/')}}/dist/js/toastr.min.js" type="text/javascript"></script>
<!-- Sweetalert js -->
<script src="{{ asset('admin/assets/')}}/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<!-- JQuery validation -->
<script src="{{ asset('admin/assets/')}}/dist/js/jquery.validate.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets/')}}/dist/js/additional-methods.js" type="text/javascript"></script>
<!-- Custom Js-->
<script src="{{ asset('admin/assets/')}}/dist/js/custom/custom.js" type="text/javascript"></script>

<script>
    $( function() {
      $( "#datepicker" ).datepicker({
          minDate: 0,
          dateFormat: 'yy-mm-dd'
      });
    } );
</script>

@if(session()->has('success'))
<script type="text/javascript">
    $(function(){
			$.notify("{{session()->get('success')}}", {globalPosition: 'top right', className:'success'});
        });
</script>
@endif
@if(session()->has('error'))
<script type="text/javascript">
    $(function(){
			$.notify("{{session()->get('error')}}", {globalPosition: 'top right', className:'error'});
        });
</script>
@endif


<!-- Add Remove Input Fields Dynamically using jQuery -->
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div style="display: flex;"><input type="text" name="sku[]" id="sku" class="form-control" placeholder="SKU"'+
                                            'style="width: 120px; margin-right: 5px; margin-top: 5px;"><input type="text" name="size[]" id="size" class="form-control"'+
                                            'placeholder="SIZE" style="width: 120px; margin-right: 5px; margin-top: 5px;"><input type="text" name="price[]" id="price" class="form-control"'+
                                            'placeholder="PRICE" style="width: 120px; margin-right: 5px; margin-top: 5px;"><input type="text" name="stock[]" id="stock" class="form-control"'+
                                            'placeholder="STOCK" style="width: 120px; margin-right: 5px; margin-top: 5px;"><a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger btn-circle" style="margin-top: 5px;"><i class="fa fa-minus-circle"></i></a></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            let act = confirm('Are your sure?');
            if(act){
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            }
        });
    });
</script>


<script>
    function dash() {
         // single bar chart
         var ctx = document.getElementById("singelBarChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
         datasets: [
         {
         label: "My First dataset",
         data: [40, 55, 75, 81, 56, 55, 40],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
               //monthly calender
               $('#m_calendar').monthly({
                 mode: 'event',
                 //jsonUrl: 'events.json',
                 //dataType: 'json'
                 xmlUrl: 'events.xml'
             });

         //bar chart
         var ctx = document.getElementById("barChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
         datasets: [
         {
         label: "My First dataset",
         data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         },
         {
         label: "My Second dataset",
         data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
         borderColor: "rgba(51, 51, 51, 0.55)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(51, 51, 51, 0.55)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
             //counter
             $('.count-number').counterUp({
                 delay: 10,
                 time: 5000
             });
         }
         dash();
</script>