<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>YuPax | Admin Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
@include("Admin.Layouts.css")
@yield("css")
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{Asset('public/favicon.ico')}}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<body class="page-header-fixed page-quick-sidebar-over-content">

	<!-- BEGIN MAIN LAYOUT -->
	<div class="wrapper">
		<!-- Header BEGIN -->
		@include("Admin.Layouts.header")
		<!-- Header END -->

		<!-- Page Content BEGIN -->
	    <div class="container-fluid">
	    	<div class="page-content">
				@yield('content')
	    	</div>
			<!-- Page Content END -->

			<!-- BEGIN QUICK SIDEBAR -->
			@include("Admin.Layouts.sidebar")
			<!-- END QUICK SIDEBAR -->			
			
			<!-- Copyright BEGIN -->
			<p class="copyright">2016 © vsec.com.vn 
	 			<a href="http://vsec.com.vn/" title="vsec.com.vn " target="_blank">http://vsec.com.vn/</a>
	 		</p>
			<!-- Copyright END -->
	    </div>
	</div>
    <!-- END MAIN LAYOUT -->
    <a href="#index" class="go2top"><i class="icon-arrow-up"></i></a>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
@include("Admin.Layouts.js")
@yield("js")
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>