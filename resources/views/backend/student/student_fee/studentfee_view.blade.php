
  
@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



 <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		 

		<!-- Main content -->
		<section class="content">
		  <div class="row">	
			<div class="col-12">

				<div class="box bb-3 border-warning">
				  <div class="box-header">
									<h4 class="box-title" id="payment_name"><strong></strong></h4>
				  </div>

				  <div class="box-body">


													<div class="row">

														<div class="col-md-3">
										  				<div class="form-group">
																<h5>Fee <span class="text-danger"> </span></h5>
																<div class="controls">
										    					<select name="selectfee" id="selectfee"  required="" class="form-control" aria-invalid="false">
																			<option value="" selected="" disabled="">Select Fee</option>
																			 @foreach($fees as $fee)
																	 			<option value="{{ $fee->id }}" >{{ $fee->name }}</option>
																			 	@endforeach
										    					</select>
										    					<div class="help-block"></div></div>
										  					</div>
														</div> <!-- End Col md 3 -->


														<div class="col-md-3">
															 	<div class="form-group">
																	<h5>Year <span class="text-danger"> </span></h5>
																	<div class="controls">
																 			<select name="year" id="year" required="" class="form-control">
																					<option value="" selected="" disabled="">Select Year</option>
																					 @foreach($years as $year)
																	 					<option value="{{ $year->id }}" >{{ $year->name }}</option>
																			 			@endforeach
																		 </select>
																  </div>		 
															  </div>	  
														</div> <!-- End Col md 3 --> 



														<div class="col-md-3">
															 	<div class="form-group">
																	<h5>Class <span class="text-danger"> </span></h5>
																	<div class="controls">
																 			<select name="class_id" id="class_id" required="" class="form-control">
																					<option value="" selected="" disabled="">Select Class</option>
																					 @foreach($classes as $class)
																	 					<option value="{{ $class->id }}" >{{ $class->name }}</option>
																			 			@endforeach
																		 </select>
																  </div>		 
															  </div>	  
														</div> <!-- End Col md 3 -->



										 			<div class="col-md-3" style="padding-top: 25px;">
															<a id="search" class="btn btn-primary" name="search"> Search</a>
											  
										 			</div> <!-- End Col md 3 --> 


											 </div><!--  end row --> 
							


						 	<div class="row d-none" id="month">		

											<div class="col-md-3">

										 		 <div class="form-group">
														<h5>Month <span class="text-danger"> </span></h5>
														<div class="controls">
															 <select name="month_id" id="month_id"  required="" class="form-control">
																	<option value="" selected="" disabled="">Select Month</option>
																	 
																	<option value="January">January</option>
																	<option value="Febuary">Febuary</option>
																	<option value="March">March</option>
																	<option value="June">June</option>
																	<option value="July">July</option>
																	<option value="August">August</option>
																	<option value="September">September</option>
																	<option value="October">October</option>
																	<option value="November">November</option>
																	<option value="December">December</option> 
																	 
																</select>
													  	</div>		 
											  	</div>
											  
											 	</div> <!-- End Col md 3 --> 
									</div><!-- End row D-NONE -->		 	


						 	<div class="row d-none" id="exam">		

											<div class="col-md-3">

										 		 <div class="form-group" id="">
														<h5>Exam Type <span class="text-danger"> </span></h5>
														<div class="controls">
															 <select name="exam_id" id="exam_id"  required="" class="form-control">
																	<option value="" selected="" disabled="">Select Exam</option>
																	 
																	<option value="prelim">Pre Lim</option>
																	<option value="midterm">Midterm</option>
																	<option value="prefinal">Pre Final</option>
																	<option value="final">Final</option>
																</select>
													  	</div>		 
											  	</div>
											  
											 	</div> <!-- End Col md 3 --> 
									</div><!-- End row -->		 	


						 					<!--  ////////////////////////////////////////////  this is the table //////////////////////////////////////////  -->
						 

								<div class="row d-none" id="roll-generate">


									<div class="col-12">

							 		<div class="col-md-4">
											<div class="form-group">
												<br>
												<h5>Search <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="search_name" id="search_name" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
											</div>
							 		</div><!-- end col md 4 -->	
												
															
											  <table class="table table-bordered table-striped" style="width: 100%">
												<thead>
													<tr>
														<th width="10%">ID NO.</th>
														<th width="20%">Name</th>
														<th width="10%">Year</th>
														<th width="10%">Fee Amount</th>
														<th width="10%">Discount</th>
														<th width="10%">Total Amount</th>
														<th width="10%">Action</th>
													</tr>
												</thead>
												<tbody id="roll-generate-tr">

													

												</tbody>

											  </table>

											  <div class="text-center">	
											
											  </div>	


									</div>
									<!-- /.col -->

								</div><!--d-none -->



					          <!-- ///// ///////////////////////////////////////// END table//////////////////////////////////////  -->


					</div><!-- /.BOX BODY -->
				</div><!-- /.BOX HEADER -->		

			       
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


<script type="text/javascript">


  $(document).on('click','#search',function(){


    var year = $('#year').val();
    var class_id = $('#class_id').val();
    var selectfee = $('#selectfee').val();

     var month = $('#month').val();
     var month_id = $('#month_id').val();

     var exam = $('#exam').val();
     var exam_id = $('#exam_id').val();

  	   // condition to make sure all field is not null
  	   if(selectfee== null || class_id == null || year== null){
  	   	window.alert("please fill in all the field");
  	   }
  	 



    //.......................................................if the selected fee is registration.........................................
    	else if(selectfee == "2"){

    		$('#payment_name').text("Registration Fee");

					   	 $.ajax({
	  							url: "{{ route('registration_fee.year.fee.class.search')}}",
	   								method:'GET',
	   								data:{'year':year,'class_id':class_id,'selectfee':selectfee},
	  								 dataType:'json',
	  								 success:function(data){

	  								 $('#roll-generate').removeClass('d-none');
	   							
	    								$('#roll-generate-tr').html(data.table_data);
	  								 }
	  								})// end of ajax


			} // end if for selected fee registration


			//...................................................IF THE SELECTED FEE IS MONTHLY FEE.........................................


				//condition if the user select monthly fee and the month field is null
			else if(selectfee == "4" && month_id == null){
					window.alert("please select month");
			}

				//condition if the user select monthly fee and the month field is not null
			else if(selectfee == "4" && month_id != null){	

				$('#payment_name').text("Monthly Fee");

					   	 $.ajax({
	  							url: "{{ route('monthly_fee.year.fee.class.search')}}",
	   								method:'GET',
	   								data:{'year':year,'class_id':class_id,'selectfee':selectfee,'month_id':month_id},
	  								 dataType:'json',
	  								 success:function(data){

	  								 $('#roll-generate').removeClass('d-none');
	   							
	    								$('#roll-generate-tr').html(data.table_data);
	  								 }
	  								})// end of ajax

			}	 // end if the selected fee is monthly fee


			//...............................................IF THE SELECTED FEE IS Exam FEE...........................................

			else if(selectfee == "3" && exam_id == null){
					window.alert("please select Exam Type");
			}

			else if(selectfee == "3" && exam_id !=null){

					$('#payment_name').text("Exam Fee");

					   	 $.ajax({
	  							url: "{{ route('exam_fee.year.fee.class.search')}}",
	   								method:'GET',
	   								data:{'year':year,'class_id':class_id,'selectfee':selectfee,'exam_id':exam_id},
	  								 dataType:'json',
	  								 success:function(data){

	  								 $('#roll-generate').removeClass('d-none');
	   							
	    								$('#roll-generate-tr').html(data.table_data);
	  								 }
	  								})// end of ajax
			} // end if the selected fee is Exam fee



  }); // end of document on click


</script>




		
<script>
	//javascript for select

$("#selectfee").change(function() {

		// if the selected is monthly fee
  if ($(this).val() == "4") {
			  $('#month').removeClass('d-none');
  } else {
			  $('#month').addClass('d-none');
  }


  		// if the selected is exam fee
    if ($(this).val() == "3") {
			  $('#exam').removeClass('d-none');
  } else {
			  $('#exam').addClass('d-none');
  }
});

$("#selectfee").trigger("change");
</script>







<script type="text/javascript">
				// javascript for live search
				
 $('#search_name').on('keyup', function(){
 	  		query = $(this).val();
 	   	
 	  	   var year = $('#year').val();
    
    var selectfee = $('#selectfee').val();

   	  var class_id = $('#class_id').val();

   	  var month_id = $('#month_id').val();
   	  var exam_id = $('#exam_id').val();
   
   	 $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{'year':year,'class_id':class_id,'selectfee':selectfee,'query':query,'month_id':month_id,'exam_id':exam_id},
   dataType:'json',
   success:function(alldata)
   {
    $('#roll-generate-tr').html(alldata.table_data);
   }
  })

  })
		
</script>


@endsection
 