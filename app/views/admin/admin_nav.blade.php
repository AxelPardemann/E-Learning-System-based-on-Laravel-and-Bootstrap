<h5 class="sidebartitle">Navigation </h5>
<ul class="nav nav-pills nav-stacked nav-bracket">
	<li class="@if(strtolower($title) == 'dashboard') active @endif">
		<a href="{{ URL::route("admin/dashboard") }}">
		<i class="fa fa-home"></i> <span>Dashboard</span></a>
	</li>
	<li>
		<a href="email.html"><span class="pull-right badge badge-success">2</span><i class="fa fa-envelope-o"></i> <span>Email</span></a>
	</li>
	<li class="nav-parent @if(strtolower($title) == 'school') active nav-active @endif">
		<a href=""><i class="fa fa-building"></i> <span>Schools</span></a>
		<ul class="children">
			<li class="@if(strtolower($sub_title) == 'schoolall') active @endif">
				<a href="{{ URL::route("admin/schools") }}"><i class="fa fa-caret-right"></i> All Schools</a>
			</li>  
			<li class="@if(strtolower($sub_title) == 'schoolnew') active @endif">
				<a href="{{ URL::route("admin/schoolAdd") }}"><i class="fa fa-caret-right"></i> Add School</a>
			</li>      
		</ul>
	</li>
	<li class="nav-parent @if(strtolower($title) == 'class') active nav-active @endif"><a href=""><i class="fa fa-suitcase"></i> <span>Classes</span></a>
	<ul class="children">
	  <li class="@if(strtolower($sub_title) == 'classall') active @endif"><a href="{{ URL::route("admin/classes") }}"><i class="fa fa-caret-right"></i>All Classes</a></li>      
	  <li class="@if(strtolower($sub_title) == 'usernew') active @endif"><a href="{{ URL::route("admin/classAdd") }}"><i class="fa fa-caret-right"></i>Add Class</a></li>      
	</ul>
	</li>

	<li class="nav-parent @if(strtolower($title) == 'course') active nav-active @endif">
		<a href=""><i class="fa fa-book"></i> <span>Course</span></a>
		<ul class="children">
			<li class="@if(strtolower($sub_title) == 'courseall') active @endif">
				<a href="{{ URL::route("admin/courses") }}"><i class="fa fa-caret-right"></i>All Course</a>
			</li>			
			<li class="@if(strtolower($sub_title) == 'coursenew') active @endif">
				<a href="{{ URL::route("admin/courseAdd") }}">
				<i class="fa fa-caret-right"></i>Add Course</a>
			</li>          
		</ul>
	</li>

	<li class="nav-parent @if(strtolower($title) == 'sprint') active nav-active @endif">
		<a href=""><i class="fa fa-th-list"></i> <span>Sprint</span></a>
		<ul class="children">
			<li class="@if(strtolower($sub_title) == 'sprintall') active @endif">
				<a href="{{ URL::route("admin/sprints") }}"><i class="fa fa-caret-right"></i>All Sprint</a>
			</li>			
			<li class="@if(strtolower($sub_title) == 'sprintnew') active @endif">
				<a href="{{ URL::route("admin/sprintAdd") }}">
				<i class="fa fa-caret-right"></i>Add Sprint</a>
			</li>          
		</ul>		
	</li>
	
	<li class="nav-parent @if(strtolower($title) == 'user') active nav-active @endif">
		<a href=""><i class="fa fa-user"></i> <span>Users</span></a>
		<ul class="children">
			<li class="@if(strtolower($sub_title) == 'userall') active @endif">
				<a href="{{ URL::route("admin/users") }}"><i class="fa fa-caret-right"></i>All Users</a>
			</li>
			<li class="@if(strtolower($sub_title) == 'usernew') active @endif">
				<a href="{{ URL::route("admin/userAdd") }}"><i class="fa fa-caret-right"></i>Add User</a>
			</li>          
		</ul>
	</li>  
</ul>