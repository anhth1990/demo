<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Shop | Login Form</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->




<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{Asset('public/adpc/login/css/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/login/css/login-soft.css')}}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="{{Asset('public/adpc/login/css/components-rounded.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/login/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/login/css/layout.css')}}" rel="stylesheet" type="text/css"/>
<link id="style_color" href="{{Asset('public/adpc/login/css/themes/default.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{Asset('public/adpc/login/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{Asset('public/favicon.ico')}}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">

</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="" method="post">
		<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
		<h3 class="form-title">Login to your account</h3>
		@if (count($errors) > 0)
			@include("Admin.Blocks.error")
		@endif
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<!--label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label-->
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END LOGIN FORM -->
	
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2016 &copy; Yupax - Admin Dashboard.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="{{Asset('public/adpc/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>


<script src="{{Asset('public/adpc/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/js/jquery.cokie.min.js')}}" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--
<script src="{{Asset('public/adpc/login/js/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
-->
<script src="{{Asset('public/adpc/login/js/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/js/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/css/select2/select2.min.js')}}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{Asset('public/adpc/login/js/metronic.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/js/layout.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/js/demo.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/login/js/login-soft.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
 	Login.init();
  	Demo.init();
       // init background slide images
       $.backstretch([
        "{{Asset('public/adpc/login/images/1.jpg')}}",
        "{{Asset('public/adpc/login/images/2.jpg')}}",
        "{{Asset('public/adpc/login/images/3.jpg')}}",
        "{{Asset('public/adpc/login/images/4.jpg')}}"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>