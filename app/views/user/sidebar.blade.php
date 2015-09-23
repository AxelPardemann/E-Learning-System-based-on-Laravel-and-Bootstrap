<style type="text/css">
.page-content {
	margin-left: 225px !important;
}
.page-sidebar-menu li {
	text-align: center;
	padding: 10px 15px;
	color:white;
}
</style>

<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu">
	<li class="">
		<h4>User Navigation</h4>
		<p>Click on a user name to edit details of that user</p>
	</li>
	<li class="">
		<div class="btn-group-vertical btn-group-solid">
			<button type="button" class="btn green" id="modal-ajax" data-toggle="modal" 
			data-url="{{URL::route('modals/userAdd') }}">
			<i class="fa fa-plus"></i> Add User</button>
		</div>
	</li>	
	<li class="">
		<div class="list-group" style="text-align:left;">
		@foreach ($users as $user)
			<a href="{{URL::route('users/user', array('id'=>$user->id))}}" class="list-group-item">
			{{ $user->email}}</a>
		@endforeach
		</div>
	</li>
</ul>
<!-- END SIDEBAR MENU -->
<div id="full-width" class="modal container fade" tabindex="-1">
</div>