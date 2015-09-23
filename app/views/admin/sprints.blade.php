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
  <h2><i class="fa fa-th-list"></i> Sprint <span>All sprints</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">All sprints</li>
    </ol>
  </div>
</div>
<div class="contentpanel">
	<div class="row">
	  {{Form::open(array('url' => 'sprint/delete', 'method' => 'post', 'class' => 'form', 'id' => 'sprintForm', 'autocomplete' => 'off'))}} 
	  <input type="hidden" name="id" id="id">
      <div class="table-responsive">
          <table class="table" id="class_table2">
              <thead>
                 <tr>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Fluency rate</th>                    
                    <th>Cards</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($sprints as $sprint)
                 <tr class="odd gradeX">
                    <td>{{ $sprint->coursename}}</td>
                    <td>
                    	<input type="hidden" id="course_{{$sprint->id}}" value="{{$sprint->courseid}}">
	                    <a style="cursor:pointer;" class="list-group-dishes-item sprint-edit" data-key="{{$sprint->id}}">
	                    {{$sprint->name}}
	                    </a>
					</td>
                    <td>{{ $sprint->fluency_rate}}</td>
                    <td>
                    	@if (count(explode(',', $sprint->cards)) > 1)
                    		{{count(explode(',', $sprint->cards))}}
                    	@elseif (count(explode(',', $sprint->cards)) == 1)
                    		<?php $cards = explode(',', $sprint->cards);?>
                    		@if ($cards[0] == "")
                    			No Cards
                    		@else
                    			{{count(explode(',', $sprint->cards))}}
                    		@endif
                    	@else
                    		No Cards
                    	@endif
                    </td>
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

@section('pageLevelPlugins')
<!-- BEGIN CONFIRM DIALOG -->
{{ HTML::script('assets/js/jquery.form.min.js') }}
{{ HTML::script('assets/js/jquery.confirm/jquery.confirm.js') }}
{{ HTML::script('assets/js/script.js') }}
<!-- END CONFIRM DIALOG -->
@endsection

@section('javaScript')
<script>
	$( '.sprint-edit' ).on('click', function(event) {
		var data_key = $(this).attr('data-key');
		jQuery('#sprint').val(data_key);
		jQuery('#course_id').val($('#course_' + data_key).val());		
		$('#sprintEditForm').submit();
	});

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
			'message'	: 'Do you really want to delete selected sprint?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){		
						jQuery('#id').val(id);
						$( '#sprintForm' ).ajaxForm(options).submit();						
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