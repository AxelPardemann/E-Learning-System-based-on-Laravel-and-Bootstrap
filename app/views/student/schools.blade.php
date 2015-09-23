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
    <div class="pageheader">
      <h2><i class="fa fa-home"></i> My School <span>{{$schoolInfo->name}}</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
          <ol class="breadcrumb">
            <li>{{Config::get('app.title')}}</li>
            <li class="active">{{$title}}</li>
          </ol>
      </div>
    </div>    
    <div class="contentpanel">      
      <div class="row">
          <div class="small left">
            <div class="mrnd">     
             <h2>Browse by School</h2>
             <ul class="largetext">
              @foreach($schools as $school)
                @if ($schoolInfo->id != $school->id)                 
                <li><a href="{{URL::route('students/school', $school->id)}}">{{ $school->name }}</a></li>
                @else
                <li>{{ $school->name }}</li>
                @endif
              @endforeach
            </ul>
            </div>  
          </div> 
          <div class="large left">
              <div class="mrnd">
                <h2>{{$schoolInfo->name}}</h2>

                @for ($i = 0; $i < 4; $i++)
                <div class="left small">
                  <?php $j = 0; ?>
                  @foreach ($classes->get() as $class)
                    @if (($j > 4 && ($j - ($j % 4)) / 4 == $i) || ($j < 4 && $j == $i))
                    <div class="category">
                      <h3>{{$class->name}}</h3>
                      <ul class="smallertext">
                      @foreach(BaseController::getCoursesBySchool($schoolInfo->id) as $course)
                        <li><a href="{{ URL::route('student/sprintsBycourse', $course->id) }}">{{$course->name}}</a></li>
                      @endforeach                
                      </ul>
                    </div>
                    @endif
                    <?php $j++;?>
                  @endforeach
                </div>
                @endfor
                   
                <div class="clear"></div>
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

  $('#sprint-table').dataTable({
    "sPaginationType": "full_numbers"
  });
  
  // Chosen Select
  $("select").chosen({
    'min-width': '100px',
    'white-space': 'nowrap',
    disable_search_threshold: 10
  });

  $('.submit_sprint').click(function() {
    $('#id').val($(this).prev().val());
    $('#form').submit();
  });
});
</script>

@endsection