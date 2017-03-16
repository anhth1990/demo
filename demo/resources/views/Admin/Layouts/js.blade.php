<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{Asset('public/adpc/plugins/respond.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/excanvas.min.js')}}"></script> 
<![endif]-->
<script src="{{Asset('public/adpc/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--script src="{{Asset('public/adpc/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript" ></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript" ></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript" ></script>
<script src="{{Asset('public/adpc/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
<!--script src="{{Asset('public/adpc/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script-->

<!--script src="{{Asset('public/adpc/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script-->
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/jquery-multi-select/js/jquery.multi-select.js')}}"></script>

<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/clockface/js/clockface.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{Asset('/public/adpc/plugins/components-pickers.js')}}"></script>

<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-markdown/lib/markdown.js')}}"></script>

<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>

<script type="text/javascript" src="{{Asset('/public/adpc/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/adpc/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
<script src="{{Asset('/public/adpc/plugins/form-validation.js')}}"></script>
<!--script src="{{Asset('/public/adpc/plugins/charts-amcharts.js')}}"></script-->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{Asset('public/adpc/plugins/metronic.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/layout/scripts/layout.js')}}" type="text/javascript"></script>
<!--script src="{{Asset('public/adpc/plugins/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script-->
<!--script src="{{Asset('public/adpc/plugins/layout/scripts/demo.js')}}" type="text/javascript"></script-->
<script src="{{Asset('public/adpc/plugins/index.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/adpc/plugins/tasks.js')}}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    ComponentsPickers.init();
    //QuickSidebar.init(); // init quick sidebar
    //Index.init(); // init index page
    Tasks.initDashboardWidget(); // init tash dashboard widget
	//ChartsAmcharts.init();
   //ChartsAmcharts.init();
});
</script>