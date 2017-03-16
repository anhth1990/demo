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
                
                var profit = [];
                var key2;
                var obj2 = <?php echo $json_profit?>;
                for (key2 in obj) {
                    profit.push([key2, obj2[key2]]);
                }   
				
                
                var plot = $.plot($("#chart_2"), [{
                    data: revenue,
                    label: "<?php echo trans('sales.revenue')?>",
                    lines: {
                        lineWidth: 1,
                    },
                    shadowSize: 0

                }, {
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
                            showTooltip(item.pageX, item.pageY, item.series.label + ": " + y);//  profits.toFixed(3)
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
			
            //graph
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
 
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('layout.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/')}}">{{trans('sales.list_sales')}}</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
			{{trans('sales.export_file')}} <i class="fa fa-angle-down"></i>
            </button>
			<?php 
				$start_date = date( 'Y-m-d', strtotime('-1 month'));
				if(isset($_GET['start_date'])){
					$start_date = $_GET['start_date'];
				}
				$end_date = date( 'Y-m-d', strtotime('today'));
				if(isset($_GET['end_date'])){
					$end_date = $_GET['end_date'];
				}
				$url="?start_date=".$start_date."&end_date=".$end_date;
			?>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{Asset('/'.$admin_local.'/sales/export-excel-order'.$url)}}">{{trans('sales.export_user_csv')}}</a>
                </li>                
				<li>
                    <a target="_blank" href="{{Asset('/'.$admin_local.'/sales/export-pdf-order'.$url)}}">{{trans('sales.export_user_pdf')}}</a>
                </li>
                <!--li>
                    <a href="#">Another action</a>
                </li>
                <li>
                    <a href="#">Something else here</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="#">Separated link</a>
                </li-->
            </ul>
        </div>
    </div>
</div>
<h3 class="page-title">
    {{trans('sales.list_sales')}}
</h3>  
<!--====================================================================================================================================-->
<?php
    if (isset($orders) && count($orders) > 0) {
        foreach ($orders as $key => $value) {
            ?>
<div class="modal fade" id="basic-{{$value->id}}" tabindex="-1" role="basic-{{$value->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php 
                //echo $userControler->viewOrderUsing($value->id_type,$value->type);
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php }} ?>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="tools">
                        <a title="" data-original-title="" href="javascript:;" class="collapse">
                        </a>
                        <a title="" data-original-title="" href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a title="" data-original-title="" href="javascript:;" class="reload">
                        </a>
                        <a title="" data-original-title="" href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet light">
				   <div class="" style="padding: 10px;">
						<?php echo Form::model(null, ['url' => ['/'.$admin_local.'/bao-cao'],'class'=>'form-horizontal','method'=>'get','id'=>'form_validate','role'=>'form'  ]);?>
							<div style="float: left;margin-right: 10px;" class="input-group date date-picker margin-bottom-5 col-md-2" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control form-filter input-sm" readonly name="start_date" placeholder="From" value="<?php echo $start_date?>">
								<span class="input-group-btn">
								<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
							<div style="float: left;margin-right: 10px;" class="input-group date date-picker margin-bottom-5 col-md-2" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control form-filter input-sm" readonly name="end_date" placeholder="To" value="<?php echo $end_date?>">
								<span class="input-group-btn">
								<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
								</span>									
							</div>
							<div style="float: left;margin-right: 10px;" class="input-group col-md-2">
								<?php echo Form::select('mobile_search', $arr_mobile, $mobile_search, ['class' => 'form-control select2me', 'id' => 'mobile_search']); ?>
							</div>
							<button type="submit" class="btn grey-cascade"><i class="fa fa-search"></i> {{trans('sales.form_seach')}} </button>
							<a href="{{Asset('/'.$admin_local.'/bao-cao')}}" class="btn default"><i class="fa fa-times"></i> {{trans('sales.form_remove')}} </a>								
						</form>
					</div>
					<h4 class="block">{{trans('sales.report_sale')}}</h4>
					<div id="chart_2" class="chart">
					</div>
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif

                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            {{trans('sales.user_buy')}}
                                        </th>
                                        <th>
                                            {{trans('sales.date_buy')}}
                                        </th>
                                        <th>
                                            {{trans('sales.price')}}
                                        </th>
                                        <th>
                                            {{trans('sales.profit')}}
                                        </th>                                        
										<th>
                                            {{trans('sales.points')}}
                                        </th>										
                                        <th>
                                            {{trans('sales.action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($orders) && count($orders) > 0) {
                                        foreach ($orders as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo ($key+1) ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $value->u_fullname.' - '.$value->u_mobile ?>
                                                </td>
                                                <td>
                                                    <?php echo date( 'd-m-Y', $value->date_buy); ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($value->price);?>
                                                </td>
												<td>
                                                    <?php echo number_format($value->profit);?>
                                                </td>
                                                <td>
                                                    <?php echo $value->bonus_points; ?>
                                                </td>
                                                <td>
                                                    <a href="{{Asset('/'.$admin_local.'/bao-cao-nguoi-mua/'.base64_encode($value['u_hashcode']))}}" class="btn btn-sm grey-cascade" target="_blank">
                                                        {{trans('sales.user_buy')}} <i class="fa fa-search"></i>
                                                    </a>
													<a href="{{Asset('/'.$admin_local.'/bao-cao-nguoi-mua/'.base64_encode($value['u_hashcode']))}}" class="btn btn-sm grey-cascade" target="_blank">
                                                        {{trans('sales.detail')}} <i class="fa fa-user"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <tbody class="main-id-<?php echo $value->id; ?>" style="display:none;"></tbody>
                                    <?php }
                                } ?>	
                                </tbody>
                            </table>
                        </div>
						<?php
							if(isset($_GET['mobile_search'])) {
									echo $orders->appends([
										'mobile_search' => isset($_GET['mobile_search'])?strip_tags($_GET['mobile_search']):'',
										'start_date'=>isset($_GET['start_date'])?strip_tags($_GET['start_date']):'',
										'end_date'=>isset($_GET['end_date'])?strip_tags($_GET['end_date']):''
									])->render();
							}
							else {
									echo $orders->render();
							}
						?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>   	
	
@stop