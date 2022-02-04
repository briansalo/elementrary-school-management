@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		  	<div class="col-12">

		  	<div class="box bb-3 border-warning">
				  <div class="box-header">
					<h4 class="box-title">Search <strong>Teacher</strong></h4>
				  </div>

				  <div class="box-body">

				  	<!-- I use get method because i just want to retrieve data in student year and student class -->
				  	<form method="GET" action="{{ route('class.student.grade.view') }}">
				  	<div class="row">
						<div class="col-md-4">
							<div class="form-group">
									<h5>Name: <span class="text-danger"> </span></h5>
										<div class="controls">
										   <select name="select_name" id="select_name"  required="" class="form-control" aria-invalid="false">
												<option value="">Select Name</option>
													@foreach($teacher as $teachers)
													<option value="{{ $teachers->employee_id }}">{{ $teachers->employee->name }}</option>
													@endforeach
										   </select>
										</div>   
							</div>
						</div><!-- col-md-4-->	
						<div class="col-md-4" style="padding-top: 25px;">
								<input type="submit" id="search" name="search" value="search" class="btn btn-rounded btn-primary mb-5">
						</div><!-- end col md 4 -->
					</div>
					</form>
				</div><!-- /.box body -->
		  </div>
		</div><!-- /.class box bb-3 border-warning -->
			  



			</div>
			<!-- /.col -->

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>



<script type="text/javascript">
	
		$('#select_name').select2();

</script>


@endsection