@extends('layouts.default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
@endsection

@section('pageContainer')  
  <div class="mainpanel">
    <!-- headerbar -->
    @section('headerbar')
      @include('student.student_nav')
    @endsection
       
    <div class="contentpanel">      
      <div class="row">
        <div class="contentlist col-md-10">
          <div class="table-responsive">
            {{Form::open(array('id' => 'form', 'method' => 'post', 'autocomplete' => 'off'))}} 
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="school" name="school" value="">
            <input type="hidden" id="last_id" name="last_id" value="">
            <input type="hidden" id="reply_flag" name="reply_flag" value="0">

            <div class="panel-group" id="accordion">
            <?php 
              $course = array(); 
              $i = 0;
              $course[0] ='';
            ?>
            @foreach ($sprints as $sprint)
              <?php
                $flag = true;
                for ($j = 0; $j < $i; $j++)
                  if ($course[$j] == $course_name[$sprint->school . '-' . $sprint->id])
                    $flag = false;
              ?>
              @if ($flag)
              <?php 
                $course[$i] = $course_name[$sprint->school . '-' . $sprint->id];
                $i++;
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$sprint->id}}">
                      <span class="glyphicon glyphicon-plus"></span>&nbsp;{{$course[$i - 1]}}
                    </a>
                  </h4>
                </div>
                <div id="collapse-{{$sprint->id}}" class="panel-collapse collapse">
                  <div class="panel-body">
                    <table class="table dataTable" aria-describedby="table2_info">
                      <thead>
                         <tr role="row">
                          <th class="col-md-3">School Name</th>
                          <th class="col-md-3">Sprint Name</th>
                          <th class="col-md-2">Level</th>
                          <th class="col-md-2">Mastered Cards</th>
                          <th>Cards</th>
                          <th>Status</th>
                          <th class="col-md-2"></th>
                        </tr>
                      </thead>
                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach ($sprints as $sprint)
                          @if ($course[$i - 1] == $course_name[$sprint->school . '-' . $sprint->id])
                          <tr>
                            <td>
                              {{$sprint->schoolName}}
                            </td>
                            <td>
                              <input type="hidden" value="{{$sprint->id}}">
                              <a class="submit_sprint">{{$sprint->name}}</a>
                            </td>
                            <td>
                              {{$sprint->level}}
                            </td>
                            <td>
                              <?php $mastered = explode(',', $masteredCards[$sprint->school . '-' . $sprint->id]); ?>
                              @if (count($mastered) == 1 && $mastered[0] == "")
                                <span>No Cards</span>
                              @else
                                {{count($mastered)}}
                              @endif
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
                              {{$status[$sprint->school . '-' . $sprint->id]}}
                            </td>
                            <td>
                              @if ($play_status[$sprint->school . '-' . $sprint->id])
                                @if (count($cards) == 1 && $cards[0] == "")
                                  <span>No Cards</span>
                                @else
                                  <input type="hidden" value="{{$sprint->school}}">
                                  <input type="hidden" value="{{$sprint->id}}" />
                                  @if ($last_id[$sprint->school . '-' . $sprint->id] == '')
                                    <button type="buttton" class="btn btn-white play_sprint">
                                      <span class="fa fa-play"></span>
                                    </button>
                                  @else
                                    <input type="hidden" value="{{$last_id[$sprint->school . '-' . $sprint->id]}}" />
                                    <button type="buttton" class="btn btn-white resume_sprint">
                                      <span class="fa fa-play"></span>
                                    </button>
                                  @endif
                                @endif
                              @else
                                <span>No active Cards</span>
                              @endif
                            </td>
                          </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endif
            @endforeach
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div><!-- row -->       
    </div><!-- contentpanel -->    
  </div><!-- mainpanel -->  
  
@endsection

@section('pageLevelPlugins')
{{HTML::script('assets/js/retina.min.js')}}
{{HTML::script('assets/js/jquery.cookies.js')}}

{{HTML::script('assets/js/jquery.sparkline.min.js')}}
{{HTML::script('assets/js/toggles.min.js')}}
{{HTML::script('assets/js/jquery.datatables.min.js')}}

{{HTML::script('assets/js/custom.js')}}
@endsection

@section('javaScript')

<script>
jQuery(document).ready(function() {     
	$( '#mainbody' ).addClass('horizontal-menu');

  $('.dataTable').dataTable({
    "sPaginationType": "full_numbers"
  });

  $('.table th:last-child').removeClass('sorting');
  
  // Chosen Select
  $('select').chosen({
    'min-width': '100px',
    'white-space': 'nowrap',
    disable_search_threshold: 10
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

  $('.panel .panel-collapse .table').each(function() {
    var appendTxt = '<div class="play-area">';

    if ($(this).find('tbody tr').length == 1) {
      appendTxt += $(this).find('tbody tr td:last-child').html();
    } else {
      var flag = false;
      $(this).find('tbody tr').each(function() {
        if (!flag && $.trim($(this).find('td:last-child').html()) != "<span>No active Cards</span>") {
          appendTxt += $(this).find('td:last-child').html();
          flag = true;
        }
      });

      if (!flag) {
        appendTxt += $(this).find('tbody tr td:last-child').html();
      }
    }

    appendTxt += '</div>';

    $(this).closest('.panel-collapse').prev().append(appendTxt);
  });

  $('.submit_sprint').click(function() {
    $('#id').val($(this).prev().val());
    $('#form').attr('action', 'student_card').submit();
  });

  $('.play_sprint').click(function() {
    var sprint = $(this).prev().val();
    var school = $(this).prev().prev().val();

    $('#id').val(sprint);
    $('#school').val(school);

    $('#form').attr('action', 'student_quiz').submit();
  });

  $('.resume_sprint').click(function() {
    var last_id = $(this).prev().val();
    var sprint = $(this).prev().prev().val();
    var school = $(this).prev().prev().prev().val();

    $('#id').val(sprint);
    $('#school').val(school);
    $('#last_id').val(last_id);

    $('#form').attr('action', 'student_resume').submit();
  });
});

</script>

@endsection