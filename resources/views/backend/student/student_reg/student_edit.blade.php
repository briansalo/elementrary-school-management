@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update Student</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					 <!-- enctype for inserting image in database to make it file type -->
					<form method="post" action="{{ route('student.registration.update', $editData->student_id )}}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="assign_student_id" value="{{$editData->id}}">
						<div class="row">
						<div class="col-12">


						<div class="row">

										<div class="col-md-4">
												<div class="form-group">
													<h5>Student Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="name"  class="form-control" value="{{$editData['student']['name']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Email <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="email" name="email"  class="form-control" value="{{$editData['student']['email']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Mother's Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="mothers_name"  class="form-control" value="{{$editData['student']['mothers_name']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

						 </div><!-- /.1st row -->


						 <div class="row">

										<div class="col-md-4">
												<div class="form-group">
													<h5>Father's Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="fathers_name"  class="form-control" value="{{$editData['student']['fathers_name']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Mobile Number <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="mobile_number"  class="form-control" value="{{$editData['student']['mobile_number']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Address<span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="address"  class="form-control" value="{{$editData['student']['address']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

					 </div><!-- /.2nd row -->



					  <div class="row">

										<div class="col-md-4">
													<div class="form-group">
														<h5>Gender <span class="text-danger">*</span></h5>
														<div class="controls">
															<select name="gender"  required="" class="form-control" aria-invalid="false">
																<option value="">Select Gender</option> 
																<option value="Male" {{ ($editData->student->gender == 'Male')? 'selected': ''}} >Male</option>
																<option value="Female" {{ ($editData->student->gender == 'Female')? 'selected': ''}} >Female</option>
															</select>
														<div class="help-block"></div></div>
													</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Religion<span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="religion"  class="form-control" value="{{$editData['student']['religion']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

										<div class="col-md-4">
												<div class="form-group">
													<h5>Date of Birth<span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="date" name="dob"  class="form-control" value="{{$editData['student']['dob']}}">
													</div>
												</div>
										</div><!-- end col md 4 -->

					 </div><!-- /.3rd row -->


					 <div class="row">

										<div class="col-md-4">
												<div class="form-group">
													<h5>Registration Discount<span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="discount"  class="form-control" value="{{$editData['discount']['discount']}}">
													</div>
												</div>
											</div><!-- end col md 4 -->
											<!--
										<div class="col-md-4">
													<div class="form-group">
														<h5>Year <span class="text-danger">*</span></h5>
														<div class="controls">
															<select name="year"  required="" class="form-control" aria-invalid="false">
																<option value="">Select Year</option> 
																@foreach($year as $years)
																<option value="{{$years->id}}"{{ ($editData->year_id == $years->id)? 'selected': ''}} >{{$years->name}}</option>
																@endforeach
															</select>
														<div class="help-block"></div></div>
													</div>
										</div>
										-->

										<div class="col-md-4">
													<div class="form-group">
														<h5>Class <span class="text-danger">*</span></h5>
														<div class="controls">
															<select name="class"  required="" class="form-control" aria-invalid="false">
																<option value="">Select Class</option>
																@foreach($class as $classes)
																<option value="{{$classes->id}}" {{ ($editData->class_id == $classes->id)? 'selected': ''}} >{{$classes->name}}</option>
																@endforeach
															</select>
														<div class="help-block"></div></div>
													</div>
										</div><!-- end col md 4 -->

											<div class="col-md-4">
														<div class="form-group">
															<h5>Grade <span class="text-danger">*</span></h5>
															<div class="controls">
																<select name="grade"  required="" class="form-control" aria-invalid="false">
																	<option value="">Select Grade</option> 
																	@foreach($grades as $grade)
																	<option value="{{$grade->id}}" {{ ($editData->grade_id == $grade->id)? 'selected': ''}}> {{$grade->name}}	
																	</option>
																	@endforeach
																</select>
															<div class="help-block"></div></div>
														</div>
											</div><!-- end col md 4 -->				
											
						 </div><!-- /.4th row -->




						 <div class="row">


											<!--
										<div class="col-md-4">
												<div class="form-group">
													<h5>Profile Image <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="file" name="image" id="image" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div>
													</div>
												</div>										
										</div>

										<div class="col-md-4">
	 											<div class="form-group">
													<div class="controls">
													  <img id="showimage" src="{{ (!empty($editData['student']['image']))? url('upload/student_images/'.$editData['student']['image']): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:100px; width: 100px; border:1px solid #000000;">

		 												</div>
		 										</div>
										</div>
										-->			
						  </div><!-- /.5th row -->

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Update">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
	  </div>
  </div>



  <script type="text/javascript">
		$(document).ready(function(){
			$('#image').change(function(e){
				var reader = new FileReader();
				reader.onload = function(e){
					$('#showimage').attr('src',e.target.result);
				}
				reader.readAsDataURL(e.target.files['0']);
				
			});
		});
</script>

@endsection