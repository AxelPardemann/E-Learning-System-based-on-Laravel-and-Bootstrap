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
    
    <div class="contentpanel school-panel">
      
      <div class="row">
        @if ($last == null)
          <!-- <div class="last-no-play">
            No Last Card
          </div> -->
        @else
          <div class="last-play">
            {{Form::open(array('url' => 'student_resume', 'id' => 'form', 'method' => 'post', 'autocomplete' => 'off'))}} 
              <input type="hidden" id="id" name="id" value="{{$sprint->id}}">
              <input type="hidden" id="school" name="school" value="{{$last->school}}">
              <input type="hidden" id="last_id" name="last_id" value="{{$last_id}}">
              <a>Continue {{$sprint->name}}</a>
            {{ Form::close() }}
          </div>
        @endif
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

  $('.last-play').click(function() {
    $(this).find('a').click();
  });

  $('.last-play a').click(function() {
    $('#form').submit();
  });
});
</script>

@endsection