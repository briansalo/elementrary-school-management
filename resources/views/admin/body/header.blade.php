  <header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
      <!-- Sidebar toggle button-->
	  <div>
		  <ul class="nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
					<i class="nav-link-icon mdi mdi-menu"></i>
			    </a>
			</li>
			<li class="btn-group nav-item">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
					<i class="nav-link-icon mdi mdi-crop-free"></i>
			    </a>
			</li>			
			<li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
					<i class="ti-check-box"></i>
			    </a>
			</li>
		  </ul>
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
		  <!-- full Screen -->
	

	<!-- line 104 to line 108 is just an example. there's nothing to use that code here -->	
		<!-- you can also use this if you want to get the data from database and use it here in blade.php -->		  
@php
	$theuser = DB::table('users')->where('id', Auth::user()->id)->first();
@endphp

	      <!-- User Account-->
          <li class="dropdown user user-menu">	
							<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
								
										<!--  
									  <img class="rounded-circle" src="{{ (!empty(auth::user()->profile_photo_path))? url('upload/user_images/'.auth::user()->profile_photo_path): url('upload/no_image.jpg')}}" alt="User Avatar">
										-->

									  <img class="rounded-circle" src="{{url('upload/admin_pic.jpg')}}" alt="User Avatar">

							</a>

							<ul class="dropdown-menu animated flipInX">
							  <li class="user-body">
								 <a class="dropdown-item" href="{{ route('profile.view') }}"><i class="ti-user text-muted mr-2"></i> Profile</a>
								 <a class="dropdown-item" href="{{ route('profile.change_password') }}"><i class="ti-wallet text-muted mr-2"></i> Change Password</a>
								 <div class="dropdown-divider"></div>
								 <a class="dropdown-item" href="{{ route('admin.logout')}}"><i class="ti-lock text-muted mr-2"></i> Logout</a>
							  </li>
							</ul>
          </li>	
			
        </ul>
      </div>
    </nav>
  </header>