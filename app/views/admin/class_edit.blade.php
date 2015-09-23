@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.tagsinput.css')}}
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-suitcase"></i> Edit Class <span></span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">Edit Class</li>
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
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#class1" data-toggle="tab"><strong>Edit Class</strong></a></li>
          <li><a href="#students2" data-toggle="tab"><strong>Assign Students</strong></a></li>
          <li><a href="#courses3" data-toggle="tab"><strong>Assign Courses</strong></a></li>
          <li></li>
		  <li></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="class1">
			<div class="panel panel-default">
			{{Form::open(array('url' => 'class/update', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'submit_form', 'autocomplete' => 'off'))}}        
				<input type="hidden" name="class" value="{{$classByID->id}}">
				<input type="hidden" name="hiddenSchools" id="hiddenSchools">
				<div class="panel-heading">
				  <div class="panel-btns">
				  </div>
				  <h4 class="panel-title">Editing information</h4>
				  <p></p>
					@if (!is_null(Session::get('status_error')))
					<div class="alert alert-danger">
						<a class="close" data-dismiss="alert" href="#">¡¿</a>
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
					  <label class="col-sm-3 control-label">Chosen Multiple School Select <span class="asterisk">*</span></label>
					  <div class="col-sm-5">
						<select class="form-control chosen-select"  multiple="multiple" data-placeholder="Choose a Schools..." id="schools" name="schools">
						  <option value=""></option>
						  @foreach($schools as $school)
						  @if (BaseController::checkSchool($school->id, $classByID->id) == true)
								<option value="{{$school->id}}" selected>{{$school->name}}</option>
						  @else
								<option value="{{$school->id}}">{{$school->name}}</option>
						  @endif								
						  @endforeach                
						</select>
						<span for="schools" class="help-block"></span>
					  </div>
					</div>  
					<div class="form-group">
					  <label class="col-sm-3 control-label">Name <span class="asterisk">*</span></label>
					  <div class="col-sm-6">
						<input type="text" id="name" name="name" value="{{$classByID->name}}" placeholder="Required" class="form-control" />
						<span class="help-block">Please enter the class name</span>
					  </div>
					</div>         
		 
					<div class="form-group">
					  <label class="col-sm-3 control-label">Description </label>
					  <div class="col-sm-7">
						<textarea class="form-control" id="description" name="description" placeholder="Optional" rows="5">{{$classByID->description}}</textarea>
						<span class="help-block">Please enter the class description</span>
					  </div>
					</div>            
					<div class="form-group">
					  <label class="col-sm-3 control-label">Publish </label>
					  <div class="col-sm-6">
					  		 @if ($classByID != null && $classByID->published == 1)
							 <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
							 <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
							 @elseif($classByID != null && $classByID->published == 0)
							 <div class="radio"><label><input type="radio" name="publish" value="1"> Yes</label></div>
							 <div class="radio"><label><input type="radio" name="publish" checked="" value="0"> No</label></div>	
							 @else
							 <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
							 <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
							 @endif				 
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
          <div class="tab-pane" id="students2">
			<div class="panel panel-default">
				{{Form::open(array('url' => 'class/students', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'student_form', 'autocomplete' => 'off'))}}       
					<input type="hidden" name="class" value="{{$classByID->id}}">
					<div class="panel-heading">
					  <div class="panel-btns">
					  </div>
					  <h4 class="panel-title">Assigning the students</h4>
					  <p></p>
						@if (!is_null(Session::get('status_error')))
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">¡¿</a>
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
							  <label class="col-sm-3 control-label">Students <span class="asterisk">*</span></label>							  
							  <div class="col-sm-9">							 
								@foreach($students as $student)								
								<div class="ckbox ckbox-default">
									@if (BaseController::checkStudent($student->id, $classByID->id) == true)
									<input type="checkbox" id="student_{{$student->id}}" value="{{$student->id}}|{{BaseController::getSchool($student->id)}}" checked name="students[]" required />
									@else
									<input type="checkbox" id="student_{{$student->id}}" value="{{$student->id}}|{{BaseController::getSchool($student->id)}}" name="students[]" required />					
									@endif
									
								  <label for="student_{{$student->id}}">User : ({{$student->first}} {{$student->last}})</label>
								  <span style="padding-left:100px;">&nbsp;<span>
								  School : ({{$student->name}})
								</div><!-- rdio -->	<input type="hidden" name="schools[]" value="{{BaseController::getSchool($student->id)}}">							
								@endforeach
								<label class="error" for="students[]"></label>
							  </div>
							 </div>
						</div><!-- panel-body -->						
					</div><!-- panel-body -->
					
					<div class="panel-footer">
						 <div class="row">
							<div class="col-sm-6 col-sm-offset-3">
							  <button class="btn btn-primary">Assign</button>&nbsp;
							  <button class="btn btn-default">Cancel</button>
							</div>
						 </div>
					  </div><!-- panel-footer -->
				{{ Form::close() }}           
			</div><!-- panel -->
          </div>
          <div class="tab-pane" id="courses3">
			<div class="panel panel-default">
				{{Form::open(array('url' => 'class/courses', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'course_form', 'autocomplete' => 'off'))}}
					<input type="hidden" name="class" value="{{$classByID->id}}">
					<input type="hidden" name="hiddenCourses" id="hiddenCourses">
					<div class="panel-heading">
					  <div class="panel-btns">
					  </div>
					  <h4 class="panel-title">Assigning the courses</h4>
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
							  <label class="col-sm-3 control-label">Chosen Multiple Courses Select <span class="asterisk">*</span></label>
							  <div class="col-sm-5">
								<select class="chosen-select"  multiple="multiple" 
								data-placeholder="Choose a Courses..." id="courses" name="courses" required>
								  <option value=""></option>
								  @foreach($courses as $course)
								  	@if (BaseController::checkCourse($classByID->id, $course->id) == true)
										<option value="{{$course->id}}" selected>{{$course->name}} [ {{$course->description}} ]</option>
									@else
										<option value="{{$course->id}}">{{$course->name}} [ {{$course->description}} ]</option>
									@endif
								  @endforeach                
								</select>
								<span for="courses" class="help-block"></span>
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
          </div> <!-- tab-pane courses3 -->
        </div>
	
</div>
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
	   	// Chosen Select
	   	jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});

	   	jQuery("#submit_form .btn-primary").click(function() {
	   		jQuery("#schools option").each(function() {
	   			if (jQuery(this).attr("selected") == "selected")
	   				jQuery("#hiddenSchools").val(jQuery("#hiddenSchools").val() + "," + jQuery(this).val());
	   		});
	   	});

	   	jQuery("#course_form .btn-primary").click(function() {
	   		jQuery("#courses option").each(function() {
	   			if (jQuery(this).attr("selected") == "selected")
	   				jQuery("#hiddenCourses").val(jQuery("#hiddenCourses").val() + "," + jQuery(this).val());
	   		});
	   	});

	   FormValidation.init();        
    });

  jQuery("#student_form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });

	var FormValidation = function () {
	
		var handleValidation1 = function() {
			// for more info visit the official plugin documentation: 
			var form1 = $('#submit_form');
			var courseForm = $('#course_form');
			var error1 = $('.alert-danger', form1);
			form1.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    schools: {
                        required: true
                    },
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

			courseForm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    courses: {
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

					$courses = "";
					$('#hiddenCourses').val('');
					$('#courses option:selected').each(function(){			
						$courses += $(this).val() + ",";
					});
				
					if ($courses != "") {
						$('#hiddenCourses').val($courses);
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