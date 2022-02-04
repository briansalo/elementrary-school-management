@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Fee Amount</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store.fee.amount')}}">
						@csrf

					 <div class="row">

							<div class="col-12">
							<div class="add_item">
								
							<div class="form-group">								
								<h5>Fee Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="fee" id="select" required="" class="form-control" aria-invalid="false">
										@foreach($fee_categories as $fee)
										<option value="{{$fee->id}}">{{$fee->name}}</option>
										@endforeach
									</select>
								<div class="help-block"></div></div>
							</div>


					 <div class="row">

					 		<div class="col-md-5">
								<div class="form-group">
									<h5>Class Category <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="class[]" id="select" required="" class="form-control" aria-invalid="false">
											<option value="">Select Clas Category</option>
											@foreach($classes as  $class)
											<option value="{{ $class->id }}">{{$class->name}}</option>
											@endforeach
										</select>
									<div class="help-block"></div></div>
								</div>
					 		</div> <!-- end col md 5 -->
					 		
					 		<div class="col-md-5">
									<div class="form-group">
										<h5>Amount <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="amount[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 5 -->	


					 		<div class="cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 		</div>	<!-- end col md 2 -->	

					 </div> <!-- end row-->

					</div><!-- end class of add_item -->



						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="submit">
						</div>
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


  <div style="visibility: hidden;">
  	<div class="whole_extra_item_add" id="whole_extra_item_add">
  		<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
  			<div class="row">


					 		<div class="col-md-5">
								<div class="form-group">
									<h5>Class Category <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="class[]" id="select" required="" class="form-control" aria-invalid="false">
											<option value="">Select Clas Category</option>
											@foreach($classes as  $class)
											<option value="{{ $class->id }}">{{$class->name}}</option>
											@endforeach
										</select>
									<div class="help-block"></div></div>
								</div>
					 		</div> <!-- end col md 5 -->
					 		
					 		<div class="col-md-5">
									<div class="form-group">
										<h5>Amount <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="amount[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 5 -->	


					 		<div class="cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 				<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i>	</span>
					 		</div>	<!-- end col md 2 -->	

					 


  			</div>
  		</div>
  	</div>	
  </div>	

<!-- Line 146 converting the class whole_extra_item_add to variable in able to use in the append method -->	
<!-- Line 147 i put class add item in able to locate where the append method will show -->
<!-- line 151 if the class removeeventmore will click the delete_whole_extra_item_add class will remove -->	
<script type="text/javascript">


 	$(document).ready(function(){
 		
 		$(document).on("click",".addeventmore",function(){
 			var whole_extra_item_add = $('#whole_extra_item_add').html();
 			$(".add_item").append(whole_extra_item_add);
 			
 		});
 		$(document).on("click",'.removeeventmore',function(){
 			$('#delete_whole_extra_item_add').remove();
 			
 		});
 	});
 </script>



@endsection