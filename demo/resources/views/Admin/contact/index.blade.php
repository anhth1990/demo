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
            <a href="">{{trans('contact.list_contact')}}</a>
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
                        <i class="fa fa-plus-square"></i>{{trans('contact.list_contact')}}
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
					<!-------------------------------------------------------------------------------------------------------------->
					<div class="inbox-header">
						<h1 class="pull-left">Inbox</h1>
						<form class="form-inline pull-right" action="index.html">
							<div class="input-group input-medium">
								<input class="form-control" placeholder="Password" type="text">
								<span class="input-group-btn">
								<button type="submit" class="btn green"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form>
					</div>
					<div class="inbox-content">
						<table class="table table-striped table-advance table-hover">
							<thead>
							<tr>								
								<th colspan="3">
									<div class="checker"><span><input class="mail-checkbox mail-group-checkbox" type="checkbox"></span></div>
									<!--div class="btn-group">
										<a class="btn btn-sm blue" href="javascript:;" data-toggle="dropdown">
										More <i class="fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu">
											<li>
												<a href="javascript:;">
												<i class="fa fa-pencil"></i> Mark as Read </a>
											</li>
											<li>
												<a href="javascript:;">
												<i class="fa fa-ban"></i> Spam </a>
											</li>
											<li class="divider">
											</li>
											<li>
												<a href="javascript:;">
												<i class="fa fa-trash-o"></i> Delete </a>
											</li>
										</ul>
									</div-->
								</th>
								<th class="pagination-control" colspan="3">
									<!--span class="pagination-info">
									1-30 of 789 </span>
									<a class="btn btn-sm blue">
									<i class="fa fa-angle-left"></i>
									</a>
									<a class="btn btn-sm blue">
									<i class="fa fa-angle-right"></i>
									</a-->
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if (isset($contacts) && count($contacts) > 0) {
								foreach ($contacts as $key => $value) {
									?>
								<tr <?php if($value->status == 0) { ?>class="unread" <?php } ?>data-messageid="<?php echo ($key+1)?>">
									<td class="inbox-small-cells">
										<div class="checker"><span><input class="mail-checkbox" type="checkbox"></span></div>
									</td>
									<td class="inbox-small-cells">
										<i class="fa fa-star"></i>
									</td>
									<td class="view-message hidden-xs">
										 <a href="{{Asset('/'.$admin_local.'/view-notification/'.base64_encode($value->hashcode))}}"><?php echo $full_name[$value->id_user] ?></a>
									</td>
									<td class="view-message ">
										 <?php echo $value->title ?>
									</td>
									<td class="view-message inbox-small-cells">
										<i class="fa fa-paperclip"></i>
									</td>
									<td class="view-message text-right">
										 <?php echo $contact->genTime($value->time_send);?>
									</td>
								</tr>
							<?php }
                                } ?>	
							</tbody>
						</table>
					</div>
					<?php echo $contacts->render();?>
					<!-------------------------------------------------------------------------------------------------------------->
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   		
@stop