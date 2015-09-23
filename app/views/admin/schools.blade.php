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
  <h2><i class="fa fa-building"></i> Schools <span>All schools</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">All schools</li>
    </ol>
  </div>
</div>
<div class="contentpanel">
	<div class="row">
	  {{Form::open(array('url' => 'school/delete', 'method' => 'post', 'class' => 'form', 'id' => 'schoolForm', 'autocomplete' => 'off'))}} 
      <input type="hidden" name="id" id="id">
      <div class="table-responsive">
          <table class="table" id="class_table2">
              <thead>
                 <tr>
                    <th>Name</th>
					<th>Address</th>
                    <th>Classes</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($schools as $school)
                 <tr class="odd gradeX">
                    <td>
						<a href="{{ URL::route("admin/schoolEdit", $school->id) }}" class="list-group-dishes-item">
                        {{ $school->name}}
						</a>
					</td>
                    <td>{{ $school->address}}</td>
                    <td></td>
                    <td class="table-action">
                      <a href="{{ URL::route("admin/schoolEdit", $school->id) }}"><i class="fa fa-pencil"></i></a>
                      <a href="#" onclick="doDelete('{{$school->id}}')" class="delete-row{{$school->id}}"><i class="fa fa-trash-o"></i></a>
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
			'message'	: 'Do you really want to delete selected school?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){		

						jQuery('#id').val(id);
						$( '#schoolForm' ).ajaxForm(options).submit();						
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