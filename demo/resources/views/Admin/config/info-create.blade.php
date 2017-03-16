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
            <a href="">{{trans('config.config_info')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
{{trans('config.config_info')}} <small>{{trans('config.config_info')}}</small>
</h3>
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('config.config_info')}}
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
                                <label class="control-label col-md-2">{{trans('config.sort_name')}}</label>
                                <div class="col-md-4">
                                    <?php echo Form::text('sort_name',null, ["class" => "form-control","id"=>"sort_name","value"=>"{!! old('sort_name') !!}"]);?>   
                                </div>
                                
                                <label id="label_percent" class="control-label col-md-2">{{trans('config.full_name')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4" id="div_percent">
                                    <?php echo Form::text('full_name',null, ["class" => "form-control","id"=>"full_name","value"=>"{!! old('full_name') !!}"]);?>
                                </div>	
                            </div>
                            <div class="form-group">  
                                <label id="label_flat" class="control-label col-md-2">{{trans('config.boss_name')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4" id="div_flat">
                                    <?php echo Form::text('boss_name',null, ["class" => "form-control","id"=>"boss_name","value"=>"{!! old('boss_name') !!}"]);?>
                                </div>	
                                <label class="control-label col-md-2">{{trans('config.email')}}<span class="required" aria-required="true"> * </span></label></label>
                                <div class="col-md-4">
                                    <?php echo Form::text('email',null, ["class" => "form-control","id"=>"email","value"=>"{!! old('email') !!}"]);?>
                                </div>	
                            </div>	                            
							<div class="form-group">  
                                <label id="label_flat" class="control-label col-md-2">{{trans('config.address')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4" id="div_flat">
                                    <?php echo Form::text('address',null, ["class" => "form-control","id"=>"address","value"=>"{!! old('address') !!}"]);?>
                                </div>	
								<label class="control-label col-md-2">{{trans('config.mobile')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4">
                                    <?php echo Form::text('mobile',null, ["class" => "form-control","id"=>"mobile","value"=>"{!! old('mobile') !!}"]);?>
                                </div>	
                            </div>		
                            <div class="form-group">                   											
                               
								<label class="control-label col-md-2">{{trans('config.price')}}</label>
                                <div class="col-md-4">
                                    <?php echo Form::text('price',null, ["class" => "form-control","id"=>"price","value"=>"{!! old('price') !!}"]);?>
                                </div>	
                            </div>	
							<div class="form-group">                   											
                                <label class="control-label col-md-2">{{trans('config.image')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-4">
                                    <?php echo Form::file('image',null, ["class" => "form-control","id"=>"image","value"=>"{!! old('image') !!}"]);?>
                                </div>		
                            </div>	
							<div class="form-group">                   											
                                <label class="control-label col-md-2">{{trans('config.introduct')}}<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-10">
                                    <?php echo Form::textarea('introduct',null, ["class" => "form-control","id"=>"introduct","value"=>"{!! old('introduct') !!}"]);?>
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
@stop