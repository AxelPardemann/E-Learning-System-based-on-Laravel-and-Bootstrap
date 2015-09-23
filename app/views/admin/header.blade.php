<div class="headerbar">      
  <a class="menutoggle"><i class="fa fa-bars"></i></a>	      
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
            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Account Settings</a></li>
            <li><a href="{{URL::route('logout')}}"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
          </ul>
        </div>
      </li>     
    </ul>
  </div><!-- header-right -->	      
</div><!-- headerbar -->

