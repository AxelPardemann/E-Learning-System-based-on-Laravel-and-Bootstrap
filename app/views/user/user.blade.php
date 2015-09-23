@extends('layouts.default')
@section('globalStyles')
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
{{HTML::style('assets/plugins/select2/select2_metro.css')}}
{{HTML::style('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}
{{HTML::style('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('assets/plugins/bootstrap-timepicker/compiled/timepicker.css')}}
{{HTML::style('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css')}}
{{HTML::style('assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}
{{HTML::style('assets/plugins/bootstrap-editable/inputs-ext/address/address.css')}}
<!-- END PLUGINS USED BY X-EDITABLE -->

<!-- BEGIN IMAGE CROPPING -->
{{HTML::style('assets/css/imgareaselect-default.css')}}
<!-- END IMAGE CROPPING -->

<!-- BEGIN CONFIRM DIALOG -->
{{HTML::style('assets/css/styles.css')}}
{{HTML::style('assets/jquery.confirm/jquery.confirm.css')}}
<!-- END CONFIRM DIALOG -->
@endsection

@section('sidebar')
	@include('user.sidebar')
@endsection
@section('pageContainer')

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Story Submission <small>application management</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="{{URL::route("user/home")}}">Home</a>
						</li>
						<li>
							<i class="fa fa-angle-right"></i> 
							Users
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT -->
			
			<div class="row">
				<div class="col-md-12">
				@if($userById != null)
				<h2>{{ $userById->username }}</h2>
					
					<div style="float:right;" class="item">
						<form class="form-horizontal" id="deleteForm" method="POST" action="{{URL::route('user/delete', array('id'=>$userById->id)) }}">
							<button type="button" class="btn green" id="delete-user-ajaxs">Delete User</button>						
						</form>
					</div>
					<input type="hidden" name="formtype" id="formtype" value="users">
					<table id="submission" class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td style="width:15%">
								Email
							</td>
							<td style="width:50%">
								@if($userById->email != ''){{ $userById->email }}@else{{ 'Empty' }}@endif
							</td>
							<td style="width:35%">								
							</td>
						</tr>
						<tr>
							<td style="width:15%">
								First name
							</td>
							<td style="width:50%">
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" data-type="text" data-pk="{{ $userById->id }}" data-name="first" data-placeholder="Required" data-original-title="Enter First Name" class="editable editable-click" style="display: inline;">@if($userById->first != ''){{ $userById->first }}@else{{ 'Empty' }}@endif</a>
							</td>
							<td style="width:35%">
								<span class="text-muted">
									Enter first name.
								</span>
							</td>
						</tr>
						<tr>
							<td>
								Last name
							</td>
							<td>
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" data-type="text" data-pk="{{ $userById->id }}" data-name="last" data-placeholder="Required" data-original-title="Enter Last phone" class="editable editable-click" style="display: inline;">@if($userById->last != ''){{ $userById->last }}@else{{ 'Empty' }}@endif</a>
							</td>
							<td>
								<span class="text-muted">
									Enter last name.
								</span>
							</td>
						</tr>
						<tr>
							<td>
								Company
							</td>
							<td>
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" data-type="text" data-pk="{{ $userById->id }}" data-name="company" data-placeholder="Required" data-original-title="Enter Company/Organization Name." class="editable editable-click">@if($userById->company != ''){{ $userById->company }}@else{{ 'Empty' }}@endif</a>
							</td>
							<td>
								<span class="text-muted">
									Please enter company.
								</span>
							</td>
						</tr>
						<tr>
							<td>
								Phone Number
							</td>
							<td>
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" data-type="text" data-pk="{{ $userById->id }}" data-name="phone" data-placeholder="Required" data-original-title="Enter Phone Number." class="editable editable-click">@if($userById->phone != ''){{ $userById->phone }}@else{{ 'Empty' }}@endif</a>
							</td>
							<td>
								<span class="text-muted">
									Please enter phone number.
								</span>
							</td>
						</tr>	
						<tr>
							<td>
								Permission
							</td>							
							<td>
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" id="permission" data-type="select" data-pk="{{ $userById->id }}" data-name="permission" data-original-title="Select the Permission" class="editable editable-click">@if($userById->permission != ''){{ $userById->permission }}@else{{ 'Empty' }}@endif</a>
							</td>
							<td>
								<span class="text-muted">
									Please select permission.
								</span>
							</td>
						</tr>
						<tr>
							<td>
								Active
							</td>							
							<td>
								<a href="javascript:;" data-url="{{ URL::route('user/update') }}" id="active" data-type="select" data-pk="{{ $userById->id }}" data-name="active" data-original-title="Select the Permission" class="editable editable-click active">@if($userById->active == '1') Active @else Deactive @endif</a>
							</td>
							<td>
								<span class="text-muted">
									Please select permission.
								</span>
							</td>
						</tr>							
					</tbody>
					</table>
					@else 
						<h2>There are no any users.</h2>
					@endif
				</div>				
			</div>
			<!-- END PAGE CONTENT -->
		</div>
	</div>
	<!-- END CONTENT -->
@endsection

@section('pageLevelPlugins')
{{ HTML::script('assets/scripts/jquery.form.min.js') }}
{{ HTML::script('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}

<!-- BEGIN CONFIRM DIALOG -->
{{ HTML::script('assets/jquery.confirm/jquery.confirm.js') }}
{{ HTML::script('assets/scripts/script.js') }}
<!-- END CONFIRM DIALOG -->

<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
{{ HTML::script('assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}
{{ HTML::script('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
{{ HTML::script('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}
{{ HTML::script('assets/plugins/moment.min.js') }}
{{ HTML::script('assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js') }}
{{ HTML::script('assets/plugins/bootstrap-editable/inputs-ext/address/address.js') }}
{{ HTML::script('assets/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') }}
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/plugins/data-tables/jquery.dataTables.js') }}
{{ HTML::script('assets/plugins/data-tables/DT_bootstrap.js') }}
<!-- END X-EDITABLE PLUGIN -->
{{HTML::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}
{{HTML::script('assets/plugins/jquery-validation/dist/additional-methods.min.js')}}
@endsection

@section('pageLevelScripts')
{{ HTML::script('assets/scripts/app.js') }}
{{ HTML::script('assets/scripts/form-editable.js') }}
@endsection

@section('javaScript')
<script>
	var FormValidation = function () {

		var handleValidation1 = function() {
			// for more info visit the official plugin documentation: 
				// http://docs.jquery.com/Plugins/Validation

				var form1 = $('#userAdd');
				var error1 = $('.alert-danger', form1);
				var success1 = $('.alert-success', form1);

				form1.validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					focusInvalid: false, // do not focus the last invalid input
					ignore: "",
					rules: {
						first: {
							required: true,
							minlength: 1
						},
						last: {
							required: true,
							minlength: 1
						},
						email: {
							required: true,
						},
						company: {
							required: true,
							minlength: 1
						},
						phone: {
							required: true,
							number: true,
							minlength: 10
						}
					},

					invalidHandler: function (event, validator) { //display error alert on form submit              
						success1.hide();
						error1.show();
						App.scrollTo(error1, -200);
					},

					highlight: function (element) { // hightlight error inputs
						$(element)
							.closest('.form-group').addClass('has-error'); // set error class to the control group
					},

					unhighlight: function (element) { // revert the change done by hightlight
						$(element)
							.closest('.form-group').removeClass('has-error'); // set error class to the control group
					},

					success: function (label) {
						label
							.closest('.form-group').removeClass('has-error'); // set success class to the control group
					},

					submitHandler: function (form) {
						error1.hide();
						form.submit();
					}
				});

		}
		return {
			//main function to initiate the module
			init: function () {
				handleValidation1();
			}

		};

	}();

	jQuery(document).ready(function() {
		// initiate layout and plugins
		App.init();
		FormEditable.init();
		UIExtendedModals.init();
		$("#full-width").on('shown.bs.modal', function (e) {
				FormValidation.init();
		});
	});
</script>

@endsection