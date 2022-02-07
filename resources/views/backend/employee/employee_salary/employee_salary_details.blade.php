@extends('admin.admin_master')
@section('admin')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		  	<div class="col-12">


			<div class="col-12">
			 <div class="box">
				<div class="box-header with-border">
				  <b><h1 class="box-title">Employee Salary Details</h1></b><br>
				  <h4 class="box-title">Employee Name:</h4>&nbsp{{$data->name}}<br>
				  <h4 class="box-title">Employee ID No.</h4>&nbsp{{$data->id_no}}
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">

						
					  <table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Previous Salary</th>
								<th >Increment Salary</th>
								<th> Present Salary</th>
								<th>Effective Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $data_salary)
							<tr>
								<td>{{ $key+1 }}</td> 
								<td>{{number_format($data_salary->previous_salary,2)}}</td>
								<td>{{number_format($data_salary->increment_salary,2)}}</td>
								<td>{{number_format($data_salary->present_salary,2)}}</td>
								<td>{{date('Y-m-d',strtotime($data_salary->effective_salary))}}</td>
									@if($data_salary->status == 0)
										<td style="background-color:red; color:white;">Cancel</td>
									@elseif($data_salary->status == 1)
										<td style="background-color:blue; color:white;">On Process</td>
									@elseif($data_salary->status == 2)
										<td style="background-color:green; color:white;" >Completed</td>
									@endif
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