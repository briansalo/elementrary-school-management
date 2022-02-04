@extends('admin.admin_master')
@section('admin')

@if($value == 1)

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
						<b><h1 class="box-title">{{$null_grade->name}}</h1></b>

		 			<a href="{{route('assign.grade.add', $null_grade->id)}}" style="float: right;" class="btn btn-rounded btn-primary mb-5"> Add Class </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th width="25%">subject</th>
								<th width="15%">full_mark</th>
								<th width="15%">pass_mark</th>
								<th width="15%">subjective_mark</th>
							</tr>
						</thead>
						<tbody>

							<tr>	</tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>

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


@else


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->



		<!-- Main content -->
		<section class="content">

		  <div class="row">
			  

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">

						<b><h1 class="box-title">{{$classes[0]['student_grade']['name']}}</h1></b>
 						<a href="{{route('assign.grade.add', $grade->grade_id)}}" style="float: right;" class="btn btn-rounded btn-primary mb-5"> Add Class </a>	

				</div>
				<!-- /.box-header -->
		@foreach($classes as $key => $class)

				<div class="box-body">

						<b><h3 class="box-title">{{$class['student_class']['name']}}</h3></b>
					  <a href="{{route('assign.grade.subject.edit', ['class'=>$class->class_id, 'grade'=>$class->grade_id] )}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Edit Subject </a>	

					<div class="table-responsive">
					  <table  class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th width="25%">subject</th>
								<th width="15%">full_mark</th>
								<th width="15%">pass_mark</th>
								<th width="15%">subjective_mark</th>
							</tr>
						</thead>
						<tbody>
								@foreach($try[$key] as $newtry)							
							<tr>
								<td>{{ $key+1}}</td>
								<td>{{ $newtry['school_subject']['name']}}</td>
								<td>{{ $newtry->full_mark}}</td>
								<td>{{ $newtry->pass_mark}}</td>
								<td>{{ $newtry->subjective_mark}}</td>
								
							</tr>
							@endforeach

						</tbody>

					  </table>
					</div>

				</div>

	  @endforeach
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

@endif


@endsection