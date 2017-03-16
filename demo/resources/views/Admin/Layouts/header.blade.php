<?php
	use App\Http\Controllers\ContactController;
	use App\Http\Controllers\SurveyController;
	use App\Http\Controllers\NoticeController;
	$contact = new ContactController;
	$survey = new SurveyController;
	$notice = new NoticeController;
	$count_notification = $contact->getCountNotification();//số thông báo khi người dùng gửi contact tới shop
	$notification = $contact->getListNotification();//danh sách thông báo
	
	$count_survey = $survey->getCountSurvey();//lấy số thông báo người dùng trả lời khảo sát
	$surveys = $survey->getSurvey();//lấy số thông báo người dùng trả lời khảo sát
	
	$count_notice = $notice->getCountNotice();//lấy số lượng thông báo mà shop chưa đọc
	$notices = $notice->getTopNotice();//lấy 8 tin thông báo mới nhất	
	
?>
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{Asset('/'.trans('layout.local_admin'))}}">
			<img src="{{Asset('public/adpc/images/logo-yupax.png')}}" alt="logo" class="logo-default" style="margin-top:5px"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!--li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					<?php echo $count_notification?> </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<a href="{{Asset('/'.trans('layout.local_admin').'/notification')}}">{{trans('layout.view_all')}}</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								<?php if(count($notification)> 0){
										foreach($notification as $value){
											?>
											<li>
												<a href="{{Asset('/'.trans('layout.local_admin').'/view-notification/'.base64_encode($value['id']))}}">
													<span class="details">
														<span class="label label-sm label-icon label-info">
															<i class="fa fa-bullhorn"></i>
														</span>
														{{$value['name_notification']}}
													</span>
													<span class="time"><?php echo $value['time_send'];?></span>
												</a>
											</li>											
											<?php
										}
									}?>
							</ul>
						</li>
					</ul>
				</li-->
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<!--li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					{{$count_survey}} </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<a href="<?php echo Asset('/'.trans('layout.local_admin').'/survey-notification');?>">{{trans('layout.view_all')}}</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<?php foreach($surveys as $survey){
									$link = Asset('/'.trans('layout.local_admin').'/nguoi-dung-tra-loi-khao-sat/'.base64_encode($survey['id_campaign']).'?user='.base64_encode($survey['hashcode']));
									?>
								<li>
									<a href="<?php echo $link;?>">
									<span class="photo">
									<img src="{{Asset('public/adpc/images/avatar1.jpg')}}" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									{{$survey['fullname']}} </span>
									<span class="time">{{$contact->genTime(strtotime($survey['updated_at']))}}</span>
									</span>
									<span class="message">
									{{trans('layout.user_rep_survey')}} </span>
									</a>
								</li>
								<?php } ?>	
							</ul>
						</li>
					</ul>
				</li-->
				<!-- END INBOX DROPDOWN -->				
<!-- BEGIN INBOX DROPDOWN -->
				<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					{{$count_notice}} </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<a href="<?php echo Asset('/'.trans('layout.local_admin').'/thong-bao');?>">{{trans('layout.view_all')}}</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<?php foreach($notices as $notice){
									$font = 'none';
									if($notice['status']==0) $font = 'bold';//nếu chưa đọc thì in đậm
									?>
								<li>
									<a href="<?php echo Asset('/'.trans('layout.local_admin').'/'.$notice['url']);?>" style="padding: 8px 14px;">
									<span class="message" style="margin-left: 0px;font-weight:<?php echo $font?>">{{$notice['title']}} </span>
									<span class="time">{{$contact->genTime(strtotime($notice['created_at']))}}</span>
									</a>
								</li>
								<!--li>
									<a href="<?php echo Asset('/'.trans('layout.local_admin').'/'.$notice['url']);?>">
									<span class="photo">
									<img src="{{Asset('public/adpc/images/avatar1.jpg')}}" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									{{$notice['title']}} </span>
									<span class="time">{{$contact->genTime(strtotime($notice['created_at']))}}</span>
									</span>
									<span class="message">
									{{trans('layout.user_rep_survey')}} </span>
									</a>
								</li-->
								<?php } ?>	
							</ul>
						</li>
					</ul>
				</li>
<!-- END INBOX DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<!--li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-calendar"></i>
					<span class="badge badge-default">
					3 </span>
					</a>
					<ul class="dropdown-menu extended tasks">
						<li class="external">
							<h3>You have <span class="bold">12 pending</span> tasks</h3>
							<a href="page_todo.html">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">New release v1.2 </span>
									<span class="percent">30%</span>
									</span>
									<span class="progress">
									<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
									</span>
									</a>
								</li>								
							</ul>
						</li>
					</ul>
				</li>
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="{{Asset('public/adpc/images/avatar1.jpg')}}"/>
					<span class="username username-hide-on-mobile">
					<?php
						if(Session::get('login_adpc')['shop_name'] != '') echo Session::get('login_adpc')['shop_name'];
						else echo Session::get('login_adpc')['username'];
					?>
					</span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="{{Asset('/'.trans('layout.local_admin').'/thong-tin-cua-hang')}}">
							<i class="icon-user"></i> {{trans('layout.profile')}} </a>
						</li>
						<li>
							<a href="<?php echo Asset('/'.trans('layout.local_admin').'/thong-bao');?>">
							<i class="icon-envelope-open"></i> {{trans('layout.inbox')}} <!--span class="badge badge-danger">
							<?php //echo $count_notification?> </span-->
							</a>
						</li>						
						<li>
							<a href="{{Asset('/'.trans('layout.local_admin').'/doi-mat-khau')}}">
							<i class="icon-lock"></i> {{trans('layout.change_pass')}}
							</a>
						</li>
						<li>
							<a href="{{Asset('/'.trans('layout.local_admin').'/logout')}}">
							<i class="icon-key"></i> {{trans('layout.logout')}} </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>