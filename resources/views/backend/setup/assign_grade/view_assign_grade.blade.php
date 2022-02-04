@extends('admin.admin_master')
@section('admin')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Assign Grade</h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Fee Category</th>
								<th width="25%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $assign)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $assign['name'] }}</td>  <!-- this method came from fee categoryamount models -->
								<td>
									<a href="{{route('assign.grade.details', $assign->id)}}" class="btn btn-primary">Details</a>
								</td>

							</tr>
							@endforeach

						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


@endsection