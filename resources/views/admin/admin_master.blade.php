<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin_template/images/favicon.ico')}}">

    <title>Elementary School</title>
    
	<!-- Vendors Style--> <!--{{ asset('')}} = asset means public folder because all this link belong in public folderadmin_template/ -->
	<link rel="stylesheet" href="{{ asset('admin_template/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('admin_template/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('admin_template/css/skin_color.css')}}">

  <!-- css for toastr or notification messages. no need to change the href unlike others -->
	 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

@include('admin.body.header')
  
  <!-- Left side column. contains the logo and sidebar -->
@include('admin.body.sidebar')

  <!-- Content Wrapper. Contains page content -->
@yield('admin')

  <!-- /.content-wrapper -->
@include('admin.body.footer')

  <!-- Control Sidebar -->

  
  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->  
	<script src="{{asset('admin_template/js/vendors.min.js')}}"></script>

  <script src="{{asset('../assets/icons/feather-icons/feather.min.js')}}"></script>

	<script src="{{asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>

	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
	
  <script src="{{asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
	
	<!-- for tables -->
  <script src="{{asset('admin_template/../assets/vendor_components/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('admin_template/js/pages/data-table.js')}}"></script>


	<!-- Sunny Admin App -->
	<script src="{{asset('admin_template/js/template.js')}}"></script>
	<script src="{{asset('admin_template/js/pages/dashboard.js')}}"></script>



<!-- Sweet alert no need to change the sources -->
<!-- it will function if theres a button or clickable that have id delete -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			$(function(){
				$(document).on('click','#delete', function(e){ //the #delete is the id from delete button in view_user.blade.php
					e.preventDefault();
					var link = $(this).attr("href");

						Swal.fire({
						  title: 'Are you sure?',
						  text: "Delete this data?",
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Yes, delete it!'
						}).then((result) => {
						  if (result.isConfirmed) {
						  	window.location.href = link
						    Swal.fire(
						      'Deleted!',
						      'Your file has been deleted.',
						      'success'
						    )
						  }
						})


					})
			});
		</script>
	

<!-- for toastr or notification messages. no need to change the sources  -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

	

</body>
</html>
