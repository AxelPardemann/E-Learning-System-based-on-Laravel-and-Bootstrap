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
  <h2><i class="fa fa-user"></i> Users <span>All users</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li class="active">All users</li>
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
	<div class="row">
      {{Form::open(array('url' => 'user/delete', 'method' => 'post', 'class' => 'form', 'id' => 'userForm', 'autocomplete' => 'off'))}} 
      <input type="hidden" name="id" id="id">    
      <div class="table-responsive">
          <table class="table" id="user_table2">
              <thead>
                 <tr>
                    <th style="background:none;"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Permission</th>
                    <th>Published</th>
                    <th></th>
                 </tr>
              </thead>
              <tbody>
                @foreach ($users as $userinfo)
                 <tr class="odd gradeX">
                    <td><div class="ckbox ckbox-default">
                          <input type="checkbox" value="1" id="chk_{{ $userinfo->id}}">
                          <label for="chk_{{ $userinfo->id}}"></label>                        
                        </div>
                    </td>
                    <td><a href="{{ URL::route("admin/edituser", $userinfo->id) }}" class="list-group-dishes-item">
                        {{ $userinfo->first}} {{ $userinfo->last}}
                    </a></td>
                    <td>{{ $userinfo->email}}</td>
                    <td>{{ $userinfo->country}}</td>
                    <td class="center"> {{ $userinfo->permission}}</td>
                    <td class="center">@if($userinfo->published == 1) Yes @else No @endif</td>
                    <td class="table-action">
                      <a href="{{ URL::route("admin/edituser", $userinfo->id) }}"><i class="fa fa-pencil"></i></a>
                      <a href="#" onclick="doDelete('{{$userinfo->id}}')" class="delete-row{{$userinfo->id}}"><i class="fa fa-trash-o"></i></a>
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
    success:  showResponse,
    dataType: 'json' 
  };

  function showResponse(response, statusText, xhr, $form)  {
    if (response.status == true) {
      $row = jQuery('.delete-row' + response.idx);
      alert(response.message);
      $row.closest('tr').fadeOut(function(){
        $row.remove();
      });
    } else {
      alert(response.message);
    }
  }

  function doDelete(id) {
    $.confirm({
      'title'   : 'Delete Confirmation',
      'message' : 'Do you really want to delete selected user?',
      'buttons' : {
        'Yes' : {
          'class' : 'blue',
          'action': function(){   
            jQuery('#id').val(id);
            $( '#userForm' ).ajaxForm(options).submit();           
          }
        },
        'No'  : {
          'class' : 'gray',
          'action': function(){}  // Nothing to do in this case. You can as well omit the action property.
        }
      }
    }); 
  }

jQuery(document).ready(function() {       
   jQuery('#user_table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });

    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
});
</script>

@endsection