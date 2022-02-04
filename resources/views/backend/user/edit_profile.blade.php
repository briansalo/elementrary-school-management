@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Manage Profile</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
								 <!-- enctype for inserting image in database to make it file type -->
					<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
						@csrf

					 <div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<h5>User Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="user_name" class="form-control" value="{{ $editData->name}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->

						<div class="col-md-6">
							<div class="form-group">
								<h5>Address <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="address" class="form-control" value="{{ $editData->address}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->


						<div class="col-md-6">
							<div class="form-group">
								<h5>Gender <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="gender" id="select" required="" class="form-control" aria-invalid="false">
										<option value="">Select Your Gender</option> 
										<option value="Male" {{ $editData->gender == "Male" ? "selected" : ""}}>Male</option>
										<option value="Female" {{ $editData->gender == "Female" ? "selected": ""}}>Female</option>
									</select>
								<div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->


						<div class="col-md-6">
							<div class="form-group">
								<h5>Mobile Number <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mobile_number" class="form-control" value="{{ $editData->mobile_number}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->

							<div class="col-md-6">	
							<div class="form-group">
								<h5>Email <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" value="{{ $editData->email}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
							</div><!-- end col md 6 -->

						<div class="col-md-6">
							<div class="form-group">
								<h5>Profile Image <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="image" id="image" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>

						<div class="form-group">
							<div class="controls">											
									<!-- condition if the user has uploaded image then show it the image, else use the image of no_image -->
								  <img id="showimage" class="rounded-circle" src="{{ (!empty($editData->profile_photo_path))? url('upload/user_images/'.$editData->profile_photo_path): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:100px; width: 100px; border:1px solid #000000;">
							</div>
						</div>
						</div><!-- end col md 6 -->
	

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