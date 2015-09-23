@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.tagsinput.css')}}
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-building"></i> Edit School <span></span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">Edit School</li>
    </ol>
  </div>
</div>
<div class="contentpanel"> 
  @if (Session::get('status_success') != '')
  <div class="row">
      <div class="col-md-12">
          <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>            
                {{ Session::get('status_success')}}            
          </div>
      </div>
  </div>
  @endif
        <h5 class="subtitle mb5"></h5>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#school1" data-toggle="tab"><i class="fa fa-edit"></i>&nbsp; <strong> Edit settings</strong></a></li>
          <li><a href="#classes2" data-toggle="tab"><i class="fa fa-suitcase"></i>&nbsp; <strong> Enrolled Classes</strong></a></li>
          <li><a href="#users3" data-toggle="tab"><i class="fa fa-user"></i>&nbsp; <strong> Enrolled Users</strong></a></li>
		  <li></li>
		  <li></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="school1">
			<div class="panel panel-default">
			{{Form::open(array('url' => 'school/update', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'submit_form', 'autocomplete' => 'off'))}}        
			<input type="hidden" name="school" value="{{$schoolByID->id}}">
					<div class="panel-heading">
					  <div class="panel-btns">
					  </div>
					  <h4 class="panel-title">Editing information</h4>
					  <p></p>
						@if (!is_null(Session::get('status_error')))
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading">Error!</h4>
							@if (is_array(Session::get('status_error')))
								<ul>
								@foreach (Session::get('status_error') as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							@else
								{{ Session::get('status_error')}}
							@endif
						</div>
						@endif
					</div>
					<div class="panel-body panel-body-nopadding">						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Name <span class="asterisk">*</span></label>
						  <div class="col-sm-6">
							<input type="text" id="name" name="name" value="{{$schoolByID->name}}" placeholder="Required" class="form-control" />
							<span class="help-block">Please enter the class name</span>
						  </div>
						</div>         
			 
						<div class="form-group">
						  <label class="col-sm-3 control-label">Description </label>
						  <div class="col-sm-7">
							<textarea class="form-control" id="description" name="description" placeholder="Optional" rows="5">{{$schoolByID->description}}</textarea>
							<span class="help-block">Please enter the class description</span>
						  </div>
						</div>            

						<div class="form-group">
						  <label class="col-sm-3 control-label">Address </label>
						  <div class="col-sm-6">
							<input type="text" id="address" name="address" value="{{$schoolByID->address}}" placeholder="Required" class="form-control" />
							<span class="help-block">Please enter the class name</span>
						  </div>
						</div>  

						<div class="form-group">
						  <label class="col-sm-3 control-label">Publish </label>
						  <div class="col-sm-6">
								 <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
								 <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
							  </div>
						</div>
					</div><!-- panel-body -->
					
					<div class="panel-footer">
						 <div class="row">
							<div class="col-sm-6 col-sm-offset-3">
							  <button class="btn btn-primary">Submit</button>&nbsp;
							  <button class="btn btn-default">Cancel</button>
							</div>
						 </div>
					  </div><!-- panel-footer -->
			 {{ Form::close() }}           
			  </div><!-- panel -->
		  </div>
          <div class="tab-pane" id="classes2">
			<div class="panel panel-default">
			{{Form::open(array('url' => 'school/classes', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'classes_form', 'autocomplete' => 'off'))}}       
					<input type="hidden" name="school" value="{{$schoolByID->id}}">
					<input type="hidden" name="hiddenClasses" id="hiddenClasses">
					<div class="panel-heading">
					  <div class="panel-btns">
					  </div>
					  <h4 class="panel-title">Assigning the classes</h4>
					  <p></p>
						@if (!is_null(Session::get('status_error')))
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading">Error!</h4>
							@if (is_array(Session::get('status_error')))
								<ul>
								@foreach (Session::get('status_error') as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							@else
								{{ Session::get('status_error')}}
							@endif
						</div>
						@endif
					</div>
					<div class="panel-body panel-body-nopadding">
						<div class="panel-body">	 
							<div class="form-group">
							  <label class="col-sm-3 control-label">Chosen Multiple Classes Select <span class="asterisk">*</span></label>
							  <div class="col-sm-5">
								<select class="chosen-select"  multiple="multiple" 
								data-placeholder="Choose a Classes..." id="classes" name="classes" required>
								  <option value=""></option>
								  @foreach($classes as $class)
									@if (BaseController::checkSchool($schoolByID->id, $class->id) == true)
									<option value="{{$class->id}}" selected>{{$class->name}} [ {{$class->description}} ] </option>
									@else
									<option value="{{$class->id}}">{{$class->name}} [ {{$class->description}} ] </option>
									@endif									
								  @endforeach                
								</select>
								<span for="classes" class="help-block"></span>
							  </div>
							</div> 
						</div><!-- panel-body -->						
					</div><!-- panel-body -->					 
					<div class="panel-footer">
						 <div class="row">
							<div class="col-sm-6 col-sm-offset-3">
							  <button class="btn btn-primary" id="btnClass">Assign</button>&nbsp;
							</div>
						 </div>
					  </div><!-- panel-footer -->
			 {{ Form::close() }}           
			  </div><!-- panel -->
          </div> <!-- tab-pane classes2-->

          <div class="tab-pane" id="users3">
			<div class="panel panel-default">
			{{Form::open(array('url' => 'school/users', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'users_form', 'autocomplete' => 'off'))}}       
					<input type="hidden" name="school" value="{{$schoolByID->id}}">
					<input type="hidden" name="hiddenUsers" id="hiddenUsers">
					<div class="panel-heading">
					  <div class="panel-btns">
					  </div>
					  <h4 class="panel-title">Assigning the users</h4>
					  <p></p>
						@if (!is_null(Session::get('status_error')))
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading">Error!</h4>
							@if (is_array(Session::get('status_error')))
								<ul>
								@foreach (Session::get('status_error') as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							@else
								{{ Session::get('status_error')}}
							@endif
						</div>
						@endif
					</div>		
					<div class="panel-body panel-body-nopadding">
						<div class="panel-body">	 
							<div class="form-group">
							  <label class="col-sm-3 control-label">Chosen Multiple Users Select <span class="asterisk">*</span></label>
							  <div class="col-sm-5">
								<select class="chosen-select"  multiple="multiple" 
								data-placeholder="Choose a Users..." id="users" name="users" required>
								  <option value=""></option>
								  @foreach($users as $learner)
									@if (BaseController::checkUser($schoolByID->id, $learner->id) == true)
									<option value="{{$learner->id}}" selected>{{$learner->first}} {{$learner->last}} [ {{$learner->permission}} ]</option>
									@else
									<option value="{{$learner->id}}">{{$learner->first}} {{$learner->last}} [ {{$learner->permission}} ]</option>
									@endif
								  @endforeach                
								</select>
								<span for="users" class="help-block"></span>
							  </div>
							</div> 
						</div><!-- panel-body -->						
					</div><!-- panel-body -->					
					<div class="panel-footer">
						 <div class="row">
							<div class="col-sm-6 col-sm-offset-3">
							  <button class="btn btn-primary">Assign</button>&nbsp;
							</div>
						 </div>
					  </div><!-- panel-footer -->
			 {{ Form::close() }}           
			  </div><!-- panel -->
          </div> <!-- tab-pane users3 -->
        </div>
	
</div>
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
	   // Chosen Select
	   jQuery(".chosen-select").chosen({'width':'500px','white-space':'nowrap'});
	   FormValidation.init();        
    });

	var FormValidation = function () {
		
		var handleValidation1 = function() {
			// for more info visit the official plugin documentation: 
			var mainForm = $('#submit_form');
			var classForm = $('#classes_form');
			var userForm = $('#users_form');
			var courseForm = $('#course_form');
			
			var error1 = $('.alert-danger', mainForm);

			mainForm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    name: {
                        required: true
                    },
				},
				invalidHandler: function (event, validator) { //display error alert on form submit              
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
			
			classForm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    classes: {
                        required: true
                    },
				},
				invalidHandler: function (event, validator) { //display error alert on form submit              
					//error1.show();
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
						$classes = "";
						$('#hiddenClasses').val('');
						$('#classes option:selected').each(function(){			
							$classes += $(this).val() + ",";
						});
						if ($classes != "") {
							$('#hiddenClasses').val($classes);
						}
						error1.hide();
						form.submit();
				}
			});	
			
			userForm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    users: {
                        required: true
                    },
				},
				invalidHandler: function (event, validator) { //display error alert on form submit              
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

					$users = "";
					$('#hiddenUsers').val('');
					$('#users option:selected').each(function(){			
						$users += $(this).val() + ",";
					});
					if ($users != "") {
						$('#hiddenUsers').val($users);
					}

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
</script>
@endsection