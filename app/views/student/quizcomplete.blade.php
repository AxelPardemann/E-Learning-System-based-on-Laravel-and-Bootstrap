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
    <!-- headerbar -->
    <div class="contentpanel">      
      <div class="row">
        <div class="contentlist col-md-9">
          @if ($break == "")
          <div class="table-responsive col-md-12">
            <table class="table card-table quiz-result">
              <tbody>
                <tr>
                  <td>Sprint Title</td>
                  <td>{{$title}}</td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>{{date('m-d')}}</td>
                </tr>
                <tr>
                  <td>Correct Cards</td>
                  <td>{{$correct}}</td>
                </tr>
                <tr>
                  <td>Incorrect Cards</td>
                  <td>{{$incorrect}}</td>
                </tr>
                <tr>
                  <td>Fluency Rate</td>
                  <td>{{$speed}}</td>
                </tr>
                <tr>
                  <td>Target Fluency Rate</td>
                  <td>{{$target}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          @else
          <div class="last-play">
            <span class="fa fa-check-square-o"></span><br />
            <span class="label">Great Job!</span><br /><br />
            <span>{{$correct}} correct in {{$interval}} seconds</span><br /><br />
            <span>
              This is {{date('m-d')}}&nbsp;|&nbsp;
              "{{$course}}" Course&nbsp;|&nbsp;
              "{{$title}}" Sprint
            </span><br /><br />
            <a>Continue</a>
          </div>
          @endif
          {{Form::open(array('url' => 'student_resume', 'id' => 'form', 'method' => 'post'))}}
            <input type="hidden" name="school" value="{{$school}}" />
            <input type="hidden" name="id" value="{{$sprint_id}}" />
            <input type="hidden" name="last_id" value="{{$last_id}}" />
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
{{HTML::script('assets/js/jquery.datatables.min.js')}}

{{HTML::script('assets/js/custom.js')}}
@endsection

@section('javaScript')

<script>
jQuery(document).ready(function() {     
  $( '#mainbody' ).addClass('horizontal-menu');

  $('.last-play a').click(function() {
    $('#form').submit();
  });
});
</script>

@endsection