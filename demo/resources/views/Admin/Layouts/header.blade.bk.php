<?php
	use App\Http\Controllers\ContactController;
	$contact = new ContactController;
	$count_notification = $contact->getCountNotification();
	$notification = $contact->getListNotification();
?>
<header class="page-header">
    <nav class="navbar mega-menu" role="navigation">
        <div class="container-fluid">
            <div class="clearfix navbar-fixed-top">
                <!-- Brand and toggle get grouped for better mobile display -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
                <!-- End Toggle Button -->

                <!-- BEGIN LOGO -->
                <a id="index" class="page-logo" href="">
                    <img src="{{Asset('public/adpc/images/logo.png')}}" alt="Logo">
                </a>
                <!-- END LOGO -->

                <!-- BEGIN SEARCH -->
                <!--form class="search" action="extra_search.html" method="GET">
                    <input type="name" class="form-control" name="query" placeholder="Search...">
                    <a href="javascript:;" class="btn submit"><i class="fa fa-search"></i></a>
                </form-->
                <!-- END SEARCH -->

                <!-- BEGIN TOPBAR ACTIONS -->
                <div class="topbar-actions">
					<!-- BEGIN GROUP NOTIFICATION -->
					<div class="btn-group-notification btn-group" id="header_notification_bar">
						<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							<span class="badge"><?php echo $count_notification?></span>
						</button>
						<ul class="dropdown-menu-v2">
							<li class="external">
								<h3><span class="bold"><?php echo $count_notification?> pending</span> notifications</h3>
								<a href="{{Asset('/'.trans('layout.local_admin').'/notification')}}">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
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
					</div>
					<!-- END GROUP NOTIFICATION -->
					<!-- BEGIN GROUP INFORMATION -->
					<div class="btn-group-red btn-group">
						<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="fa fa-plus"></i>
						</button>
						<ul class="dropdown-menu-v2" role="menu">
							<li class="active">
								<a href="#">New Post</a>
							</li>
							<li>
								<a href="#">New Comment</a>
							</li>
							<li>
								<a href="#">Share</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">Comments <span class="badge badge-success">4</span> </a>
							</li>
							<li>
								<a href="#">Feedbacks <span class="badge badge-danger">2</span> </a>
							</li>
						</ul>
					</div>
					<!-- END GROUP INFORMATION -->
                    <!-- BEGIN USER PROFILE -->
                    <div class="btn-group-img btn-group">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img src="{{Asset('public/adpc/images/avatar1.jpg')}}" alt="">
                        </button>
                        <ul class="dropdown-menu-v2" role="menu">
                            <li>
                                <?php
									if(Session::get('login_adpc')['fullname'] != '') echo Session::get('login_adpc')['fullname'];
									else echo Session::get('login_adpc')['mobile'];
								?>
                            </li>                            
							<li>
                                <a href="{{Asset('/'.trans('layout.local_admin').'/logout')}}">Sign Out</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END USER PROFILE -->
                </div>
                <!-- END TOPBAR ACTIONS -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav text-uppercase">
                    <li class="dropdown dropdown-fw open selected">
                        <a href="javascript:;">
                            {{trans('layout.dashboard')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fw">
                            <li class="active"><a href="">Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-fw">
                        <a href="javascript:;">
                            {{trans('layout.config')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fw">
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/shop-info')}}">{{trans('layout.shop_info')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/config-shop')}}">{{trans('layout.shop_config_default')}}</a></li>                       
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/config-campaign')}}">{{trans('layout.shop_config_campaign')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/campaign')}}">{{trans('layout.list_campaign')}}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-fw">
                        <a href="javascript:;">
                            {{trans('layout.user')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fw">
							<li><a href="{{Asset('/'.trans('layout.local_admin').'/import-user')}}">{{trans('layout.import_user')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/user')}}">{{trans('layout.list_user')}}</a></li>
                        </ul>
                    </li>                     
					<li class="dropdown dropdown-fw">
                        <a href="javascript:;">
                            {{trans('layout.sales')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fw">
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/create-user')}}">{{trans('layout.create_user')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/sales/report ')}}">{{trans('layout.sales_report')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/sales/chart ')}}">{{trans('layout.sales_chart')}}</a></li>
                        </ul>
                    </li> 
					<li class="dropdown dropdown-fw">
                        <a href="javascript:;">
                            {{trans('layout.survey')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fw">
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/create-survey')}}">{{trans('layout.create_survey')}}</a></li>
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/survey')}}">{{trans('layout.list_survey')}}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown more-dropdown">
                        <a href="javascript:;" data-close-others="true">
                            More
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="{{Asset('/'.trans('layout.local_admin').'/notice')}}">{{trans('layout.shopcontact')}}</a></li>
                            <li><a href="">FAQ</a></li>
                            <li><a href="">Terms &amp; Conditions</a></li>
                            <li><a href="">Contacts</a></li>
                        </ul>
                    </li>                    
                </ul>
            </div>
            <!-- END NAVBAR COLLAPSE -->
        </div>
        <!--/container-->
    </nav>
</header>