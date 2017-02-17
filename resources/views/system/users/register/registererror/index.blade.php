<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.9.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>{{$pageTitle}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{url('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/pages/css/login-soft-register.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES -->
	<link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
	<link id="style_color" href="{{url('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}"/>
	<!-- END THEME STYLES -->
	<!--link rel="shortcut icon" href="favicon.ico"/-->
	<link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
	<script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

	<script>
		jQuery(document).ready(function() {
			TableManaged.init();
		});
	</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="">
		<img src="{{ url('images/LIFESOFT.png')}}"  width="130" alt="Công ty TNHH phát triển phần mềm Cuộc Sống"/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<h3 class="page-title">
		Quản lý thông tin tài khoản đăng ký<small>&nbsp;</small>
	</h3>
	<!-- END PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet box">
				<div class="portlet-body">
					<div class="portlet-body">
						<div class="table-toolbar">
						</div>
						<table class="table table-striped table-bordered table-hover" id="sample_3">
							<thead>
							<tr>
								<th style="text-align: center" width="2%">STT</th>
								<th style="text-align: center">Tên doanh nghiệp</th>
								<th style="text-align: center">Mã số thuế</th>
								<th style="text-align: center" width="5%">Trạng thái</th>
								<th style="text-align: center" width="30%">Thao tác</th>
							</tr>
							</thead>
							<tbody>


							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

		<!-- BEGIN DASHBOARD STATS -->

		<!-- END DASHBOARD STATS -->

		<div class="clearfix"></div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]-->
<script src="{{url('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{url('assets/global/plugins/excanvas.min.js')}}"></script>
<!--[endif]-->
<script src="{{url('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/pages/scripts/login-soft.js')}}" type="text/javascript"></script>
<!--Toastr-->
<script src="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
<!--End Toastr-->
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Login.init();
		Demo.init();
		// init background slide images
		$.backstretch([
					"{{url('assets/admin/pages/media/bg/3.jpg')}}",
					"{{url('assets/admin/pages/media/bg/2.jpg')}}",
					"{{url('assets/admin/pages/media/bg/1.jpg')}}",
					"{{url('assets/admin/pages/media/bg/4.jpg')}}"
				], {
					fade: 1000,
					duration: 8000
				}
		);
	});
</script>
<script>

</script>

</body>
<!-- END BODY -->
</html>