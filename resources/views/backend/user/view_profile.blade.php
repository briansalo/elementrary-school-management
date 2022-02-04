@extends('admin.admin_master')
@section('admin')

  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

	  		<div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black">
					  <h1 class="widget-user-username">{{ $user->name}}</h1>

					  <a href="{{route('profile.edit')}}" style="float: right;" class="btn btn-rounded	btn-success mb-5">Edit Profile</a>

					  <h6 class="widget-user-desc">{{ $user->usertype}}</h6>
					  <h6 class="widget-user-desc">{{ $user->email}}</h6>
					</div>
					<div class="widget-user-image">

						<!-- condition if the user has uploaded image then show it the image, else use the image of no_image -->
					  <img class="rounded-circle" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path): url('upload/no_image.jpg')}}" alt="User Avatar">
					</div>
					<br><br>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Mobile Number</h5>
							<span class="description-text">{{ $user->mobile_number }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">address</h5>
							<span class="description-text">{{ $user->address }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">gender</h5>
							<span class="description-text">{{ $user->gender }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->

					  </div>
					  <!-- /.row -->
					</div>
				  </div>

		</section>
	  </div>
  </div>

@endsection