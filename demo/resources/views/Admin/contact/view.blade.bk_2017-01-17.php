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
						<!-------------------------------------------------------------------------------------------------------------->
						<div class="inbox-content">
							<div class="inbox-view-info">
								<div class="row">
									<div class="col-md-7">
										<span class="bold">
										{{$user->fullname}} </span>
										<span>
										&lt;<?php echo (string)$user->mobile.' - '.$user->email?>&gt; </span>
										:
									</div>
									<div class="col-md-5 inbox-info-btn">
										<div class="btn-group">
											<button data-messageid="23" class="btn blue reply-btn">
											<i class="fa fa-reply"></i> Reply </button>
											<button class="btn blue dropdown-toggle" data-toggle="dropdown">
											<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="javascript:;" data-messageid="23" class="reply-btn">
													<i class="fa fa-reply"></i> Reply </a>
												</li>
												<li>
													<a href="javascript:;">
													<i class="fa fa-trash-o"></i> Delete </a>
												</li>
												<li>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="inbox-view">

							</div>
							<hr>
						</div>
						
						<!-------------------------------------------------------------------------------------------------------------->
						<!--REP-->
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-8">
								<?php if(isset($contacts) && count($contacts)){	
									foreach($contacts as $value){										
								?>
									<span class="bold">
										<?php 									
											if($value['type']==0) echo $user_name;
											else echo $shop_name;
										?>
									</span>
										: {{$value['created_at']}}
									<div class="inbox-view">								
										{{$value->content}}
									</div>	
									<hr>
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