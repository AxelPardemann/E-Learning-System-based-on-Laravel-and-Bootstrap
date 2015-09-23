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
        
        @foreach($schoolsByUser as $school)
        <a href="{{URL::route('teacher/school', array('id'=>$school->id))}}">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="assets/images/is-document.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Click here</small>
                    <h1>{{$school->name}}</h1>
                  </div>
                </div><!-- row -->                
                <div class="mb15"></div>                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Total Courses</small>
                    <h4>{{BaseController::getCoursesCountBySchool($school->id)}}</h4>
                  </div>                  
                  <div class="col-xs-6">
                    <small class="stat-label">Total Users</small>
                    <h4>{{BaseController::getUsersBySchool($school->id)}}</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
      </a>
        @endforeach       
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
});
</script>

@endsection