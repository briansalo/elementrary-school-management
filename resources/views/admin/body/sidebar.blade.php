 
 <!-- to get the route name and prefix-->
 @php
    $prefix = Request::route()->getprefix(); 
    $route = Request::route()->getName();   
 @endphp 


  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="../images/logo-dark.png" alt="">
						  <h3><b>Elementary</b> School</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="{{($route == 'dashboard')?'active':''}}">
          <a href="{{ route('dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		@if(Auth::user()->usertype == "Admin")
        <li class="treeview {{($prefix == '/users')?'active':''}}"> <!-- condition if the prefix is users then active or highlights the manage user-->
          <a href="#">
            
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
            <li><a href="{{route('user.add')}}"><i class="ti-more"></i>Add User</a></li>
          </ul>
        </li>
        @endif

		  
        <li class="treeview {{($prefix == '/setups')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('student.class.view')}}"><i class="ti-more"></i>School Class</a></li>
            <!--
            <li><a href="{{route('student.year.view')}}"><i class="ti-more"></i>School Year</a></li>
            -->
            <li><a href="{{route('student.grade.view')}}"><i class="ti-more"></i>School Grade</a></li>
            <li><a href="{{route('school.subject.view')}}"><i class="ti-more"></i>School Subject</a></li>
            <li><a href="{{route('designation.view')}}"><i class="ti-more"></i>Designation</a></li>
            <li><a href="{{route('student.fee.view')}}"><i class="ti-more"></i>Student Fee</a></li>
            <li><a href="{{route('assign.grade.view')}}"><i class="ti-more"></i>Assign Grade</a></li>
            <li><a href="{{route('category.amount.view')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
          </ul>
        </li>
		  

<li class="treeview {{($prefix == '/students')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('student.registration.add')}}"><i class="ti-more"></i>Student Registration</a></li>
            <li><a href="{{route('student.registration.view')}}"><i class="ti-more"></i>Student List</a></li>
            <li><a href="{{route('student.registration_fee.view')}}"><i class="ti-more"></i>Student Fee</a></li>
          </ul>
        </li>


<li class="treeview {{($prefix == '/employee')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('employee.registration.add')}}"><i class="ti-more"></i>Employee Registration</a></li>
            <li><a href="{{route('employee.registration.view')}}"><i class="ti-more"></i>Employee List</a></li>
            <li><a href="{{route('employee.salary.view')}}"><i class="ti-more"></i>Employee Salary</a></li>
            <li><a href="{{route('employee.attendance.view')}}"><i class="ti-more"></i>Employee Attendance</a></li>
            <li><a href="{{route('employee.monthly.salary.view')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
            <li><a href="{{route('employee.generate.payroll.view')}}"><i class="ti-more"></i>Generate Payroll</a></li>
          </ul>
        </li>


<li class="treeview {{($prefix == '/class')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Class Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('class.assign.view')}}"><i class="ti-more"></i>Class Assign</a></li>
            <li><a href="{{route('class.student.grade.search')}}"><i class="ti-more"></i>Student Grade</a></li>
          </ul>
        </li>
    		 
        

		
		  
        
      </ul>
    </section>
	

  </aside>