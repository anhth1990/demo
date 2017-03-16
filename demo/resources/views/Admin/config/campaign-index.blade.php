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
            <a href="">{{trans('config.list_campaign')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('config.list_campaign')}}
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('config.list_campaign')}}
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
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        {{trans('config.campaign')}}
                                    </th>
                                    <th>
                                        {{trans('config.start_date')}}
                                    </th>
                                    <th>
                                        {{trans('config.finish_date')}}
                                    </th>
                                    <th>
                                        {{trans('config.status')}}
                                    </th>
                                    <th>
                                        {{trans('config.view')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($campaign) && count($campaign) > 0) {
                                    foreach ($campaign as $key => $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $value->campaign ?></a>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-Y",$value->start_date) ?>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-Y",$value->finish_date) ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $time_now = time();
                                                if($time_now > $value->start_date && $time_now < $value->finish_date){//hiện tại nằm trong khoảng thời gian của chính dịch
                                                    echo '<a href="javascript:;" class="btn default green-stripe">'.trans('config.status_cam_2').'</a>';
                                                }else if($time_now > $value->start_date && $time_now > $value->finish_date){//hiện tại không còn áp dụng campaign nữa, dùng cấu hình mặc định
                                                    echo '<a href="javascript:;" class="btn default disabled">'.trans('config.status_cam_3').'</a>';
                                                }else echo '<a href="javascript:;" class="btn default disabled">'.trans('config.status_cam_1').'</a>';
                                                ?>
                                            </td>
                                            <td>
                                                <a href="{{Asset('/'.$admin_local.'/campaign/view/'.base64_encode($value['hashcode']))}}" class="btn btn-sm grey-cascade">
                                                    {{trans('user.view')}} <i class="fa fa-search"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <tbody class="main-id-<?php echo $value->id; ?>" style="display:none;"></tbody>
                                <?php
                                }
                            }
                            ?>	
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>  
@stop