@extends('admin.admin_master')
@section('admin')

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Student Fee</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store.student.fee')}}">
						@csrf

					 <div class="row">

							<div class="col-md-6">
							<div class="form-group">
								<h5>Student Fee Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name"  class="form-control">
									@error('name')
										<span class="text-danger">{{$message}}</span>
									@enderror
									 <div class="help-block"></div></div>

							</div>
							</div><!-- end col md 6 -->
					 </div><!-- /.row -->

					  <div class="row">
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