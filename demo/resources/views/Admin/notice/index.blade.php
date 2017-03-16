@extends('Admin.Layouts.default')
@section('content')
  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('layout.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">{{trans('contact.notice_shop')}}</a>
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
    {{trans('contact.notice_shop')}}
</h3> 
<!--====================================================================================================================================-->
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
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
						<?php
						if (isset($notices) && count($notices) > 0) {
							foreach ($notices as $key => $value) {
								?>
								
						 <?php }
                                } ?>		
                        <div class="table-scrollable">
                            <table class="table"> <!--table-striped table-bordered table-advance table-hover--> 
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
										<th>
                                            {{trans('contact.title')}}
                                        </th>                                       
                                        <th>
                                            {{trans('contact.time')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($notices) && count($notices) > 0) {
                                        foreach ($notices as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo ($key+1); ?></a>
                                                </td>
                                                <td>
                                                    <a href="{{Asset($value->url)}}"><?php echo $value->title ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $value->created_at ?>
                                                </td>
                                            </tr>
                                        <tbody class="main-id-<?php echo $value->id; ?>" style="display:none;"></tbody>
                                    <?php }
                                } ?>	
                                </tbody>
                            </table>
                        </div>
						<?php 
							if(isset($_GET['search_name'])) {
									echo $notices->appends(['search_name' => isset($_GET['search_name'])?strip_tags($_GET['search_name']):'','search_cat'=>isset($_GET['search_cat'])?strip_tags($_GET['search_cat']):''])->render();
							}
							else {
									echo $notices->render();
							}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   		
@stop