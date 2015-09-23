<div class="headerbar">  
  <div class="header-left">
    
    <div class="logopanel">
        <a href="{{URL::route('teacher/home')}}"><h1><span>[</span> {{Config::get('app.title')}} <span>]</span></h1></a>
    </div><!-- logopanel -->
    
    <div class="topnav">          
        <ul class="nav nav-horizontal">
            <li @if($title == 'Dashboard') class="active" @endif><a href="{{URL::route('teacher/home')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li @if($title == 'Student Progress') class="active" @endif><a href="{{URL::route('teacher/students')}}"><i class="fa fa-users"></i> <span>Student progress</span></a></li>
            <li @if($title == 'My Sprints') class="active" @endif>
              @if ($studyroom == true)
                <a href="#" class="finish"><i class="fa fa-edit"></i> <span>Stop Sprint</span></a>
              @else
                <a href="{{URL::route('teacher/sprints')}}"><i class="fa fa-edit"></i> <span>My sprints</span></a>
              @endif
            </li>
        </ul>
    </div><!-- topnav -->
      
  </div><!-- header-left -->
  
  <div class="header-right">
    <ul class="headermenu">
      <li>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <img src="{{ URL::to('assets/images/photos/loggeduser.png') }}" alt="" />
            {{$user->first}} {{$user->last}}
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
            <li><a href="{{URL::route('teacher/account')}}"><i class="glyphicon glyphicon-user"></i> Account Settings</a></li>
            <li><a href="{{URL::route('logout')}}"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div><!-- header-right -->      
</div><!-- headerbar -->