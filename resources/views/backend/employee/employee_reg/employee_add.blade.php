	@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Employee</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					 <!-- enctype for inserting image in database to make it file type -->
					<form method="post" action="{{ route('employee.registration.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
						<div class="col-12">


						  <div class="row">

													<div class="col-md-4">
															<div class="form-group">
																<h5>Employee Name <span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="text" name="name"  class="form-control">
																</div>
															</div>
													</div><!-- end col md 4 -->

													<div class="col-md-4">
															<div class="form-group">
																<h5>Email <span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="email" name="email"  class="form-control">
																</div>
															</div>
													</div><!-- end col md 4 -->

													<div class="col-md-4">
															<div class="form-group">
																<h5>Mother's Name <span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="text" name="mothers_name"  class="form-control">
																</div>
															</div>
													</div><!-- end col md 4 -->

								 </div><!-- /.1st row -->


								 <div class="row">

													<div class="col-md-4">
															<div class="form-group">
																<h5>Father's Name <span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="text" name="fathers_name"  class="form-control">
																</div>
															</div>
													</div><!-- end col md 4 -->


													<div class="col-md-4">
															<div class="form-group">
																<h5>Mobile Number <span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="text" name="mobile_number"  class="form-control">
																</div>
															</div>
													</div><!-- end col md 4 -->

													<div class="col-md-4">
															<div class="form-group">
																<h5>Address<span class="text-danger">*</span></h5>
																<div class="controls">
																	<input type="text" name="address"  class="form-control">
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
																				<option value="Male" >Male</option>
																				<option value="Female">Female</option>
																			</select>
																		<div class="help-block"></div></div>
																	</div>
														</div><!-- end col md 4 -->

														<div class="col-md-4">
																<div class="form-group">
																	<h5>Religion<span class="text-danger">*</span></h5>
																	<div class="controls">
																		<input type="text" name="religion"  class="form-control">
																	</div>
																</div>
														</div><!-- end col md 4 -->

														<div class="col-md-4">
																<div class="form-group">
																	<h5>Date of Birth<span class="text-danger">*</span></h5>
																	<div class="controls">
																		<input type="date" name="dob"  class="form-control">
																	</div>
																</div>
														</div><!-- end col md 4 -->

								 </div><!-- /.3rd row -->



						  	 <div class="row">

														<div class="col-md-4">
																<div class="form-group">
																	<h5>Salary<span class="text-danger">*</span></h5>
																	<div class="controls">
																		<input type="number" name="salary"  class="form-control">
																	</div>
																</div>
														</div><!-- end col md 4 -->

																<div class="col-md-4">
																			<div class="form-group">
																				<h5>Designation <span class="text-danger">*</span></h5>
																				<div class="controls">
																					<select name="designation"  required="" class="form-control" aria-invalid="false">
																						<option value="">Select Designation</option> 
																						@foreach($designation as $designations)
																						<option value="{{$designations->id}}" >{{$designations->name}}</option>
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
																						<option value="{{$grade->id}}" >{{$grade->name}}</option>
																						@endforeach
																					</select>
																				<div class="help-block"></div></div>
																			</div>
																</div><!-- end col md 4 -->
							
								   </div><!-- /.4th row -->




							  	 <div class="row">

															<div class="col-md-4">
																		<div class="form-group">
																			<h5>Class <span class="text-danger">*</span></h5>
																			<div class="controls">
																				<select name="class"  required="" class="form-control" aria-invalid="false">
																					<option value="">Select Class</option> 
																					@foreach($classes as $class)
																					<option value="{{$class->id}}" >{{$class->name}}</option>
																					@endforeach
																				</select>
																			<div class="help-block"></div></div>
																		</div>
															</div><!-- end col md 4 -->
															<!--
															<div class="col-md-4">
																	<div class="form-group">
																			<h5>Profile Image <span class="text-danger">*</span></h5>
																			<div class="controls">
																			<input type="file" name="image" id="image" class="form-control" 
																			data-validation-required-message="This field is required"> <div class="help-block"></div>
																		</div>
																	</div>										
															</div>

															<div class="col-md-4">
						 											<div class="form-group">
																		<div class="controls">
																			<img id="showimage" src="{{ url('upload/no_image.jpg') }}" 
																			style="width: 100px; width: 100px; border: 1px solid #000000;"> 
							 											</div>
							 										</div>
															</div>
															-->		

						      	</div><!-- /.5th row -->


										<div class="text-xs-right">
											<input type="submit" class="btn btn-rounded btn-info" value="submit">
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