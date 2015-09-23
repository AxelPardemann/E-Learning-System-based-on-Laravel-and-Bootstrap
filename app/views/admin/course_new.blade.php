@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.tagsinput.css')}}
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-book"></i> Add New Course <span></span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">Add Course</li>
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
	<div class="panel panel-default">
{{Form::open(array('url' => 'course/add', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'submit_form', 'autocomplete' => 'off'))}}           
		<input type="hidden" name="hiddenSchools" id="hiddenSchools">
		<input type="hidden" name="userID" id="userID" value="{{$user->id}}">

		<div class="panel-heading">
          <div class="panel-btns">
          </div>
          <h4 class="panel-title">General information</h4>
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
                <input type="text" id="name" name="name" value="@if ($courseByID != null) {{$courseByID->name}} @endif" placeholder="Required" class="form-control" />
				<span class="help-block">Please enter the course name</span>
              </div>
            </div>         
 
            <div class="form-group">
              <label class="col-sm-3 control-label">Description </label>
              <div class="col-sm-7">
                <textarea class="form-control" id="description" name="description" placeholder="Optional" rows="5"> @if ($courseByID != null) {{$courseByID->description}} @endif</textarea>
				<span class="help-block">Please enter the course description</span>
              </div>
            </div>            
			<div class="form-group">
			  <label class="col-sm-3 control-label">Publish </label>
			  <div class="col-sm-6">
			  		 @if ($courseByID != null && $courseByID->published == 1)
					 <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
					 <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
					 @elseif($courseByID != null && $courseByID->published == 0)
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
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
	   // Chosen Select
	   //jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
	   FormValidation.init();        
    });
    /*
	$('.btn-primary').click(function(){
		$schools = "";
		$('#schools option:selected').each(function(){			
			$schools += $(this).val() + ",";
		});
		if ($schools != "") {
			$('#hiddenSchools').val($schools);
		}
	})
	*/
	var FormValidation = function () {
	
		var handleValidation1 = function() {
			// for more info visit the official plugin documentation: 
			var form1 = $('#submit_form');
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