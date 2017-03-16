<?php
    use App\Http\Controllers\UserController;
    $userControler = new UserController;
?>
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
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('user.history_points')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/bao-cao-nguoi-mua/'.base64_encode($user['hashcode']))}}">{{$user['fullname']}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">{{trans('user.history_points')}}</a>
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
    {{trans('user.user')}}
</h3>  
<?php
    if (isset($history) && count($history) > 0) {
        foreach ($history as $key => $value) {
            ?>
<div class="modal fade" id="basic-{{$value->id}}" tabindex="-1" role="basic-{{$value->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php 
                echo $userControler->viewOrderUsing($value->id_type,$value->type);
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php }} ?>
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('user.history_points')}}
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
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            {{trans('user.fullname')}}
                                        </th>
                                        <th>
                                            {{trans('user.count_buy')}}
                                        </th>
                                        <th>
                                            {{trans('user.total_price')}}
                                        </th>
                                        <th>
                                            {{trans('user.total_profit')}}
                                        </th>
                                        <th>
                                            {{trans('user.total_points')}}
                                        </th>
										<th>
                                            {{trans('user.point_using')}}
                                        </th>                                       
										<th>
                                            {{trans('user.point_availability')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{$user['fullname']}}
                                        </td>

                                        <td>
                                            {{count($history)}}
                                        </td>

                                        <td>
                                            {{number_format($total['total_sales'])}}
                                        </td>
                                        <td>
                                            {{number_format($total['total_profit'])}}
                                        </td>
                                        <td>
                                            {{$point['toltal']}}
                                        </td>                                        
										<td>
                                            {{$point['point_using']}}
                                        </td>                                        
										<td>
                                            {{$point['availability']}}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>

                                        <th>
                                            {{trans('user.date_buys')}}
                                        </th>
                                        <th>
                                            {{trans('user.type_point')}}
                                        </th>
                                        <th>
                                            {{trans('user.point')}}
                                        </th>
                                        <th>
                                            {{trans('user.view')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($history) && count($history) > 0) {
                                        foreach ($history as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $value->created_at ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $type_point[$value['type']] ?>
                                                </td>
                                                <td>
                                                    <?php echo $value->point ?>
                                                </td>
                                                <td>
                                                    <a class="btn default" data-toggle="modal" href="#basic-<?php echo $value->id?>">{{trans('user.view')}} </a>
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
</div>   		
@stop