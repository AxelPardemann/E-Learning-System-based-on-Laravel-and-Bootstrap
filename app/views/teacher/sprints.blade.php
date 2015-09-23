@extends('layouts.default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}

<!-- BEGIN CONFIRM DIALOG -->
{{HTML::style('assets/css/styles.css')}}
{{HTML::style('assets/js/jquery.confirm/jquery.confirm.css')}}
<!-- END CONFIRM DIALOG -->

@endsection

@section('pageContainer')  
  <div class="mainpanel">
    <!-- headerbar -->
    @section('headerbar')
      @include('teacher.teacher_nav')
    @endsection
    <!-- headerbar -->
       
    <div class="contentpanel">
      <div class="row">
        <div class="contentlist col-md-9">
          <div class="panel-body">   
                <div class="form-group">
                  <div class="col-sm-6">
                    {{Form::open(array('url' => 'teacher_sprintAdd', 'method' => 'post', 'class' => 'form', 'id' => 'sprintAddForm', 'autocomplete' => 'off'))}} 
                    @if ($course > 0)
                    <input type="hidden" name="course" id="course" value="{{$course}}">
                    <a class="btn btn-success btn-sm btn-sprint">
                      <i class="fa fa-plus"></i>&nbsp;Add New Sprint
                    </a>
                    @else 
                    <a class="btn btn-success btn-sm btn-sprint">
                      <i class="fa fa-plus"></i>&nbsp;Add New Sprint
                    </a>
                    @endif
                    {{ Form::close() }}
                  </div>
                </div>           
          </div>
          {{Form::open(array('url' => 'sprint/delete', 'method' => 'post', 'class' => 'form', 'id' => 'sprintForm', 'autocomplete' => 'off'))}} 
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="course" id="course" value="{{$course}}">
          <div class="table-responsive">
            <table class="table" id="table2">
              <thead>
                 <tr role="row">
                  <th>Sprint Name</th>
                  <th>Card Count</th>
                  <th>Publish</th>
                  <th></th>                  
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php $i = 0; ?>
                @foreach ($sprints as $sprint)
                <tr>
                  <td>
                    <a style="cursor:pointer;" class="list-group-dishes-item sprint-edit" data-key="{{$sprint->id}}">
                    {{$sprint->name}}
                    </a>                   
                  </td>
                  <td>
                    <?php $cards = explode(',', $sprint->cards); ?>
                    @if (count($cards) == 1 && $cards[0] == "")
                      <span>No Cards</span>
                    @else
                      {{count($cards)}}
                    @endif
                  </td>
                  <td>
                      <div align="center" class="control-label">
                        <div class="toggle toggle-success"></div>
                      </div>
                  </td>                                 
                  <td class="table-action"> 
                  <!--       
                  @if ($course > 0)            
                    <a style="cursor:pointer;" class="sprint-edit" data-key="{{$sprint->id}}"><i class="fa fa-pencil"></i></a>
                  @else
                    <a href="{{ URL::route("teacher/sprintEdits", $sprint->id) }}"><i class="fa fa-pencil"></i></a>
                  @endif
                  -->
                    <a style="cursor:pointer;" class="sprint-edit" data-key="{{$sprint->id}}"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="doDelete('{{$sprint->id}}')" class="delete-row{{$sprint->id}}"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>         
          </div>
          {{ Form::close() }}
          {{Form::open(array('url' => 'teacher_sprintEdit', 'method' => 'post', 'id' => 'sprintEditForm'))}} 
            <input type="hidden" id="sprint" name="sprint">
            <input type="hidden" name="course" id="course" value="{{$course}}">
          {{ Form::close() }}
        </div>
      </div><!-- row -->       
    </div><!-- contentpanel -->    
  </div><!-- mainpanel -->  
  
@endsection

@section('pageLevelPlugins')
{{HTML::script('assets/js/jquery.datatables.min.js')}}

<!-- BEGIN CONFIRM DIALOG -->
{{ HTML::script('assets/js/jquery.form.min.js') }}
{{ HTML::script('assets/js/jquery.confirm/jquery.confirm.js') }}
{{ HTML::script('assets/js/script.js') }}
<!-- END CONFIRM DIALOG -->

@endsection

@section('javaScript')

<script>
  jQuery(document).ready(function() {     
  	$( '#mainbody' ).addClass('horizontal-menu');

    $('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Chosen Select
    $("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
  });  

  $( '.btn-sprint' ).on('click', function(event){
    
      $('#sprintAddForm').submit();
  });

  $( '.sprint-edit' ).on('click', function(event){
      
      jQuery('#sprint').val($(this).attr('data-key'));
      $('#sprintEditForm').submit();
  });

  // Delete row in a table
  var options = {
    success:  showResponse,
    dataType: 'json' 
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
      'title'   : 'Delete Confirmation',
      'message' : 'Do you really want to delete selected sprint?',
      'buttons' : {
        'Yes' : {
          'class' : 'blue',
          'action': function(){   

            jQuery('#id').val(id);
            $( '#sprintForm' ).ajaxForm(options).submit();            
            //$( '#sprintForm' ).submit();
          }
        },
        'No'  : {
          'class' : 'gray',
          'action': function(){}  // Nothing to do in this case. You can as well omit the action property.
        }
      }
    }); 
  }
</script>

@endsection