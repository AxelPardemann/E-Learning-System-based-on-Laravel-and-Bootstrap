@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
{{HTML::style('assets/css/jquery.tagsinput.css')}}
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-user"></i> Add New Class <span></span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">Add Class</li>
    </ol>
  </div>
</div>
<div class="contentpanel">
	<div class="row">
		<div class="panel-body panel-body-nopadding">		              
		  <!-- BASIC WIZARD -->
		  <div id="validationWizard" class="basic-wizard">
		    
		    <ul class="nav nav-pills nav-justified">
		      <li><a href="#vtab1" data-toggle="tab"><span>Step 1:</span> Basic Information</a></li>
		      <li><a href="#vtab2" data-toggle="tab"><span>Step 2:</span> Students</a></li>
		    </ul>
		    {{Form::open(array('url' => 'class/add', 'method' => 'post', 'class' => 'form', 'id' => 'firstForm', 'autocomplete' => 'off'))}}  
		    <div class="tab-content">
		      
		      <div class="tab-pane" id="vtab1">
		          <div class="form-group">
		            <label class="col-sm-4 control-label" style="width:10%">Name</label>
		            <div class="col-sm-8" style="width:90%">
		              <input type="text" name="classname" class="form-control" required />
		            </div>
		          </div>
		          
		          <div class="form-group">
		            <label class="col-sm-4 control-label" style="width:10%">Overview</label>
		            <div class="col-sm-8" style="width:90%">
		              <textarea class="form-control" rows="5" style="margin-top: 0px; margin-bottom: 0px;" name="overview"></textarea>
		            </div>
		          </div>		          
		      </div>
		      <div class="tab-pane" id="vtab2">	          
		          <div class="form-group">		            
		            <div class="col-sm-12">
		              <table class="table" id="student_table2">
			              <thead>
			                 <tr>
			                    <th></th>
			                    <th>Name</th>
			                    <th>Email</th>
			                    <th>Birthday</th>
			                    <th>Location</th>
			                 </tr>
			              </thead>
			              <tbody>
			              	@if(isset($students))
				                @foreach ($students as $student)
				                 <tr class="odd gradeX">
				                    <td><div class="ckbox ckbox-default">
				                          <input type="checkbox" value="1" id="schk_{{ $student->id}}" name="schk_{{ $student->id}}">
				                          <label for="schk_{{ $student->id}}"></label>                        
				                        </div>
				                    </td>
				                    <td>{{ $student->first}} {{ $student->last}}</td>
				                    <td>{{ $student->email}}</td>
				                    <td>{{ $student->birthday}}</td>
				                    <td class="center"> {{ $student->country}}</td>				                    
				                 </tr>
				                @endforeach
			                @endif                 
			              </tbody>
			          </table>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="col-sm-11 control-label"></label>
		            <div class="col-sm-1">
		              <button class="btn btn-primary">Save</button>
		            </div>
		          </div>		          
		      </div>		      
		    </div><!-- tab-content -->		    
		    <ul class="pager wizard">
		        <li class="previous"><a href="javascript:void(0)">Previous</a></li>
		        <li class="next"><a href="javascript:void(0)">Next</a></li>
		    </ul>
		    {{ Form::close() }}
		  </div><!-- #validationWizard -->
		  
		</div><!-- panel-body -->
	</div>
</div>
@endsection
@section('pageLevelScripts')
{{HTML::script('assets/js/bootstrap-wizard.min.js')}}
@endsection
@section('javaScript')
<script>
jQuery(document).ready(function() {
	  jQuery('#student_table2').dataTable({
	      "sPaginationType": "full_numbers"
	  });
		  // Chosen Select
	  jQuery("select").chosen({
	      'min-width': '100px',
	      'white-space': 'nowrap',
	      disable_search_threshold: 10
	  });
	    
	  // With Form Validation Wizard
	  var $validator = jQuery("#firstForm").validate({
	    highlight: function(element) {
	      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	    success: function(element) {
	      jQuery(element).closest('.form-group').removeClass('has-error');
	    }
	  });
	  
	  jQuery('#validationWizard').bootstrapWizard({
	    tabClass: 'nav nav-pills nav-justified nav-disabled-click',
	    onTabClick: function(tab, navigation, index) {
	      return false;
	    },
	    onNext: function(tab, navigation, index) {
	      var $valid = jQuery('#firstForm').valid();
	      if(!$valid) {
	        
	        $validator.focusInvalid();
	        return false;
	      }
	    }
	  });
});
</script>
@endsection