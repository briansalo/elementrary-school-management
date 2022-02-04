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
					<h3>{{$employee->employee->name}}</h3>
					<p>ID#: {{$employee->employee->id_no}}</p>
				</div>
				<!-- /.box-header -->
				<div class="box-body">		

		  		<div class="row">
		  		@foreach($alldata as $key => $student)
		  		<div class="col-md-4">
						<div class="media align-items-center bg-white mb-20">
										<!--
								 			<a href="#" class="avatar avatar-lg ">
											<img id="showimage" src="{{ (!empty($student['student']['image']))? url('upload/student_images/'.$student['student']['image']): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:80px; width: 80px;">
										  </a>
										-->
							  <div class="media-body">
										<h3 style="color:black;"><strong>{{$student->student->name}}</strong></h3>
										<p>{{ $student->student_grade->name }} {{ $student->student_class->name }}</p>
							  </div>
							  
							  @if($check_student[$key]->isEmpty())
								  <div>
											<a class="btn btn-block btn-danger btn-sm btn-rounded" href="{{ route('class.assign.list.remove', ['student'=>$student->student_id, 'employee'=>$employee->employee_id]) }}">Remove</a>
								  </div>
							  @endif
					 </div>
					</div>
					@endforeach
				</div><!--end row -->


					</div><!--box body -->
				</div><!--box body -->

			</div>
			<!-- /.col -->

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>






@endsection