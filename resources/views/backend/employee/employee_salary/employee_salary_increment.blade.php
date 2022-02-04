@extends('admin.admin_master')
@section('admin')

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Employee Salary Increment</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('employee.salary.update.increment', $alldata->id)}}">
						@csrf

					 <div class="row">

									<div class="col-md-6">
											<div class="form-group">
												<h5>Increase Amount <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="increment_salary"  class="form-control">
														@error('name')
															<span class="text-danger">{{$message}}</span>
														@enderror
													</div>
											</div>
									</div><!-- end col md 6 -->

									<div class="col-md-6">
											<div class="form-group">
												<h5>Effective Date <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="date" name="effective_salary"  class="form-control">
														@error('name')
															<span class="text-danger">{{$message}}</span>
														@enderror
													</div>
											</div>
									</div><!-- end col md 6 -->

					 </div><!-- /.row -->

						<div class="text-xs-right">
								<input type="submit" class="btn btn-rounded btn-info" value="submit">
						</div>

					</form>

			
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