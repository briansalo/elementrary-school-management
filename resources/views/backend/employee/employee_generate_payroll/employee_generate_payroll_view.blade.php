@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Generate Payroll </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">


			  <div class="row">
				<div class="col-12">

			<form method="post" action="{{ route('employee.attendance.generate.store') }}">
				@csrf

					 <div class="row">

								<div class="col-md-3">
										<div class="form-group">
											<h5>From <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="date" name="from" id="from" class="form-control">
													   @error('to')
														    <span class="text-danger">{{$message}}</span>
													   @enderror
											 </div>
										</div>
								</div><!-- end col md 3 -->

							<div class="col-md-3">
									<div class="form-group">
										<h5>To <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="date" name="to" id="to" class="form-control">
	                    </div>
									</div>
							</div><!-- end col md 3 -->

							<div class="col-md-2">
		  						 <div class="col-md-3" style="padding-top: 25px;">
											<a id="search" class="btn btn-primary" name="search" > Search</a>
			  						</div>		
							</div><!-- end col md 2 -->



     <!-----------------for deduction --------------------->
							<div class="col-md-2">
									<div class="form-group">
										<h5>Deduction<span class="text-danger">*</span></h5>																		
											<input type="checkbox" id="deduction" name="deduction">
											<label for="deduction"> SSS/PHIC/PAGIBIG</label>
									</div>
							</div><!-- end col md 2 -->

							<div class="col-md-2">
									<div class="form-group d-none" id="amount_month">
										<div class="controls">
												<h5>Amount <span class="text-danger">*</span></h5>
												<input type="text" id="amount" name="amount" value="0"><br>

												<h5>month <span class="text-danger">*</span></h5>
												<input type="month" name="month" id="month" class="form-control"><br>

												<a id="submit" class="btn btn-primary" name="submit"> submit</a>
		                 </div>
									</div>
							</div><!-- end col md 2 -->

					 </div><!-- end row -->



		<!--  ////////////////////////////////////////////  this is the table //////////////////////////////////////////  -->
						 
								<div class="row d-none " id="roll-generate">

											<div class="col-12">
																	
													  <table class="table table-bordered table-striped" style="width: 100%">
																<thead>
																	<tr>
																		<th width="20%">Name</th>
																		<th width="20%">Covered Date</th>
																		<th width="10%">Salary</th>
																		<th width="5%">No. of Days</th>
																		<th width="10%">Sub Total</th>
																		<th width="5%">Late</th>
																		<th width="5%">Overtime</th>
																		<th width="10%">Deduction</th>
																		<th width="10%">Total Salary</th>
																	</tr>
																</thead>
																<tbody id="roll-generate-tr">
								
																</tbody>

													  </table>

											</div>
											<!-- /.col 12-->


									  <input type="submit" target="_blank" name="action" class="btn btn-info" value="Generate_Payroll">

							</div><!--d-none -->


					        <!-- ///// ///////////////////////////////////////// END table//////////////////////////////////////  -->
				

 				</form>
			

				</div>
				<!-- /.col 12 -->
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
	
  $(document).on('click','#search',function(){

	  	    var from = $('#from').val();
	  	    var to = $('#to').val();
	  	    var amount = $('#amount').val();

					   	 $.ajax({
	  							url: "{{ route('employee.salary.date.from.to.search')}}",
	   								method:'GET',
	   								data:{'from':from,'to':to,'amount':amount},
	  								 dataType:'json',
	  								 success:function(data){

													if($.trim(data)== "invalid_date"){   
									    				alert("The Date is Invalid ");
													}
													else{   
							  								$('#roll-generate').removeClass('d-none');		   							
						    								$('#roll-generate-tr').html(data);
							  					}
					
						         }//END OF SUCCESS FUNCTION

	  						})// end of ajax

  }); // close of document on click

	</script>



	<script>

  $(document).on('click','#submit',function(){

    	    var from = $('#from').val();
	  	    var to = $('#to').val();
	  	    var amount = $('#amount').val();
	  	    var month = $('#month').val();

					   	 $.ajax({
	  							url: "{{ route('employee.salary.date.from.to.search')}}",
	   								method:'GET',
	   								data:{'from':from,'to':to,'amount':amount,'month':month},
	  								 dataType:'json',
	  								 success:function(data){

		  								 $('#roll-generate').removeClass('d-none');		   							
		    								$('#roll-generate-tr').html(data);
	  								 }

	  					})// end of ajax


  }); // close of document on click


</script>




<script>

// this script when the checkbox is checked
$('#deduction').change(function() {
    if(this.checked) {
          $('#amount_month').removeClass('d-none');
    }else{
    	    $('#amount_month').addClass('d-none');
    }


}); //end of change


</script>




@endsection