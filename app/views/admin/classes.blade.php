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
  <h2><i class="fa fa-suitcase"></i> Classes <span>All classes</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">All classes</li>
    </ol>
  </div>
</div>
<div class="contentpanel">
	<div class="row">
	  {{Form::open(array('url' => 'class/delete', 'method' => 'post', 'class' => 'form', 'id' => 'classForm', 'autocomplete' => 'off'))}} 
	  <input type="hidden" name="id" id="id">
      <div class="table-responsive">
          <table class="table" id="class_table2">
              <thead>
                 <tr>
                    <th style="background:none;"></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Students</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($classes as $class)
                 <tr class="odd gradeX">
                    <td>
						<div class="ckbox ckbox-default">
                          <input type="checkbox" value="1" id="chk_{{ $class->id}}">
                          <label for="chk_{{ $class->id}}"></label>                        
                        </div>
                    </td>
                    <td>
						<a href="{{ URL::route("admin/classEdit", $class->id) }}" class="list-group-dishes-item">
                        {{ $class->name}}
						</a>
					</td>
                    <td>{{ $class->description}}</td>
                    <td>{{count(DB::table('classstudent')->where('class', $class->id)->groupby('user')->get())}}</td>
                    <td class="table-action">
                      <a href="{{ URL::route("admin/classEdit", $class->id) }}"><i class="fa fa-pencil"></i></a>
                      <a href="#" onclick="doDelete('{{$class->id}}')" class="delete-row{{$class->id}}"><i class="fa fa-trash-o"></i></a>
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
			'message'	: 'Do you really want to delete selected class?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){		
						jQuery('#id').val(id);
						$( '#classForm' ).ajaxForm(options).submit();						
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