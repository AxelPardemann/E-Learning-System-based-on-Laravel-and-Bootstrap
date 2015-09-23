@extends('layouts.default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
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
      <div class="table-responsive">
          <table class="table" id="user_table2">
              <thead>
                 <tr>
                    <th style="background:none;"></th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Last Sprint Date</th>
                    <th>Fluency Rate</th>
                    <th>Interval</th>
                 </tr>
              </thead>
              <tbody>
                @for ($i = 0; $i < sizeof($students); $i++)
                 <tr class="odd gradeX">
                    <td></td>
                    <td>
                      <a href="{{ URL::route("teacher/progress", array('user'=>$students[$i]['user_id'], 'school'=>$students[$i]['school_id'])) }}" class="list-group-dishes-item">
                        {{ $students[$i]['first']}} {{ $students[$i]['last']}}
                      </a>
                    </td>
                    <td>{{ $students[$i]['name']}}</td>
                    <td>{{ $students[$i]['last_date']}}</td>
                    <td>{{ $students[$i]['rate']}}</td>
                    <td>
                      <input type="hidden" value="{{$students[$i]['user_id']}}" />
                      <select>
                        @for ($j = 15; $j <= 600; $j += 15)
                          @if ($j % 60 == 0)
                            <option value="{{$j}}" <?php if ($j == $students[$i]['interval']) {?>selected<?php }?>>
                              {{$j / 60}}min
                            </option>
                          @else
                            @if (ceil($j / 60) == 1)
                              <option value="{{$j}}" <?php if ($j == $students[$i]['interval']) {?>selected<?php }?>>
                                {{$j % 60}}sec
                              </option>
                            @else
                              <option value="{{$j}}" <?php if ($j == $students[$i]['interval']) {?>selected<?php }?>>
                                {{ceil($j / 60) - 1}}min {{$j % 60}}sec
                              </option>
                            @endif
                          @endif
                        @endfor
                      </select>
                    </td>
                 </tr>
                @endfor
              </tbody>
          </table>
          {{Form::open(array('url' => 'user/interval', 'id' => 'userform', 'method' => 'post'))}}
            <input type="hidden" id="user" name="user" value="" />
            <input type="hidden" id="interval" name="interval" value="" />
          {{Form::close()}}
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
{{HTML::script('assets/js/custom.js')}}
@endsection

@section('javaScript')

<script>
jQuery(document).ready(function() {     
	$( '#mainbody' ).addClass('horizontal-menu');

  $('td select').change(function() {
    $('#user').val($(this).prev().val());
    $('#interval').val($(this).val());
    
    $('#userform').submit();
  });
});
</script>

@endsection