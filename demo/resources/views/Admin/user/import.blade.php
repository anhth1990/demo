@extends('Admin.Layouts.default')
@section('content')
  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('user.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('user.list_user')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/import-user')}}">{{trans('user.import_user')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('user.user')}} <small>{{trans('user.create_user')}}</small>
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('user.create_user')}}
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
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
                        <div class=" portlet-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#portlet_tab1" data-toggle="tab">
                                        {{trans('user.insert_csv')}} </a>
                                </li>                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_tab1">
                                    <div>
                                        <p>
                                            {{trans('user.guide')}}
                                        </p>
                                        <p>
                                            {{trans('user.guide_link')}}: <a href="{{Asset('/'.$admin_local.'/download-guide')}}"><i class="fa fa-cloud-download"></i></a>
                                        </p>

                                        <form action="{{Asset('/'.$admin_local.'/import-user')}}" method="post" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">{{trans('user.input_csv')}}</label>
                                                    <div class="col-md-9">									
                                                        <input name="FileInput" id="FileInput" type="file" />
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   		
@stop