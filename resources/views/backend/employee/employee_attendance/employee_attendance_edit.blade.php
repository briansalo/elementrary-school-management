@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update Employee Attendance</h4>
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
														<input type="date" name="disable" disabled value="{{ $editdata['0']['date'] }}" class="form-control">
														<input type="hidden" name="date" value="{{ $editdata['0']['date'] }}" class="form-control">
													</div>
											</div>
									</div><!-- end col md 6 -->

					 </div><!-- /.row -->

					 <div class="row">
					 	<div class="col-12">
						
					  <table id="example1" class="table table-bordered table-striped">

								<thead>
									<tr>
									   	<th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
									   	<th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
									   	<th colspan="4" class="text-center" style="vertical-align: middle; width: 30%">Attendance Status</th>		   
									</tr>

				  		 		<tr>
					   					<th>Present</th>
					   					<th >Absent</th>
					   					<th>Late</th>
					   					<th >O.T.</th>
		 		   			</tr>  
								</thead>

				<tbody>

				@foreach($editdata as $key => $data)
				<tr>
						<input type="hidden" name="employee_id[]" id="employee_id" value="{{$data->user->id}}">
							<td>{{ $key+1 }}</td>
							<td>{{$data->user->name}}</td>

							<td>
									<!-- this div will place the radio button to horizantal line  -->
								<div class="switch-toggle switch-3 switch-candy">

										<!-- make sure you put id and label. the id of radio should same on the label to avoid bug in radio button  -->

										<!-- as you can see the present and absent radio have same name. it will help this to identify each employee radio and it make sense to have same name in radio because user can only choose one either the employee is absent or present-->
									<input name="attendance_status{{$key}}" type="radio" id="present{{$key}}" 
									value="present" {{ ($data->attendance_status == 'present')? 'checked': ''}} 
									 class="with-gap radio-col-primary" checked="checked">
									<label for="present{{$key}}">Present</label>	

							</div>
						</td>	

						<td>
									<!-- this div will place the radio button to horizantal line  -->
								<div class="switch-toggle switch-3 switch-candy">
										<!-- as you can see the present and absent radio have same name. it will help this to get identify each employee radio and it make sense to have same name in radio because user can only choose one either the employee is absent or present-->
										<input name="attendance_status{{$key}}" type="radio" id="absent{{$key}}" 
										value="absent" {{ ($data->attendance_status == 'absent')? 'checked': ''}}   class="with-gap radio-col-danger">
										<label for="absent{{$key}}">Absent</label>
					    	 </div>
						</td>

						<td> 
								<div class="row"  id="late-generate{{$key}}">
										<input type="number" id="late" name="late{{$key}}" id="late{{$key}}" 
										value="{{$data->late}}" min="0.00" max="5" step="any" style="width:55px">
								</div>
						</td>

						<td>
								<div class="row  " id="overtime-generate{{$key}}">
										<input type="number" id="overtime" name="overtime{{$key}}" id="overtime{{$key}}"
										 value="{{$data->overtime}}" min="0" max="5" step="1">
								</div>
						</td>

				</tr>
				@endforeach

				</tbody>

			 </table>

					  
			</div><!-- end col 12 -->
	 </div><!-- /.row -->


					  <div class="row">
								<div class="text-xs-right">
									<input type="submit" class="btn btn-rounded btn-info" value="Update">
								</div>
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


<script type="text/javascript">


////////////////////////////////// this script is to hide the late field and overtime field if the value of  radio button is  absent

	// get all the i.d.     this map function is to retrieve the value of array in the employee_id.
var values = $("input[id='employee_id']")
              .map(function(){return $(this).val();}).get();

              // for loop and count how many ID. this for loop can help to identify which radio button in every user
	for (let i = 0; i < values.length; i++) {

					// get the value that checked in radio on specific user
  			var status = $("input[name='attendance_status" +i+"']:checked").val();

					// if the value that checked is absent then hide the late field and overtime field
			   if(status=="absent")
			   {
			       $('#late-generate'+i).addClass('d-none');
			       $('#overtime-generate'+i).addClass('d-none');
			   }

 }//end for loop
 


//////////////////////////////////this script is to hide and show the field of late and overtime.  if the checked radio is absent then hide the field and if you change the radio button to present then show the input field 

//get all the i.d.
var values = $("input[id='employee_id']")
              .map(function(){return $(this).val();}).get();

	//for loop and count how many ID. this for loop can help to identify which radio button in every user              
	for (let i = 0; i < values.length; i++) {

		  // if the radio button is changed and by the help of for loop we can identify who is the user that been changed
		 $("input[name='attendance_status" +i+"']").change(function(){
						var value = $( this ).val();  // get the value that been changed

						   if(value=="absent")
						   {   
						    	 //hide the late field and overtime field
						       $('#late-generate'+i).addClass('d-none');
						       $('#overtime-generate'+i).addClass('d-none');
						   }else{
						   	//create new value of late field and ovetime field
						   	   $("input[name='late" +i+"']").val("0.00");
						    	 $("input[name='overtime" +i+"']").val("0");
						    	 //show the late field and overtime field
						       $('#late-generate'+i).removeClass('d-none');
						       $('#overtime-generate'+i).removeClass('d-none');    
						   }

			 }); // end change function

	 }//end for loop

</script>

@endsection