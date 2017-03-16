<?php
	use App\Http\Controllers\ContactController;
	$contact = new ContactController;
?>
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
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('contact.list_contact')}}</a>
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
    {{trans('contact.list_contact')}}
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
						<!--REP-->
						<div class="row">
							<div class="col-md-6"><!---Thông tin khách hàng-->
								<h3>{{trans('contact.user_info')}}</h3>
								<div class="table-scrollable">
									<table class="table table-striped table-bordered table-advance table-hover">
										<thead>
											<tr>
												<th>
													<i class="fa fa-briefcase"></i> 
												</th>
												<th class="hidden-xs">
													<i class="fa fa-bookmark"></i> 
												</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												{{trans('contact.user_name')}}:
											</td>
											<td class="hidden-xs">
												{{$user['fullname']}}
											</td>
										</tr>										
										<tr>
											<td>
												{{trans('contact.user_mobile')}}:
											</td>
											<td class="hidden-xs">
												{{$user['mobile']}}
											</td>
										</tr>										
										<tr>
											<td>
												{{trans('contact.user_email')}}:
											</td>
											<td class="hidden-xs">
												{{$user['email']}}
											</td>
										</tr>										
										<tr>
											<td>
												{{trans('contact.user_address')}}:
											</td>
											<td class="hidden-xs">
												{{$user['address']}}
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6 bold">{{$shop_name}}</div>
									<div class="col-md-6 bold" style="text-align: right !important;">{{$user_name}}</div>
								</div>
								
								<br/>	

								
								<?php if(isset($contacts) && count($contacts)){	
									foreach($contacts as $value){	
										if($value['type']==0){//user_name
											?>
										<div class="row">
											<div class="col-md-3 bold"></div>
											<div class="col-md-9 " style="background: #BDBDBD66;border-radius: 4px !important;padding: 5px;">{{$value->content}} - <small style="color: #b6b6b6;"><?php echo $value['created_at'] ?></small></div>
										</div>
								<?php			
										}else{//shop_name
											?>
										<div class="row">					
											<div class="col-md-9 " style="background: #BDBDBD66;border-radius: 4px !important;padding: 5px;">{{$value->content}}  - <small style="color: #b6b6b6;"><?php echo $value['created_at'] ?></small></div>
											<div class="col-md-3 bold"></div>
										</div>
								<?php			
										}
										
								?>
								<br/>
								<?php }} ?>
							</div>
						</div>
						<div class="row">
							<form action="" method="post">
							<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
							<input type="hidden" name="c_id" id="c_id" value="<?php echo $hash;?>">
							<div class="col-md-4">
							</div>
							<div class="col-md-8">
								<textarea class="inbox-editor inbox-wysihtml5 form-control" name="content" rows="8"></textarea>	
							</div>
							<div class="col-md-12">
								<button data-messageid="23" class="btn blue reply-btn right">
								<i class="fa fa-reply"></i> Reply </button>
							</div>
							
						</div>
							
						<!--REP-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   		
@stop