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
				  <h3 class="box-title">Student Fee List</h3>
				  <a href="{{ route('account.student.fee.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5"> Add Attendance</a>
				</div>

				<div class="box-body">
						
				 <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>ID NO.</th>
								<th>Name</th>
								<th>Year</th>
								<th>Grade</th>
								<th>Class</th>
								<th>Fee Type</th>
								<th>Amount</th>
								<th>Date</th>

							</tr>
						</thead>
						<tbody>
						@foreach($alldata as $key => $data)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$data->student->id_no}}</td>
								<td>{{$data->student->name}}</td>
								<td>{{$data->student_year->name}}</td>
								<td>{{$data->student_grade->name}}</td>
								<td>{{$data->student_class->name}}</td>
								<td>{{$data->student_fee->name}}</td>
								<td>{{$data->amount}}</td>
								<td>{{ date('M-Y', strtotime($data->date)) }}</td>


							</tr>
						@endforeach					

						</tbody>

			  </table>
					  



			  </div><!-- /.box body -->
			  

			</div><!-- /.box -->



			</div>
			<!-- /.col -->

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>






@endsection