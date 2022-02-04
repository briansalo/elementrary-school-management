@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Assign Subject</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('assign.grade.store')}}">
						@csrf

					 <div class="row">
								

							<div class="col-12">

								<!--this class can help in append in jquery below. -->
							<div class="add_item">

							<div class="form-group">								
								<h5> Grade Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="grade" id="grade" required="" class="form-control" aria-invalid="false">
										<option value="{{$grade->id}}">{{$grade->name}}</option>
									</select>
								<div class="help-block"></div></div>
							</div>

								
							<div class="form-group">								
								<h5> Class Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="class" id="select" required="" class="form-control" aria-invalid="false">
											<option value="">Select Class</option>
										@foreach($classes as $class)
										<option value="{{$class->id}}">{{$class->name}}</option>
										@endforeach
									</select>
								<div class="help-block"></div></div>
							</div>



					 <div class="row">

					 		<div class="col-md-4">
								<div class="form-group">
									<h5>Student Subject <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="subject[]" id="select" required="" class="form-control" aria-invalid="false">
											<option value="">Select Subject</option>
											@foreach($subjects as  $subject)
											<option value="{{ $subject->id }}">{{$subject->name}}</option>
											@endforeach
										</select>
									<div class="help-block"></div></div>
								</div>
					 		</div> <!-- end col md 4 -->
					 		
					 		<div class="col-md-2">
									<div class="form-group">
										<h5>Full Mark <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="full_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 2 -->	

					 		<div class="col-md-2">
									<div class="form-group">
										<h5>Pass Mark <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="pass_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 2 -->	



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


					 		<div class="col-md-4">
								<div class="form-group">
									<h5>Student Subject <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="subject[]" id="select" required="" class="form-control" aria-invalid="false">
											<option value="">Select Subject</option>
											@foreach($subjects as  $subject)
											<option value="{{ $subject->id }}">{{$subject->name}}</option>
											@endforeach
										</select>
									<div class="help-block"></div></div>
								</div>
					 		</div> <!-- end col md 4 -->
					 		
					 		<div class="col-md-2">
									<div class="form-group">
										<h5>Full Mark <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="full_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 2 -->	

					 		<div class="col-md-2">
									<div class="form-group">
										<h5>Pass Mark <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="pass_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									</div>
					 		</div><!-- end col md 2 -->	



					 		<div class="cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 				<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i>	</span>
					 		</div>	<!-- end col md 2 -->	

					 


  			</div>
  		</div>
  	</div>	
  </div>	


<script type="text/javascript">


 	$(document).ready(function(){
 		
 		$(document).on("click",".addeventmore",function(){

 			// converting the class whole_extra_item_add to variable in able to use in the append method
 			var whole_extra_item_add = $('#whole_extra_item_add').html();

 			//i put class add item in able to locate where the append method will show
 			$(".add_item").append(whole_extra_item_add);
 			
 		});

 		// if the class removeeventmore will click the delete_whole_extra_item_add class will remove
 		$(document).on("click",'.removeeventmore',function(){
 			$('#delete_whole_extra_item_add').remove();
 			
 		});
 	});
 </script>



@endsection