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
        <h5 class="subtitle mb5"></h5>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#course1" data-toggle="tab"><i class="fa fa-edit"></i>&nbsp; <strong> Edit Course</strong></a></li>
          <!-- <li><a href="#sprints2" data-toggle="tab"><i class="fa fa-suitcase"></i>&nbsp; <strong> Enrolled Sprint</strong></a></li> -->
		  <li></li>
		  <li></li>
        </ul>  
        <!-- Tab panes -->
	<div class="tab-content">
		  <div class="tab-pane active" id="course1">        
			<div class="panel panel-default">
			{{Form::open(array('url' => 'course/update', 'method' => 'post', 'class' => 'form-horizontal form-bordered', 'id' => 'submit_form', 'autocomplete' => 'off'))}}					
					<input type="hidden" name="courseID" id="courseID" value="{{$courseByID->id}}" />
					
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
			                <input type="text" id="name" name="name" value="{{$courseByID->name}}" placeholder="Required" class="form-control" />
							<span class="help-block">Please enter the class name</span>
			              </div>
			            </div>         
			 
			            <div class="form-group">
			              <label class="col-sm-3 control-label">Description </label>
			              <div class="col-sm-7">
			                <textarea class="form-control" id="description" name="description" placeholder="Optional" rows="5">{{$courseByID->description}}</textarea>
							<span class="help-block">Please enter the class description</span>
			              </div>
			            </div>            
						<div class="form-group">
						  <label class="col-sm-3 control-label">Publish </label>
						  <div class="col-sm-6">
						  		 @if ($courseByID->published == 1)
								 <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
								 <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
								 @else
								 <div class="radio"><label><input type="radio" name="publish" value="1"> Yes</label></div>
								 <div class="radio"><label><input type="radio" name="publish" checked="" value="0"> No</label></div>								 
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
	</div>
	<div class="tab-content second-list">
	 <h4 class="panel-title">Sprints</h4>
	 {{Form::open(array('url' => 'sprint/delete', 'method' => 'post', 'class' => 'form', 'id' => 'sprintForm', 'autocomplete' => 'off'))}} 
	  <input type="hidden" name="id" id="id">
      <div class="table-responsive">
          <table class="table" id="class_table2">
              <thead>
                 <tr>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Fluency rate</th>                    
                    <th>Cards</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($sprints as $sprint)
                 <tr class="odd gradeX">
                    <td>
                    	<input type="hidden" id="course_{{$sprint->id}}" value="{{$sprint->course}}">
	                    <a style="cursor:pointer;" class="list-group-dishes-item sprint-edit" data-key="{{$sprint->id}}">
	                    {{$sprint->name}}
	                    </a>
					</td>
					<td>{{ $sprint->level}}</td>
                    <td>{{ $sprint->fluency_rate}}</td>
                    <td>{{count(explode(',', $sprint->cards))}}</td>                   
                    <td class="table-action">
                      <a style="cursor:pointer;" class="sprint-edit" data-key="{{$sprint->id}}"><i class="fa fa-pencil"></i></a>
                      <a href="#" onclick="doDelete('{{$sprint->id}}')" class="delete-row{{$sprint->id}}"><i class="fa fa-trash-o"></i></a>
                    </td>
                 </tr>
                @endforeach                 
              </tbody>
          </table>
      </div>
	 {{ Form::close() }}
	 {{Form::open(array('url' => 'admin_sprintEdit', 'method' => 'post', 'id' => 'sprintEditForm'))}} 
	    <input type="hidden" id="sprint" name="sprint">
	    <input type="hidden" name="course" id="course_id">
	 {{ Form::close() }}
  </div>
</div>
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
		// Chosen Select
		jQuery(".chosen-select").chosen({'width':'500px','white-space':'nowrap'});
		FormValidation.init();

		$('.dataTable').dataTable({
			"sPaginationType": "full_numbers"
		});
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

	$( '.sprint-edit' ).on('click', function(event) {
		var data_key = $(this).attr('data-key');
		jQuery('#sprint').val(data_key);
		jQuery('#course_id').val($('#course_' + data_key).val());		
		$('#sprintEditForm').submit();
	});

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