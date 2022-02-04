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
				  <h3 class="box-title">Employee List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">

						
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>ID NO.</th>
								<th>Name</th>
								<!--<th>Image</th>-->
								<th>Designation</th>
								<th>Grade</th>
								<th>Class</th>
								<th>Joined Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $employee)
							<tr>
								
									<td>{{ $key+1 }}</td> 
									<td>{{ $employee->employee->id_no }}</td>
									<td>{{ $employee->employee->name }}</td>
									<!--
									<td>
									  <img id="showimage" src="{{ (!empty($employee->employee->image))? url('upload/employee_images/'.$employee->employee->image): url('upload/no_image.jpg')}}" alt="User Avatar" style="width:80px; width: 80px;">
									</td>
									-->									
									</td>
									<td>{{ $employee->employee_designation->name }}</td>
									<td>{{ $employee->employee_grade->name}}</td>
									<td>{{ $employee->employee_class->name}}</td>
									<td>{{ date('m-d-Y', strtotime($employee->created_at))  }}</td>
									<td>
									<a title="Edit" href="{{ route('employee.registration.edit', $employee->employee->id)}}"
									 class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
									<a title="Details" target="_blank" href="{{ route('employee.registration.pdf', $employee->employee->id)}}" 
										class="btn btn-primary"><i class="fa fa-eye"></i></a>
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