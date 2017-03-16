@extends('Admin.Layouts.default')
@section('js')
<script>
var ChartsAmcharts = function() {
    var initChartSample6 = function() {
		<?php foreach($result_char as $key=>$value){ ?>
        var chart = AmCharts.makeChart("chart_<?php echo $key?>", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',    
            "color":    '#888',
            "dataProvider": <?php echo $value?>,
            "valueField": "litres",
            "titleField": "country",
            "exportConfig": {
                menuItems: [{
                    icon: Metronic.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                    format: 'png'
                }]
            }
        });

        $('#chart_<?php echo $key?>').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
		<?php } ?>
    }
    return {
        init: function() {
            initChartSample6();
        }

    };

}();
</script>	
@stop
@section('content')
<style>
.error{
	color:red;
}
</style>
<h3 class="page-title">
    {{trans('contact.list_contact')}}
</h3>   
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('layout.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('contact.list_contact')}}</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                Actions <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">Action</a>
                </li>
                <li>
                    <a href="#">Another action</a>
                </li>
                <li>
                    <a href="#">Something else here</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="#">Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box grey-cascade ">
  
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
						<div class="form-body">
							<div class="form-group">
								<?php foreach($result_char as $key=>$value){ ?>
								<div class="col-md-6">
									<div id="chart_<?php echo $key;?>" class="chart" style="height: 525px;">
									</div>
								</div>	
								<?php } ?>	
							</div>												
						</div>												

            </div>
        </div>
    </div>
</div>   

@stop