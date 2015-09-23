 <div class="leftpanel">
    
    <div class="logopanel">
        <h1><span>[</span> bracket <span>]</span></h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="active"><a href="{{URL::route('teacher/home')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{URL::route('teacher/sprints')}}"><i class="fa fa-edit"></i> <span>Sprints</span></a></li>
        <li><a href="{{URL::route('teacher/cards')}}"><i class="fa fa-th-list"></i> <span>Cards</span></a></li>        
        <li><a href="{{URL::route('teacher/students')}}"><i class="fa fa-users"></i> <span>Students progress</span></a>           
        </li>
      </ul> 
     
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->