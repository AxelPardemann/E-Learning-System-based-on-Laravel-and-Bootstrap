@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
@endsection

@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-home"></i> Dashboard <span>Subtitle goes here...</span></h2>
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
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="{{ URL::to('assets/images/is-user.png') }} " alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Visits Today</small>
                    <h1>900k+</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Pages / Visit</small>
                    <h4>7.80</h4>
                  </div>
                  
                  <div class="col-xs-6">
                    <small class="stat-label">% New Visits</small>
                    <h4>76.43%</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">                    
                    <img src="{{ URL::to('assets/images/is-document.png') }} " alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">% Unique Visitors</small>
                    <h1>54.40%</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <small class="stat-label">Avg. Visit Duration</small>
                <h4>01:80:22</h4>
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="{{ URL::to('assets/images/is-document.png') }} " alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Page Views</small>
                    <h1>300k+</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <small class="stat-label">% Bounce Rate</small>
                <h4>34.23%</h4>
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="{{ URL::to('assets/images/is-money.png') }} " alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1>$655</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4>$32,322</h4>
                  </div>
                  
                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4>$503,000</h4>
                  </div>
                </div><!-- row -->
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
      </div><!-- row -->
      <div class="row">
        <div class="col-sm-8 col-md-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8">
                  <h5 class="subtitle mb5">Network Performance</h5>
                  <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                  <div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
                </div><!-- col-sm-8 -->
                <div class="col-sm-4">
                  <h5 class="subtitle mb5">Server Status</h5>
                  <p class="mb15">Summary of the status of your server.</p>
                  
                  <span class="sublabel">CPU Usage (40.05 - 32 cpus)</span>
                  <div class="progress progress-sm">
                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
                  </div><!-- progress -->
                  
                  <span class="sublabel">Memory Usage (32.2%)</span>
                  <div class="progress progress-sm">
                    <div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                  </div><!-- progress -->
                  
                  <span class="sublabel">Disk Usage (82.2%)</span>
                  <div class="progress progress-sm">
                    <div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
                  </div><!-- progress -->
                  
                  <span class="sublabel">Databases (63/100)</span>
                  <div class="progress progress-sm">
                    <div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning"></div>
                  </div><!-- progress -->
                  
                  <span class="sublabel">Domains (2/10)</span>
                  <div class="progress progress-sm">
                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                  </div><!-- progress -->
                  
                  <span class="sublabel">Email Account (13/50)</span>
                  <div class="progress progress-sm">
                    <div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                  </div><!-- progress -->
                  
                  
                </div><!-- col-sm-4 -->
              </div><!-- row -->
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-9 -->
        
        <div class="col-sm-4 col-md-3">
          
          <div class="panel panel-default">
            <div class="panel-body">
            <h5 class="subtitle mb5">Most Browser Used</h5>
            <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
            <div id="donut-chart2" style="text-align: center; height: 298px;"></div>
            </div><!-- panel-body -->
          </div><!-- panel -->
          
        </div><!-- col-sm-3 -->
        
      </div><!-- row -->
      
      <div class="row">
        
        <div class="col-sm-7">
          
          <div class="table-responsive dashboard-datatable">
            <table class="table" id="table1">
              <thead>
                 <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                 </tr>
              </thead>
              <tbody>
                 <tr class="odd gradeX">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 4.0</td>
                    <td>Win 95+</td>
                 </tr>
                 <tr class="even gradeC">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 5.0</td>
                    <td>Win 95+</td>
                 </tr>
                 <tr class="odd gradeA">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 5.5</td>
                    <td>Win 95+</td>
                 </tr>
                 <tr class="even gradeA">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 6</td>
                    <td>Win 98+</td>
                 </tr>
                 <tr class="odd gradeA">
                    <td>Trident</td>
                    <td>Internet Explorer 7</td>
                    <td>Win XP SP2+</td>
                 </tr>
                 <tr class="even gradeA">
                    <td>Trident</td>
                    <td>AOL browser (AOL desktop)</td>
                    <td>Win XP</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 1.5</td>
                    <td>Win 98+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 2.0</td>
                    <td>Win 98+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 3.0</td>
                    <td>Win 2k+ / OSX.3+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Camino 1.0</td>
                    <td>OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Camino 1.5</td>
                    <td>OSX.3+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Netscape 7.2</td>
                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Netscape Browser 8</td>
                    <td>Win 98SE+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Netscape Navigator 9</td>
                    <td>Win 98+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.0</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.1</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.2</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.3</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.4</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.5</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.6</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.7</td>
                    <td>Win 98+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Mozilla 1.8</td>
                    <td>Win 98+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Seamonkey 1.1</td>
                    <td>Win 98+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Gecko</td>
                    <td>Epiphany 2.20</td>
                    <td>Gnome</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>Safari 1.2</td>
                    <td>OSX.3</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>Safari 1.3</td>
                    <td>OSX.3</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>Safari 2.0</td>
                    <td>OSX.4+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>Safari 3.0</td>
                    <td>OSX.4+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>OmniWeb 5.5</td>
                    <td>OSX.4+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>iPod Touch / iPhone</td>
                    <td>iPod</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Webkit</td>
                    <td>S60</td>
                    <td>S60</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 7.0</td>
                    <td>Win 95+ / OSX.1+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 7.5</td>
                    <td>Win 95+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 8.0</td>
                    <td>Win 95+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 8.5</td>
                    <td>Win 95+ / OSX.2+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 9.0</td>
                    <td>Win 95+ / OSX.3+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 9.2</td>
                    <td>Win 88+ / OSX.3+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera 9.5</td>
                    <td>Win 88+ / OSX.3+</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Opera for Wii</td>
                    <td>Wii</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Nokia N800</td>
                    <td>N800</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Presto</td>
                    <td>Nintendo DS browser</td>
                    <td>Nintendo DS</td>
                 </tr>
                 <tr class="gradeC">
                    <td>KHTML</td>
                    <td>Konqureror 3.1</td>
                    <td>KDE 3.1</td>
                 </tr>
                 <tr class="gradeA">
                    <td>KHTML</td>
                    <td>Konqureror 3.3</td>
                    <td>KDE 3.3</td>
                 </tr>
                 <tr class="gradeA">
                    <td>KHTML</td>
                    <td>Konqureror 3.5</td>
                    <td>KDE 3.5</td>
                 </tr>
                 <tr class="gradeX">
                    <td>Tasman</td>
                    <td>Internet Explorer 4.5</td>
                    <td>Mac OS 8-9</td>
                 </tr>
                 <tr class="gradeC">
                    <td>Tasman</td>
                    <td>Internet Explorer 5.1</td>
                    <td>Mac OS 7.6-9</td>
                 </tr>
                 <tr class="gradeC">
                    <td>Tasman</td>
                    <td>Internet Explorer 5.2</td>
                    <td>Mac OS 8-X</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Misc</td>
                    <td>NetFront 3.1</td>
                    <td>Embedded devices</td>
                 </tr>
                 <tr class="gradeA">
                    <td>Misc</td>
                    <td>NetFront 3.4</td>
                    <td>Embedded devices</td>
                 </tr>
                 <tr class="gradeX">
                    <td>Misc</td>
                    <td>Dillo 0.8</td>
                    <td>Embedded devices</td>
                 </tr>
                 <tr class="gradeX">
                    <td>Misc</td>
                    <td>Links</td>
                    <td>Text only</td>
                 </tr>
                 <tr class="gradeX">
                    <td>Misc</td>
                    <td>Lynx</td>
                    <td>Text only</td>
                 </tr>
                 <tr class="gradeC">
                    <td>Misc</td>
                    <td>IE Mobile</td>
                    <td>Windows Mobile 6</td>
                 </tr>
                 <tr class="gradeC">
                    <td>Misc</td>
                    <td>PSP browser</td>
                    <td>PSP</td>
                 </tr>
                 <tr class="gradeU">
                    <td>Other browsers</td>
                    <td>All others</td>
                    <td>-</td>
                 </tr>
              </tbody>
           </table>
          </div><!-- table-responsive -->
          
        </div><!-- col-sm-7 -->
        
        <div class="col-sm-5">
          
          <div class="panel panel-success">
            <div class="panel-heading padding5">
              <div id="line-chart" style="height: 248px;"></div>
            </div>
            <div class="panel-body">
              <div class="tinystat pull-left">
                <div id="sparkline" class="chart mt5"></div>
                <div class="datainfo">
                  <span class="text-muted">Average Sales</span>
                  <h4>$630,201</h4>
                </div>
              </div><!-- tinystat -->
              <div class="tinystat pull-right">
                <div id="sparkline2" class="chart mt5"></div>
                <div class="datainfo">
                  <span class="text-muted">Total Sales</span>
                  <h4>$139,201</h4>
                </div>
              </div><!-- tinystat -->
            </div>
          </div><!-- panel -->
          
        </div><!-- col-sm-6 -->
      </div><!-- row -->
      
      <div class="row">
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-default widget-photoday">
            <div class="panel-body">
              <a href="" class="photoday"><img src="{{ URL::to('assets/images/photos/photo1.png') }}" alt="" /></a>
              <div class="photo-details">
                <h4 class="photo-title">Strawhat In The Beach</h4>
                <small class="text-muted"><i class="fa fa-map-marker"></i> San Franciso, California, USA</small>
                <small>By: <a href="">ThemePixels</a></small>
              </div><!-- photo-details -->
              <ul class="photo-meta">
                <li><span><i class="fa fa-eye"></i> 32,102</span></li>
                <li><a href="#"><i class="fa fa-heart"></i> 1,003</a></li>
                <li><a href="#"><i class="fa fa-comments"></i> 52</a></li>
              </ul>
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-default panel-alt widget-messaging">
          <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-edit"><i class="fa fa-edit"></i></a>
              </div><!-- panel-btns -->
              <h3 class="panel-title">Messaging</h3>
            </div>
            <div class="panel-body">
              <ul>
                <li>
                  <small class="pull-right">Dec 10</small>
                  <h4 class="sender">Jennier Lawrence</h4>
                  <small>Lorem ipsum dolor sit amet...</small>
                </li>
                <li>
                  <small class="pull-right">Dec 9</small>
                  <h4 class="sender">Marsha Mellow</h4>
                  <small>Lorem ipsum dolor sit amet...</small>
                </li>
                <li>
                  <small class="pull-right">Dec 9</small>
                  <h4 class="sender">Holly Golightly</h4>
                  <small>Lorem ipsum dolor sit amet...</small>
                </li>
                <li>
                  <small class="pull-right">Dec 10</small>
                  <h4 class="sender">Jennier Lawrence</h4>
                  <small>Lorem ipsum dolor sit amet...</small>
                </li>
                <li>
                  <small class="pull-right">Dec 9</small>
                  <h4 class="sender">Marsha Mellow</h4>
                  <small>Lorem ipsum dolor sit amet...</small>
                </li>
              </ul>
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-dark panel-alt widget-quick-status-post">
          <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
              </div><!-- panel-btns -->
              <h3 class="panel-title">Quick Status Post</h3>
            </div>
            <div class="panel-body">
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#post-status" data-toggle="tab"><i class="fa fa-pencil"></i> <strong>Status</strong></a></li>
                <li><a href="#post-photo" data-toggle="tab"><i class="fa fa-picture-o"></i> <strong>Photo</strong></a></li>
                <li><a href="#post-checkin" data-toggle="tab"><i class="fa fa-map-marker"></i> <strong>Check-In</strong></a></li>
              </ul>
              <div class="tab-content">
                <div id="post-status" class="tab-pane active">
                  <input type="text" class="form-control" placeholder="What's your status?" />
                </div>
                <div id="post-photo" class="tab-pane">
                  <input type="text" class="form-control" placeholder="Choose photo" />
                </div>
                <div id="post-checkin" class="tab-pane">
                  <input type="text" class="form-control" placeholder="Search location" />
                </div>
                <button class="btn btn-primary btn-block mt10">Submit Post</button>
              </div><!-- tab-content -->
              
            </div><!-- panel-body -->
          </div><!-- panel -->
          
          <div class="mb20"></div>
          
          <div class="row">
            <div class="col-xs-6">
              <div class="panel panel-warning panel-alt widget-today">
                <div class="panel-heading text-center">
                  <i class="fa fa-calendar-o"></i>
                </div>
                <div class="panel-body text-center">
                  <h3 class="today">Fri, Dec 13</h3>
                </div><!-- panel-body -->
              </div><!-- panel -->
            </div>
            
            <div class="col-xs-6">
              <div class="panel panel-danger panel-alt widget-time">
                <div class="panel-heading text-center">
                  <i class="glyphicon glyphicon-time"></i>
                </div>
                <div class="panel-body text-center">
                  <h3 class="today">4:50AM PST</h3>
                </div><!-- panel-body -->
              </div><!-- panel -->
            </div>
          </div>
        </div><!-- col-sm-6 -->
        
      </div>
</div>
@endsection
@section('javaScript')
  {{HTML::script('assets/js/flot/flot.min.js')}}
  {{HTML::script('assets/js/flot/flot.resize.min.js')}}
  {{HTML::script('assets/js/dashboard.js')}}
@endsection