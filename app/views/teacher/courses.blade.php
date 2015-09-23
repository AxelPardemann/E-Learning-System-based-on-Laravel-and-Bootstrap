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

    <div class="pageheader">
      <h2>You are in "{{$school_name}}" School</h2>
    </div>
       
    <div class="contentpanel">
      <div class="row">
        <div class="contentlist col-md-10">
          <div class="table-responsive">
            <div class="panel-body search-course">   
              {{Form::open(array('url' => 'teacher_courseInclude', 'method' => 'post', 'class' => 'form'))}}
              <input type="hidden" id="course_id" name="course_id">
              <input type="hidden" id="classes" name="classes">
              <table class="table dataTable" aria-describedby="table2_info" id="table2">
                <thead>
                   <tr role="row">
                    <th class="col-md-3">Course Name</th>
                    <th>Description</th>
                    <th class="col-md-2">Classes</th>
                    <th class="col-md-2"></th>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                  @foreach ($other_courses as $other_course)
                    <tr>
                      <td>
                        {{$other_course->name}}
                      </td>
                      <td>
                        {{$other_course->description}}
                      </td>
                      <td style="width: 30%;">
                        <select class="chosen-select"  multiple="multiple" 
                        data-placeholder="Choose a Classes..." required>
                          <option value=""></option>
                          @foreach($classes as $class)
                          <option value="{{$class->class}}">{{$class_name[$class->class]}}</option>
                          @endforeach                
                        </select>
                        <span for="classes" class="help-block"></span>
                      </td>
                      <td style="width: 15%;">
                        <input type="hidden" value="{{$other_course->id}}">
                        <a class="btn btn-success btn-sm add-course">
                          Add Course to My School
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ Form::close() }}
              <div class="form-group">
                <div class="col-sm-6">
                  {{Form::open(array('url' => 'teacher_courseAdd', 'method' => 'post', 'class' => 'form'))}}
                  <a class="btn btn-success btn-sm btn-course">
                    Create a New Course
                  </a>
                  <input type="hidden" name="school_id" value="{{$school_id}}">
                  {{ Form::close() }}
                </div>
              </div>
            </div>

            {{Form::open(array('id' => 'form', 'method' => 'post', 'autocomplete' => 'off'))}} 
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="school" name="school" value="">
            <input type="hidden" id="last_id" name="last_id" value="">
            <input type="hidden" id="reply_flag" name="reply_flag" value="0">

            <div class="panel-group" id="accordion">
            @foreach ($courses as $course)
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$course->course}}">
                      <span class="glyphicon glyphicon-plus"></span>&nbsp;{{$course_name[$course->course]}}
                    </a>
                  </h4>
                  <input type="hidden" class="courseID" value="{{$course->course}}" />
                </div>
                <div id="collapse-{{$course->course}}" class="panel-collapse collapse">
                  <div class="panel-body">   
                    <div class="form-group">
                      <div class="col-sm-6">
                        {{Form::open(array('url' => 'teacher_sprintAdd', 'method' => 'post', 'class' => 'form', 'autocomplete' => 'off'))}} 
                        <input type="hidden" name="course" value="{{$course->course}}">
                        <a class="btn btn-success btn-sm btn-sprint">
                          <i class="fa fa-plus"></i>&nbsp;Add New Sprint
                        </a>
                        {{ Form::close() }}
                      </div>
                    </div>           
                  </div>
                  <div class="panel-body">
                    <table class="table dataTable" aria-describedby="table2_info">
                      <thead>
                         <tr role="row">
                          <th class="col-md-3">Level</th>
                          <th class="col-md-3">Sprint Name</th>
                          <th>Fluency Rate</th>
                          <th>Card Count</th>
                          <th>Publish</th>
                          <th class="col-md-2"></th>
                      </thead>
                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach ($sprints as $sprint)
                          @if ($sprint->course == $course->course)
                          <tr>
                            <td>
                              <input type="hidden" class="course_val" value="{{$course->course}}">
                              <input type="hidden" id="school_{{$sprint->id}}" value="{{$school_id}}">
                              <input type="hidden" value="{{$sprint->id}}">
                              {{$sprint->level}}
                            </td>
                            <td>
                              <a style="cursor:pointer;" class="list-group-dishes-item sprint-edit" data-key="{{$sprint->id}}">
                              {{$sprint->name}}
                              </a>
                            </td>
                            <td>{{$sprint->fluency_rate}}</td>
                            <td>
                              <?php $cards = explode(',', $sprint->cards); ?>
                              @if (count($cards) == 1 && $cards[0] == "")
                                <span>No Cards</span>
                              @else
                                {{count($cards)}}
                              @endif
                            </td>                            
                            <td>
                              <div class="control-label">
                                <div class="toggle toggle-success"></div>
                              </div>
                            </td>
                            <td>
                              @if (count($cards) == 1 && $cards[0] == "")
                                <span>No Cards</span>
                              @else
                                <input type="hidden" value="{{$sprint->id}}" />
                                <button type="buttton" class="btn btn-white play_sprint">
                                  <span class="fa fa-play"></span>
                                </button>
                              @endif
                              &nbsp;&nbsp;
                              <a href="#" onclick="deleteSprint('{{$sprint->id}}')" class="sprint-row{{$sprint->id}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                          </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
            {{ Form::close() }}
          </div>
        </div>
        {{Form::open(array('url' => 'teacher/course/delete', 'method' => 'post', 'id' => 'courseForm'))}}
          <input type="hidden" name="id" id="del_course_id">
          <input type="hidden" name="userID" id="userID" value="{{$user->id}}">
        {{ Form::close() }}
        {{Form::open(array('url' => 'sprint/delete', 'method' => 'post', 'id' => 'sprintForm'))}}
          <input type="hidden" name="sprint_id" id="sprint_id">
        {{ Form::close() }}
        {{Form::open(array('url' => 'teacher_sprintEdit', 'method' => 'post', 'id' => 'sprintEditForm'))}} 
          <input type="hidden" id="sprint" name="sprint">
          <input type="hidden" id="course" name="course">
        {{ Form::close() }}
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

    $(".chosen-select").chosen({'width':'400px','white-space':'nowrap'});

    $('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });

    $('#table2_wrapper').append('<div class="close-button"></div>');
    
    $('#table2_filter input[type=text]').click(function() {
      $('#form').hide();
      $('#table2').fadeIn("slow");
      $('.close-button').fadeIn("slow");
    });

    $('.close-button').click(function() {
      $('#table2').hide();
      $(this).hide();
      $('#form').fadeIn("slow");
    });

    // Chosen Select
    $("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });

    $('.panel .panel-collapse .table').each(function() {
      var appendTxt = '<div class="play-area">';

      if ($(this).find('tbody tr').length == 1) {
        appendTxt += $(this).find('tbody tr td:last-child').html();
      } else {
        var flag = false;
        $(this).find('tbody tr').each(function() {
          if (!flag && $.trim($(this).find('td:last-child').html()) != "<span>No Cards</span>") {
            appendTxt += $(this).find('td:last-child').html();
            flag = true;
          }
        });

        if (!flag) {
          if ($.trim($(this).find('td:last-child').html()) != "<span>No Cards</span>")
            appendTxt += "<span>No Cards</span>";
          else
            appendTxt += $(this).find('tbody tr td:last-child').html();
        }
      }

      appendTxt += '</div>';
      appendTxt += '<div class="delete-course">';
      var id = $(this).closest('.panel-collapse').prev().find('.courseID').val();
      appendTxt += '<a href="#" onclick="deleteCourse(' + id + ')"><i class="fa fa-trash-o"></i></a></div>';

      $(this).closest('.panel-collapse').prev().append(appendTxt);
    });

    $( '.btn-course' ).on('click', function(event){
      $(this).parent().submit();
    });

    $( '.add-course' ).on('click', function(event){
      var class_name = new Array();
      var i = 0;
      $(this).parent().prev().find('.chosen-results').find('li').each(function() {
        if ($(this).hasClass('result-selected')) {
          class_name[i] = $(this).text();
          i++;
        }
      });
      var classes = '';
      if (class_name[0] == undefined) {
        alert("Please select 1 class at least...");
      } else {
        for (var j = 0; j < i; j++) {
          $(this).parent().prev().find('.chosen-select').find('option').each(function() {
            if ($(this).text() == class_name[j])
              classes += $(this).val() + ',';
          });
        }

        $('#course_id').val($(this).prev().val());
        $('#classes').val(classes);
        $('#table2').parent().parent().submit();
      }
    });

    $( '.btn-sprint' ).on('click', function(event){
      $(this).parent().submit();
    });

    $( '.sprint-edit' ).on('click', function(event){
      $('#sprint').val($(this).attr('data-key'));
      $('#course').val($(this).parent().prev().find('.course_val').val());
      $('#sprintEditForm').submit();
    });

    $('.play_sprint').click(function() {
      var sprint = $(this).prev().val();
      var school = $('#school_' + sprint).val();

      $('#id').val(sprint);
      $('#school').val(school);

      $('#form').attr('action', '../../teacher_sprint').submit();
    });

    $('.panel-heading').click(function() {
      var obj = $(this).find('.glyphicon');
      if (obj.hasClass('glyphicon-plus')) {
        obj.removeClass('glyphicon-plus');
        $('.glyphicon').each(function() {
          if ($(this).hasClass('glyphicon-minus')) {
            $(this).removeClass('glyphicon-minus');
            $(this).addClass('glyphicon-plus');
          }
        });
        obj.addClass('glyphicon-minus');
      } else {
        obj.removeClass('glyphicon-minus');
        $('.glyphicon').each(function() {
          if ($(obj).hasClass('glyphicon-plus')) {
            $(this).removeClass('glyphicon-plus');
            $(this).addClass('glyphicon-minus');
          }
        });
        obj.addClass('glyphicon-plus');
      }
    });
  }); 

  // Delete course
  function deleteCourse(id) {
    $.confirm({
      'title'   : 'Delete Confirmation',
      'message' : 'Do you really want to delete selected course?',
      'buttons' : {
        'Yes' : {
          'class' : 'blue',
          'action': function(){
            $('#del_course_id').val(id);
            $('#courseForm').submit();
          }
        },
        'No'  : {
          'class' : 'gray',
          'action': function(){}  // Nothing to do in this case. You can as well omit the action property.
        }
      }
    }); 
  }

  // Delete Sprint
  var responseOptions = {
    success:  showResponse,
    dataType: 'json' 
  };

  function showResponse(response, statusText, xhr, $form)  {
    if (response.status == true) {
      $row = jQuery('.sprint-row' + response.idx);      
        $row.closest('tr').fadeOut(function(){
        $row.remove();
      });
    } else {
      alert(response.message);
    }
  }

  function deleteSprint(id) {
    $.confirm({
      'title'   : 'Delete Confirmation',
      'message' : 'Do you really want to delete selected sprint?',
      'buttons' : {
        'Yes' : {
          'class' : 'blue',
          'action': function(){   
            $('#sprint_id').val(id);
            $('#sprintForm').ajaxForm(responseOptions).submit();
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