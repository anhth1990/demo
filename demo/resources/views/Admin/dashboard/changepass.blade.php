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
            <a href="{{Asset('/'.$admin_local.'/thong-tin-cua-hang')}}">{{trans('layout.profile')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">{{trans('layout.change_pass')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('layout.change_pass')}}
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('layout.change_pass')}}
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
                                <label class="control-label col-md-3">{{trans('dashboard.old_pass')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-3">
                                    <input type="password" class="form-control" id="old_pass" name="old_pass" value="{!! old('old_pass') !!}">
                                </div>                               
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">{{trans('dashboard.new_pass')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-3">
                                    <input type="password" class="form-control" id="password" name="password" value="{!! old('password') !!}">
                                </div>                               
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">{{trans('dashboard.re_pass')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-3">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{!! old('password_confirmation') !!}">
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