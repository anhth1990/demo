@extends('Admin.Layouts.default')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('config.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/cau-hinh-mac-dinh')}}">{{trans('config.config')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">{{trans('config.campaign_create')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('config.campaign_create')}}
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('config.campaign_create')}}
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
                <div class="portlet-body form">
                    @if (count($errors) > 0)
                    @include("Admin.Blocks.error")
                    @endif
                    <!-- BEGIN FORM-->
                    <form action="" method="post" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">{{trans('config.name_campaign')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="campaign" name="campaign" value="{!! old('campaign') !!}">
                                </div>

                                <label class="control-label col-md-2">{{trans('config.time')}} <span class="required" aria-required="true"> * </span></label>                                
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="{!! old('start_date') !!}">
                                        <span class="input-group-addon">
                                            to </span>
                                        <input type="text" class="form-control" name="finish_date" id="finish_date" value="{!! old('finish_date') !!}">
                                    </div>
                                </div>	
                            </div>	
                            <div class="form-group">
                                <label class="control-label col-md-2">{{trans('config.scoring')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4">
                                    <?php echo Form::select('scoring', $arr_bonus, null, ['class' => 'form-control select2me', 'id' => 'scoring', 'onchange' => 'choseType(this);']); ?>
                                </div>

                                <label id="label_block_1" class="control-label col-md-3" style="display: block">{{trans('config.block_1')}} <span class="required" aria-required="true"> * </span></label>
                                <label id="label_block_2" class="control-label col-md-3" style="display: none">{{trans('config.block_2')}} <span class="required" aria-required="true"> * </span></label>
                                <label id="label_block_3" class="control-label col-md-3" style="display: none">{{trans('config.block_3')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="block" name="block" value="{!! old('block') !!}">
                                </div>	
                            </div>	
                            <div class="form-group">
                                <label class="control-label col-md-2">{{trans('config.exchange')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="exchange" name="exchange" value="{!! old('exchange') !!}">
                                </div>
								<label class="control-label col-md-3">{{trans('config.point_share')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo Form::text('pointShare',null, ["class" => "form-control","id"=>"pointShare","value"=>"{!! old('pointShare') !!}"]);?>
                                </div>	
                            </div>	
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn grey-cascade"><i class="fa fa-check"></i> Ok</button>
                                    <button type="reset" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>  
<script>
    function choseType(sel) {
        var id = sel.value;
        if (id == 1) {
            $("#label_block_1").show();
            $("#label_block_2").hide();
            $("#label_block_3").hide();
        } else if (id == 2) {
            $("#label_block_1").hide();
            $("#label_block_2").show();
            $("#label_block_3").hide();
        } else if (id == 3) {
            $("#label_block_1").hide();
            $("#label_block_2").hide();
            $("#label_block_3").show();
        }
    }
</script>
@stop