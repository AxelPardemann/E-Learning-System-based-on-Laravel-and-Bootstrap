@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
{{HTML::style('assets/css/jquery.tagsinput.css')}}

<!-- BEGIN CONFIRM DIALOG -->
{{HTML::style('assets/css/styles.css')}}
{{HTML::style('assets/js/jquery.confirm/jquery.confirm.css')}}
<!-- END CONFIRM DIALOG -->
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-book"></i> Courses <span>All courses</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">All courses</li>
    </ol>
  </div>
</div>
<div class="contentpanel">
	<div class="row">
	  {{Form::open(array('url' => 'course/delete', 'method' => 'post', 'class' => 'form', 'id' => 'courseForm', 'autocomplete' => 'off'))}} 
	  <input type="hidden" name="id" id="id">
      <div class="table-responsive">
          <table class="table" id="class_table2">
              <thead>
                 <tr>
                    <th style="background:none;"></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Sprints</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($courses as $course)
                 <tr class="odd gradeX">
                    <td>
						<div class="ckbox ckbox-default">
                          <input type="checkbox" value="1" id="chk_{{ $course->id}}">
                          <label for="chk_{{ $course->id}}"></label>                        
                        </div>
                    </td>
                    <td>
						<a href="{{ URL::route("admin/courseEdit", $course->id) }}" class="list-group-dishes-item">
                        {{ $course->name}}
						</a>
					</td>
                    <td>{{ $course->description}}</td>
                    <td></td>
                    <td class="table-action">
                      <a href="{{ URL::route("admin/courseEdit", $course->id) }}"><i class="fa fa-pencil"></i></a>
                      <a href="#" onclick="doDelete('{{$course->id}}')" class="delete-row{{$course->id}}"><i class="fa fa-trash-o"></i></a>
                    </td>
                 </tr>
                @endforeach                 
              </tbody>
          </table>
      </div>
	 {{ Form::close() }}
  </div>      
</div>
@endsection

@section('pageLevelPlugins')
<!-- BEGIN CONFIRM DIALOG -->
{{ HTML::script('assets/js/jquery.form.min.js') }}
{{ HTML::script('assets/js/jquery.confirm/jquery.confirm.js') }}
{{ HTML::script('assets/js/script.js') }}
<!-- END CONFIRM DIALOG -->
@endsection

@section('javaScript')
<script>
	// Delete row in a table
	var options = {
		success:	showResponse,
		dataType:	'json' 
	};

	function showResponse(response, statusText, xhr, $form)  {
		
		if (response.status == true) {
			$row = jQuery('.delete-row' + response.idx);
			
			$row.closest('tr').fadeOut(function(){
				$row.remove();
			});
		} else {
			alert(response.message);
		}
	}

	function doDelete(id) {
		$.confirm({
			'title'		: 'Delete Confirmation',
			'message'	: 'Do you really want to delete selected course?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){		
						jQuery('#id').val(id);
						$( '#courseForm' ).ajaxForm(options).submit();						
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});	
	}
</script>

@endsection