@extends('admin.admin_master')
@section('admin')

<style>
	h3{
	 text-transform: lowercase;
	  }
   h3:first-letter{
    text-transform: uppercase;
     }
</style>

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		  	<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Teachers</h3>
				  <a href="{{route('class.assign.student.available')}}" style="float: right;" class="btn btn-rounded btn-primary mb-5">
				  	Available Student <strong>({{count($available_student)}})</strong> </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">

		<div class="row">

		@foreach($alldata as $key => $employee)
		  <div class="col-md-3">
			<div class="box box-inverse bg-img"  data-overlay="1">
					  <div class="flexbox px-20 pt-20">
							<label class="toggler toggler-danger text-white">

							</label>
							<div class="dropdown">
							  <a data-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90 text-white"></i></a>
							  <div class="dropdown-menu dropdown-menu-right">

								<a class="dropdown-item" href="{{ route('class.assign.add', $employee->employee_id)}}"><i class="fa fa-user"></i> Add Student</a>

								<a class="dropdown-item" href="{{ route('class.assign.list', $employee->employee_id)}}"><i class="fa fa-list"></i> List of Student</a>
							  </div>
							</div>
					  </div>

					  <div class="box-body text-center pb-10">
							<!---
								 <img class="avatar avatar-xxl avatar-bordered" src="{{ (!empty($employee['employee']['image']))? url('upload/employee_images/'.$employee['employee']['image']): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:80px; width: 80px;" >
								-->
								<h3 class="mt-2 mb-0"><a class="hover-primary text-white">{{ $employee->employee->name }}</a></h3>
								<span>ID#{{ $employee->employee->id_no }}</span>
					  </div>

					  <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
								<li>
								  <span class="font-size-15">{{$employee->employee_grade->name}}</span>
								</li>
								<li>
								  <span class="font-size-15">{{$employee->employee_class->name}}</span>
								</li>
								<li>	
								  <span class="font-size-15">{{$no_of_student[$key]}} Student</span>
								</li>
					  </ul>

					</div><!-- BOX BOX-INVERSE-->		
				</div><!-- end of col-md3-->

				@endforeach
			</div><!-- row-->

		 </div><!-- box body-->
	  </div><!-- box-->

			</div>
			<!-- /.col -->

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>






@endsection

