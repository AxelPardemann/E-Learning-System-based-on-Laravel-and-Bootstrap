<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

  <title>{{Config::get('app.title')}}</title>

  {{HTML::style('assets/css/style.default.css')}} 

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="assets/js/html5shiv.js"></script>
  <script src="assets/js/respond.min.js"></script>
  <![endif]-->
  <style>
    body.bg {
      background: url("assets/images/index_bg.jpg") repeat scroll 0 0 / cover rgba(0, 0, 0, 0);
      height: 100%;
      overflow: visible;
      width: 100%;      
    }
  </style>
</head>

<body id="mainbody" class="signin bg">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

	<!-- BEGIN LOGIN -->
	<div class="content1">
	@yield('content')
	</div>
	<!-- END LOGIN -->
  
</section>

<!-- BEGIN CORE PLUGINS -->
{{HTML::script('assets/js/jquery-1.10.2.min.js')}}
{{HTML::script('assets/js/jquery-migrate-1.2.1.min.js')}}
{{HTML::script('assets/js/bootstrap.min.js')}}
{{HTML::script('assets/js/modernizr.min.js')}}
{{HTML::script('assets/js/retina.min.js')}}
{{HTML::script('assets/js/custom.js')}}

{{HTML::script('assets/js/jquery.sparkline.min.js')}}
{{HTML::script('assets/js/jquery.cookies.js')}}
{{HTML::script('assets/js/toggles.min.js')}}
{{HTML::script('assets/js/chosen.jquery.min.js')}}

{{HTML::script('assets/js/jquery.validate.min.js')}}
{{HTML::script('assets/js/additional-methods.min.js')}}
{{HTML::script('assets/js/app.js')}}

<!-- END CORE PLUGINS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('pageLevelPlugins')
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('pageLevelScripts')
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN JAVASCRIPTS -->
@yield('javaScript')
<!-- END JAVASCRIPTS -->

</body>
</html>