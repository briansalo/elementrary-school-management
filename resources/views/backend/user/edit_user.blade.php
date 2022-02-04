@extends('admin.admin_master')
@section('admin')

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update User</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('user.update',$editData->id) }}">
						@csrf

					 <div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<h5>User Role <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="role"  required="" class="form-control" aria-invalid="false">
										<option value="">Select Your Role</option> 
										<option value="Admin" {{ $editData->role == "Admin" ? "selected" : ""}}>Admin</option>
										<option value="User" {{ $editData->role == "Operator" ? "selected": ""}}>Operator</option>
									</select>
								<div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->

						<div class="col-md-6">
							<div class="form-group">
								<h5>User Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="user_name" class="form-control" value="{{ $editData->name}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
						</div><!-- end col md 6 -->
						
							<div class="col-md-6">	
							<div class="form-group">
								<h5>Email Field <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" value="{{ $editData->email}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
							</div><!-- end col md 6 -->

							<div class="col-md-6">
							</div>

							
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

@endsection