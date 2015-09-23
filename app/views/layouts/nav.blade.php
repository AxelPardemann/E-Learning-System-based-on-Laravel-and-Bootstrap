<!-- BEGIN HORIZANTAL MENU -->
    <div class="headerbar">  
      <div class="header-left">
        
        <div class="logopanel">
            <h1><span>[</span> bracket <span>]</span></h1>
        </div><!-- logopanel -->
        
        <div class="topnav">            
            <ul class="nav nav-horizontal">
                <li class="active"><a href="{{URL::route('teacher/home')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li><a href="#"><span class="pull-right badge badge-success">2</span><i class="fa fa-envelope-o"></i> <span>Email</span></a></li>
                <li class="nav-parent"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list"></i> More <span class="caret"></span></a>
                    <ul class="dropdown-menu children">
                        <li><a href="{{URL::route('teacher/students')}}"><i class="fa fa-users"></i> Student progress</a></li>
                        <li><a href="{{URL::route('teacher/sprints')}}"><i class="fa fa-edit"></i> Sprints</a></li>
                        <li><a href="{{URL::route('teacher/cards')}}"><i class="fa fa-th-list"></i> Cards</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-search"></i></a>
                    <div class="dropdown-menu">
                        <form action="index.html" method="post">
                            <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
                        </form>
                    </div>
                </li>
            </ul>
        </div><!-- topnav -->
          
      </div><!-- header-left -->
      
      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <span class="badge">2</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">2 Newly Registered Users</h5>
                <ul class="dropdown-list user-list">
                  <li class="new">
                    <div class="thumb"><a href=""><img src="images/photos/user1.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Draniem Daamul (@draniem)</a> <span class="badge badge-success">new</span></h5>
                    </div>
                  </li>
                  <li class="new"><a href="">See All Users</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-envelope"></i>
                <span class="badge">1</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have 1 New Message</h5>
                <ul class="dropdown-list gen-list">
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user1.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li class="new"><a href="">Read All Messages</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globe"></i>
                <span class="badge">5</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have 5 New Notifications</h5>
                <ul class="dropdown-list gen-list"> 
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Nusja Nawancali <span class="badge badge-success">new</span></span>
                      <span class="msg">send you 2 messages</span>
                    </span>
                    </a>
                  </li>
                  <li class="new"><a href="">See All Notifications</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="images/photos/loggeduser.png" alt="" />
                John Doe
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li><a href="signin.html"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
