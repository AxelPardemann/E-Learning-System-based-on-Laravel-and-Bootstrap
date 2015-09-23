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
  {{HTML::style('assets/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}
  {{HTML::style('assets/bootstrap-modal/css/bootstrap-modal.css')}}
	@yield('globalStyles')
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
   {{HTML::script('assets/js/html5shiv.js')}}
   {{HTML::script('assets/js/respond.min.js')}}
  <![endif]-->
</head>

<body id="mainbody" class="oldtemplate">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>

@yield('headerbar')
<!-- BEGIN CONTAINER -->
@yield('pageContainer')
<!-- END CONTAINER -->
</section>
<!-- BEGIN CORE PLUGINS -->
{{HTML::script('assets/js/jquery-1.10.2.min.js')}}
{{HTML::script('assets/js/jquery-migrate-1.2.1.min.js')}}
{{HTML::script('assets/js/jquery-ui-1.10.3.min.js')}}
{{HTML::script('assets/js/bootstrap.min.js')}}

{{HTML::script('assets/js/modernizr.min.js')}}
{{HTML::script('assets/js/jquery.sparkline.min.js')}}
{{HTML::script('assets/js/toggles.min.js')}}
{{HTML::script('assets/js/retina.min.js')}}
{{HTML::script('assets/js/jquery.cookies.js')}}


{{HTML::script('assets/js/jquery.autogrow-textarea.js')}}
{{HTML::script('assets/js/jquery.maskedinput.min.js')}}
{{HTML::script('assets/js/jquery.tagsinput.min.js')}}
{{HTML::script('assets/js/chosen.jquery.min.js')}}
{{HTML::script('assets/bootstrap-modal/js/bootstrap-modalmanager.js')}}
{{HTML::script('assets/bootstrap-modal/js/bootstrap-modal.js')}}
{{HTML::script('assets/js/ui-extended-modals.js')}}
{{HTML::script('assets/js/jquery.fileupload.js')}}
{{HTML::script('assets/js/jquery.validate.min.js')}}
{{HTML::script('assets/js/additional-methods.min.js')}}
{{HTML::script('assets/js/app.js')}}
{{HTML::script('assets/js/custom.js')}}

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