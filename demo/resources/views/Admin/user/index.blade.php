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
<h3 class="page-title">
    {{trans('user.list_user')}}
</h3>   
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('user.list_user')}}
                    </div>
                </div>
                <div class="portlet light">
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            {{trans('user.fullname')}}
                                        </th>
                                        <th>
                                            {{trans('user.email')}}
                                        </th>
                                        <th>
                                            {{trans('user.age')}}
                                        </th>
                                        <th>
                                            {{trans('user.address')}}
                                        </th>
                                        <th>
                                            {{trans('user.mobile')}}
                                        </th>
                                        <th>
                                            {{trans('user.status')}}
                                        </th>
                                        <th>
                                            {{trans('user.action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($list_user) && count($list_user) > 0) {
                                        foreach ($list_user as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $value->fullname ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $value->email ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->age ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->address ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->mobile; ?>
                                                </td>

                                                <td>
                                                    <?php echo $arr_status[$value->status] ?>
                                                </td>
                                                <td>
                                                    <a href="{{Asset('/'.$admin_local.'/bao-cao-nguoi-mua/'.base64_encode($value['hashcode']))}}" class="btn btn-sm grey-cascade">
                                                        {{trans('user.view')}} <i class="fa fa-search"></i>
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
							//echo $fills_data->setPath('custom/url');
							if(isset($_GET['search_name'])) {
									echo $list_user->appends(['search_name' => isset($_GET['search_name'])?strip_tags($_GET['search_name']):'','search_cat'=>isset($_GET['search_cat'])?strip_tags($_GET['search_cat']):''])->render();
							}
							else {
									echo $list_user->render();
							}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   		
@stop