@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Employee Attendance</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('employee.attendance.update')}}">
						@csrf

						<div class="row">
						<div class="col-12">

							<div class="row">

										<div class="col-md-6">
												<div class="form-group">
													<h5>Attendance Date <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="date" name="disable" disabled value="{{ $detail['0']['date'] }}" class="form-control">
													</div>
												</div>
										</div><!-- end col md 6 -->

							 </div><!-- /.row -->


					 <div class="row">
					 	<div class="col-12">

						
				  <table class="table table-bordered table-striped">
						<thead>

							<tr>
							   	<th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
							   	<th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
							   	<th colspan="4" class="text-center" style="vertical-align: middle; width: 30%">Attendance Status</th>						   
							</tr>
		  		 		<tr>
		   					<th>Status</th>
		   					<th>Late</th>
		   					<th >O.T.</th>
  		   			</tr>  

						</thead>

						<tbody>

								@foreach($detail as $key => $data)
								<tr>
											<td>{{ $key+1 }}</td>
											<td>{{$data->user->name}}</td>
											<td>{{ ($data->attendance_status == 'absent')? 'x': 'Present'}}</td>	
											<td> {{ ($data->late == '')? " ": $data->late }}</td>
											<td> {{ ($data->overtime == '')? " ": $data->overtime }}</td>
								</tr>

								@endforeach

						</tbody>

				  </table>

					  
  					</div><!-- end col 12 -->
 				 </div><!-- /.row -->

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