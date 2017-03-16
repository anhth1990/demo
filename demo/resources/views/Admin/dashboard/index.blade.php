@extends('Admin.Layouts.default')
@section('js')
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.categories.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.crosshair.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.stack.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.time.js')}}"></script>

<script src="{{Asset('public/adpc/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script> <!--   src="{{Asset('public/adpc/plugins/charts-flotcharts.js')}}" -->
var ChartsFlotcharts = function() {

    return {
        //main function to initiate the module

        init: function() {

            Metronic.addResizeHandler(function() {
                //Charts.initPieCharts();
            });

        },

        initCharts: function() {

            if (!jQuery.plot) {
                return;
            }

            var data = [];
            //Interactive Chart

			function chart1() {
                if ($('#chart_1').size() != 1) {
                    return;
                }

                function randValue() {
                    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
                    //return 100;
                }
                
                
                
                var profit = [];
                var key2;
                var obj2 = <?php echo $json_profit?>;
                for (key2 in obj2) {
                    profit.push([key2, obj2[key2]]);
                }   
				
                
                var plot = $.plot($("#chart_1"), [ {
                    data: profit,
                    label: "<?php echo trans('sales.profit')?>",
                    lines: {
                        lineWidth: 1,
                    },
                    shadowSize: 0
                }], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }]
                            }
                        },
                        points: {
                            show: true,
                            radius: 3,
                            lineWidth: 1
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    },
                    colors: ["#37b7f3", "#52e136","#fffa1a"],
                    xaxis: {   
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d-%m",//-%y",
                        tickLength: 0,
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10
                    },
                    yaxis: {
                        ticks: 11,
                        tickDecimals: 0,
                        tickColor: "#eee",
						tickFormatter: function (val, axis) {
							return val.format(0, 3);
						},
                    }
                });


                function showTooltip(x, y, contents) {
                    $('<div id="tooltip">' + contents + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 15,
                        border: '1px solid #333',
                        padding: '4px',
                        color: '#fff',
                        'border-radius': '3px',
                        'background-color': '#333',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $("#chart_1").bind("plothover", function(event, pos, item) {
                    $("#x").text(pos.x.format(0, 3));
                    $("#y").text(pos.y.format(0, 3));

                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].format(0, 3),
                                y = item.datapoint[1].format(0, 3);                                              
                            //showTooltip(item.pageX, item.pageY, item.series.label + " of " + formatDate("M-d-yy",x) + " = " + y);
                            showTooltip(item.pageX, item.pageY, item.series.label + ": " + y +" vnđ");//  profits.toFixed(3)
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
			Number.prototype.format = function(n, x, s, c) {
				var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
					num = this.toFixed(Math.max(0, ~~n));
				
				return (c ? num.replace(',', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || '.'));
			};

            function chart2() {
                if ($('#chart_2').size() != 1) {
                    return;
                }

                function randValue() {
                    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
                    //return 100;
                }
                
                var revenue = [];
                var key;
                var obj = <?php echo $json_price?>;
                for (key in obj) {
                    revenue.push([key, obj[key]]);
                }
                var plot = $.plot($("#chart_2"), [{
                    data: revenue,
                    label: "<?php echo trans('sales.revenue')?>",
                    lines: {
                        lineWidth: 1,
                    },
                    shadowSize: 0

                }], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }]
                            }
                        },
                        points: {
                            show: true,
                            radius: 3,
                            lineWidth: 1
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    },
                    colors: ["#d12610", "#37b7f3", "#52e136","#fffa1a"],
                    xaxis: {   
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d-%m",//-%y",
                        tickLength: 0,
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Verdana, Arial',
                        axisLabelPadding: 10
                    },
                    yaxis: {
                        ticks: 11,
                        tickDecimals: 0,
                        tickColor: "#eee",
						tickFormatter: function (val, axis) {
							return val.format(0, 3);
						},
                    }
                });


                function showTooltip(x, y, contents) {
                    $('<div id="tooltip">' + contents + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 15,
                        border: '1px solid #333',
                        padding: '4px',
                        color: '#fff',
                        'border-radius': '3px',
                        'background-color': '#333',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $("#chart_2").bind("plothover", function(event, pos, item) {
                    $("#x").text(pos.x.format(0, 3));
                    $("#y").text(pos.y.format(0, 3));

                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].format(0, 3),
                                y = item.datapoint[1].format(0, 3);                                              
                            //showTooltip(item.pageX, item.pageY, item.series.label + " of " + formatDate("M-d-yy",x) + " = " + y);
                            showTooltip(item.pageX, item.pageY, item.series.label + ": " + y+ " vnđ");//  profits.toFixed(3)
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }  
			        
            //graph
            chart1();
            chart2();
        }
    };
}();
</script>
<script>
jQuery(document).ready(function() {
   ChartsFlotcharts.init();
   ChartsFlotcharts.initCharts();
   //ChartsFlotcharts.initPieCharts();
   //ChartsFlotcharts.initBarCharts();
});
</script>
@stop
@section('content')	
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{Asset('/'.$admin_local)}}">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{Asset('/'.$admin_local)}}">{{trans('layout.dashboard')}}</a>
		</li>
	</ul>
	
</div>
			<h3 class="page-title">
			{{trans('layout.dashboard')}} <small>reports & statistics</small>
			</h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
							{{$count_user}}
							</div>
							<div class="desc">
							{{trans('dashboard.count_user')}}
							</div>
						</div>
						<a class="more" href="{{Asset('/'.$admin_local.'/user')}}">
							{{trans('dashboard.view_more')}} <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>			
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								 {{$count_order}}
							</div>
							<div class="desc">
								 {{trans('dashboard.count_order')}}
							</div>
						</div>
						<a class="more" href="{{Asset('/'.$admin_local.'/bao-cao')}}">
							{{trans('dashboard.view_more')}} <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
							{{number_format($total['total_sales'])}}$
							</div>
							<div class="desc">
							{{trans('dashboard.total_sales')}}
							</div>
						</div>
						<a class="more" href="{{Asset('/'.$admin_local.'/bao-cao')}}">
						{{trans('dashboard.view_more')}} <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
							{{number_format($total['total_profit'])}}$
							</div>
							<div class="desc">
								 {{trans('dashboard.total_profit')}}
							</div>
						</div>
						<a class="more" href="{{Asset('/'.$admin_local.'/bao-cao')}}">
						{{trans('dashboard.view_more')}} <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<h3>{{trans('dashboard.total_profit_7')}}</h3>
					<div id="chart_1" class="chart">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<h3>{{trans('dashboard.total_sales_7')}}</h3>
					<div id="chart_2" class="chart">
					</div>
				</div>
			</div>
			<div class="clearfix">
			</div>    		
@stop