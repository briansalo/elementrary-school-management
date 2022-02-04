@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		  	<div class="col-12">



<div class="box box-default">
				<div class="box-header with-border">
				  	<form method="GET" action="{{ route('class.student.grade.view') }}">
				  	<div class="row">
						<div class="col-md-4">
							<div class="form-group">
									<h5>Name: <span class="text-danger"> </span></h5>
										<div class="controls">
										   <select name="select_name" id="select_name"  required="" class="form-control" aria-invalid="false">
												<option value="">Select Name</option>
													@foreach($teacher as $teachers)
													<option value="{{ $teachers->employee_id }}"
														{{ ($employee->employee_id == $teachers->employee_id)? 'selected': ''}}>
														{{ $teachers->employee->name }}
													</option>
													@endforeach
										   </select>
										</div>   
							</div>
						</div><!-- col-md-4-->	
						<div class="col-md-4" style="padding-top: 25px;">
								<input type="submit" id="search" name="search" value="search" class="btn btn-rounded btn-primary mb-5">
						</div><!-- end col md 4 -->
					</div>
					</form>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs customtab2" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">1st Grading</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">2nd Grading</span></a> </li>

						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages7" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ion-email"></i></span> <span class="hidden-xs-down">3rd Grading</span></a> </li>

						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages8" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ion-email"></i></span> <span class="hidden-xs-down">4th Grading</span></a> </li>

						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages9" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ion-email"></i></span> <span class="hidden-xs-down">Final Grade</span></a> </li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="home7" role="tabpanel">
							<div class="p-15">

									<!-- ///////////////1st grading table //////////////////-->
									<form method="post" action="{{ route('class.student.grading.store')}}">
										@csrf

														 <table id="1stgrading" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>ID NO.</th>
																		<th>Name</th>
																		<th>Grade</th>
																		<th>Class</th>
																		@foreach($subjects as $subject)
																		<th width="15%">{{$subject->school_subject->name}}</th>
																		@endforeach
																	</tr>
																</thead>
																<tbody>
																@foreach($students as $key => $data)
																	<tr>
																		<input type="hidden" name="student[]" value="{{$data->student_id}}">
																		<input type="hidden" name="employee" value="{{$employee->employee_id}}">
																		<td>{{$data->student->id_no}}</td>
																		<td>{{$data->student->name}}</td>
																		<td>{{$data->student_grade->name}}</td>
																		<td>{{$data->student_class->name}}</td>

																		@foreach($subjects as $number => $subject)
																		<input type="hidden" name="subject{{$key}}[]" value="{{$subject->school_subject->name}}">
																			@if(empty($first[$key][$number]))
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]"></td>				
																			@else
																			<td><input type="text"class="form-control form-control-sm" name="grade{{$key}}[]" value="{{$first[$key][$number]->grade}}"></td>
																			@endif
																		@endforeach

																	</tr>	
																@endforeach
																</tbody>
													  </table>
													  <input type="submit" class="btn btn-rounded btn-info" value="Save 1stGrading" name="1st_grading">
										</form>  
									
							</div>
						</div>



						<div class="tab-pane" id="profile7" role="tabpanel">
							<div class="p-15">
									<!-- ///////////////2nd grading table //////////////////-->
									<form method="post" action="{{ route('class.student.grading.store')}}">
										@csrf

														 <table id="2ndgrading" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>ID NO.</th>
																		<th>Name</th>
																		<th>Grade</th>
																		<th>Class</th>
																		@foreach($subjects as $subject)
																		<th width="15%">{{$subject->school_subject->name}}</th>
																		@endforeach
																	</tr>
																</thead>
																<tbody>
																@foreach($students as $key => $data)
																	<tr>
																		<input type="hidden" name="student[]" value="{{$data->student_id}}">
																		<td>{{$data->student->id_no}}</td>
																		<td>{{$data->student->name}}</td>
																		<td>{{$data->student_grade->name}}</td>
																		<td>{{$data->student_class->name}}</td>

																		@foreach($subjects as $number => $subject)
																		<input type="hidden" name="subject{{$key}}[]" value="{{$subject->school_subject->name}}">
																			@if(empty($second[$key][$number]))
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]"></td>
																			@else
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]" value="{{$second[$key][$number]->grade}}"></td>																			
																			@endif
																		@endforeach

																	</tr>	
																	@endforeach															
																</tbody>
													  </table>

									<input type="submit" class="btn btn-rounded btn-info" value="Save 2ndGrading" name="2nd_grading">

								</form>	
							</div>
						</div>


						<div class="tab-pane" id="messages7" role="tabpanel">
							<div class="p-15">

									<!-- ///////////////3rd grading table //////////////////-->
									<form method="post" action="{{ route('class.student.grading.store')}}">
										@csrf

														 <table id="3rdgrading" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>ID NO.</th>
																		<th>Name</th>
																		<th>Grade</th>
																		<th>Class</th>
																		@foreach($subjects as $subject)
																		<th width="15%">{{$subject->school_subject->name}}</th>
																		@endforeach
																	</tr>
																</thead>
																<tbody>
																@foreach($students as $key => $data)
																	<tr>
																		<input type="hidden" name="student[]" value="{{$data->student_id}}">
																		<td>{{$data->student->id_no}}</td>
																		<td>{{$data->student->name}}</td>
																		<td>{{$data->student_grade->name}}</td>
																		<td>{{$data->student_class->name}}</td>

																		@foreach($subjects as $number => $subject)
																		<input type="hidden" name="subject{{$key}}[]" value="{{$subject->school_subject->name}}">
																			@if(empty($third[$key][$number]))
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]"></td>
																			@else
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]" value="{{$third[$key][$number]->grade}}"></td>																			
																			@endif
																		@endforeach

																	</tr>	
																	@endforeach
																</tbody>
													  </table>

									<input type="submit" class="btn btn-rounded btn-info" value="Save 3rdGrading" name="3rd_grading">

								</form>	
							</div>
						</div>




						<div class="tab-pane" id="messages8" role="tabpanel">
							<div class="p-15">


									<!-- ///////////////4th grading table //////////////////-->
									<form method="post" action="{{ route('class.student.grading.store')}}">
										@csrf

														 <table id="4thgrading" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>ID NO.</th>
																		<th>Name</th>
																		<th>Grade</th>
																		<th>Class</th>
																		@foreach($subjects as $subject)
																		<th width="15%">{{$subject->school_subject->name}}</th>
																		@endforeach
																	</tr>
																</thead>
																<tbody>
																@foreach($students as $key => $data)
																	<tr>
																		<input type="hidden" name="student[]" value="{{$data->student_id}}">
																		<td>{{$data->student->id_no}}</td>
																		<td>{{$data->student->name}}</td>
																		<td>{{$data->student_grade->name}}</td>
																		<td>{{$data->student_class->name}}</td>

																		@foreach($subjects as $number => $subject)
																		<input type="hidden" name="subject{{$key}}[]" value="{{$subject->school_subject->name}}">
																			@if(empty($fourth[$key][$number]))
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]"></td>
																			@else
																				<td><input type="text" class="form-control form-control-sm" name="grade{{$key}}[]" value="{{$fourth[$key][$number]->grade}}"></td>																			
																			@endif
																		@endforeach

																	</tr>	
																	@endforeach
																</tbody>
													  </table>

									<input type="submit" class="btn btn-rounded btn-info" value="Save 4thGrading" name="4th_grading">

								</form>	
							</div>
						</div>


						<div class="tab-pane" id="messages9" role="tabpanel">
							<div class="p-15">


									<!-- ///////////////Final Grade table //////////////////-->

														 <table id="finalgrade" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>ID NO.</th>
																		<th>Name123</th>
																		<th>Grade</th>
																		<th>Class</th>
																		@foreach($subjects as $subject)
																		<th width="15%">{{$subject->school_subject->name}}</th>
																		@endforeach
																		<th>General Average</th>
																	</tr>
																</thead>
																<tbody>
																@foreach($students as $key => $data)
																	<tr>
																		<td>{{$data->student->id_no}}</td>
																		<td>{{$data->student->name}}</td>
																		<td>{{$data->student_grade->name}}</td>
																		<td>{{$data->student_class->name}}</td>

															@foreach($subjects as $second_key=> $subject)
																		<td>
																	@if(!empty($final_grade[$key][$second_key]))
																			{{$final_grade[$key][$second_key]}}
																			@if($final_grade[$key][$second_key] >= 90 AND $final_grade[$key][$second_key] <= 100)
																			  (A+)
																			@elseif($final_grade[$key][$second_key] >= 80 AND $final_grade[$key][$second_key] <= 89)
																				(B+)
																			@elseif($final_grade[$key][$second_key] >= 75 AND $final_grade[$key][$second_key] <= 79)
																			  (C+)
																			@else
																			  (D)
																			@endif
											          	@endif		
																		</td>
															 @endforeach

																		<td>
																	@if(!empty($general_average[$key]))		
																			{{number_format($general_average[$key])}}
																			@if(number_format($general_average[$key]) >= 75)
																				(Passed)
																			@else
																			  (Failed)
																			@endif
																	@endif		
																		</td>
																	</tr>	
																@endforeach
																</tbody>
													  </table>
						<button onclick="printDiv('messages9')" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
							</div>
						</div>




							</div><!--tab content -->
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>




			</div><!-- /.col -->			
		  </div><!-- /.row -->
		  
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


<script type="text/javascript">
	
		$('#select_name').select2();


		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}


</script>


@endsection

