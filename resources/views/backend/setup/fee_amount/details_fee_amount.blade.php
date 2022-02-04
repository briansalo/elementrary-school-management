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
				  <h3 class="box-title">{{$detailsdata[0]['student_fee']['name']}}</h3>
				  <a href="{{route('fee.amount.edit', $detailsdata[0]->student_fee_id)}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Edit Fee </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table  class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Class Name</th>
								<th width="25%">Amount</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detailsdata as $key => $detail)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $detail['student_class']['name'] }}</td>  <!-- this method came from fee categoryamount models -->
								<td>{{ $detail->amount}}</td>
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