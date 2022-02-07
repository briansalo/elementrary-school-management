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
				  <h3 class="box-title">Employee Salary</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">

						
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Name</th>
								<th >ID NO.</th>
								<th> Designation</th>
								<th>Gender</th>
								<th >Salary</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $employee)
							<tr>
									<td>{{ $key+1 }}</td> 
									<td>{{ $employee->name }}</td>
									<td>{{ $employee->id_no }}</td>
									<td>{{ $employee->designation->name }}</td>
									<td>{{ $employee->gender }}</td>
									<td>{{ number_format($employee->salary,2) }}</td>

									<td>
										@if($employee->salary_increase_status == '1')
											<a title="cancel increment" href="{{ route('employee.salary.cancel.increment', $employee->id)}}"
											 class="btn btn-danger"><i class="fa fa-ban"></i>
											</a>
										@else
											<a title="increment" href="{{ route('employee.salary.increment', $employee->id)}}"
											 class="btn btn-success"><i class="fa fa-plus-circle"></i>
											</a>
									@endif
											<a title="Details" href="{{ route('employee.salary.details', $employee->id)}}"
											 class="btn btn-primary"><i class="fa fa-eye"></i>
											</a>
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