@extends('admin.admin_master')
@section('admin')

<style>
	h4{
	 text-transform: lowercase;
	  }
   h4:first-letter{
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
				  <h3 class="box-title">Please select student for <u>{{ucwords($employee->employee->name)}}</u></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
			  
					 <!-- enctype for inserting image in database to make it file type -->
					<form method="post" action="{{ route('class.assign.store')}}" enctype="multipart/form-data">
						@csrf
									<!--we need to pass this data to ClassAssignStore Controller -->
						<input type="hidden" name="employee_id" value="{{$employee->employee_id}}">
						<input type="hidden" name="grade_id" value="{{$employee->grade_id}}">
						<input type="hidden" name="class_id" value="{{$employee->class_id}}">	

		  		<div class="row">
		  	   @foreach($alldata as $key => $student)
		  			<div class="col-md-3">

        			<div class="media mb-20" style="background-color: #1a233a;">
        					<!--
						 			<a href="#" class="avatar avatar-lg ">
						 				
									<img id="showimage" src="{{ (!empty($student['student']['image']))? url('upload/student_images/'.$student['student']['image']): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:80px; width: 80px;">
								  </a>
										-->

									  <div class="media-body">
											<h4 style="color:white;"><strong>{{ ucwords($student->student->name) }}</strong></h4>
											<p style="color:white;">{{ $student->student_grade->name }} {{ $student->student_class->name }}</p>
									  </div>
									  <label class="switch switch-success">
												<input type="checkbox" name="check_student[]" value="{{ $student->student->id }}">
												<span class="switch-indicator"></span>
									  </label>
							</div><!--END MEDIA BG-WHITE -->
						</div><!-- end col 3-->

					  @endforeach	
						</div><!--end row -->

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Add Student">
						</div>

					</form><!--end form -->
					
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