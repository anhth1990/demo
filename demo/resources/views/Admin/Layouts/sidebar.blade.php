<?php
	$stt_menu = Route::getCurrentRoute()->getActionName();
    $dashboard_menu = false;
    $config_menu = false;
    $user_menu = false;
    $sale_menu = false;
    $suvey_menu = false;
    $more_menu = false;
	
	if($stt_menu == "\App\Http\Controllers\ConfigController@info"){
        $config_menu = true;
		$config_1 = true;
    } else $config_1 = false;
	if($stt_menu == "\App\Http\Controllers\ConfigController@config"){
        $config_menu = true;
		$config_2 = true;
    } else $config_2 = false;
	if($stt_menu == "\App\Http\Controllers\ConfigController@campaign"){
        $config_menu = true;
		$config_3 = true;
    } else $config_3 = false;	
	if($stt_menu == "\App\Http\Controllers\ConfigController@indexCampaign"){
        $config_menu = true;
		$config_4 = true;
    } else $config_4 = false;	
	
	//Người dùng
	if($stt_menu == "\App\Http\Controllers\UserController@getImport"){
        $user_menu = true;
		$user_1 = true;
    } else $user_1 = false;
	if($stt_menu == "\App\Http\Controllers\UserController@index"){
        $user_menu = true;
		$user_2 = true;
    } else $user_2 = false;
	
	//Bán hàng
	if($stt_menu == "\App\Http\Controllers\UserController@getCreate"){
        $sale_menu = true;
		$sale_1 = true;
    } else $sale_1 = false;
	if($stt_menu == "\App\Http\Controllers\SaleController@index"){
        $sale_menu = true;
		$sale_2 = true;
    } else $sale_2 = false;
	if($stt_menu == "\App\Http\Controllers\SaleController@chart"){
        $sale_menu = true;
		$sale_3 = true;
    } else $sale_3 = false;	
	
	//Khảo sát
	if($stt_menu == "\App\Http\Controllers\SurveyController@create"){
        $suvey_menu = true;
		$suvey_1 = true;
    } else $suvey_1 = false;	
	if($stt_menu == "\App\Http\Controllers\SurveyController@index"){
        $suvey_menu = true;
		$suvey_2 = true;
    } else $suvey_2 = false;	
	if($stt_menu == "\App\Http\Controllers\SurveyController@view" || $stt_menu == "\App\Http\Controllers\SurveyController@view" || $stt_menu == "\App\Http\Controllers\SurveyController@detailUser"){
        $suvey_menu = true;
    }
	
	//More
	if($stt_menu == "\App\Http\Controllers\ShopContactController@index"){
        $more_menu = true;
		$more_1 = true;
    } else $more_1 = false;		

	if($stt_menu == "\App\Http\Controllers\ShopContactController@create"){
        $more_menu = true;
		$more_2 = true;
    } else $more_2 = false;	
	
	//Dashboard
	if($stt_menu == "\App\Http\Controllers\DashboardController@index"){
        $dashboard_menu = true;	
    }
?>
	<div class="page-sidebar-wrapper">	
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<div class="sidebar-toggler">
					</div>
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?php if($dashboard_menu)echo "active open";?>">
					<a href="{{Asset('/'.trans('layout.local_admin'))}}">
					<i class="icon-home"></i>
					<span class="title">{{trans('layout.dashboard')}}</span>
					<span class="selected"></span>
					<span class="arrow"></span>
					</a>
				</li>
				<li class="<?php if($config_menu)echo "active open";?>">
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">{{trans('layout.config')}}</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<!--li>
							<a href="ecommerce_index.html">
							<i class="icon-home"></i>
							Dashboard</a>
						</li-->
							<li class="<?php if($config_1) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/thong-tin-cua-hang')}}">{{trans('layout.shop_info')}}</a></li>
                            <li class="<?php if($config_2) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/cau-hinh-mac-dinh')}}">{{trans('layout.shop_config_default')}}</a></li>                       
							<li class="<?php if($config_3) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/tao-moi-chien-dich')}}">{{trans('layout.shop_config_campaign')}}</a></li>
                            <li class="<?php if($config_4) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/campaign')}}">{{trans('layout.list_campaign')}}</a></li>
					</ul>
				</li>
				<li class="<?php if($user_menu)echo "active open";?>">
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">{{trans('layout.user')}}</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($user_1) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/import-user')}}">{{trans('layout.import_user')}}</a></li>
						<li class="<?php if($user_2) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/user')}}">{{trans('layout.list_user')}}</a></li>
					</ul>
				</li>
				<li class="<?php if($sale_menu)echo "active open";?>">
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">{{trans('layout.sales')}}</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($sale_1) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/ban-hang/them-moi')}}">{{trans('layout.create_user')}}</a></li>
						<li class="<?php if($sale_2) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/bao-cao ')}}">{{trans('layout.sales_report')}}</a></li>
						<li class="<?php if($sale_3) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/bieu-do-doanh-so ')}}">{{trans('layout.sales_chart')}}</a></li>
					</ul>
				</li>
				<li class="<?php if($suvey_menu)echo "active open";?>">
					<a href="javascript:;">
					<i class="icon-wallet"></i>
					<span class="title">{{trans('layout.survey')}}</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($suvey_1) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/them-khao-sat')}}">{{trans('layout.create_survey')}}</a></li>
						<li class="<?php if($suvey_2) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/survey')}}">{{trans('layout.list_survey')}}</a></li>
					</ul>
				</li>			
				<li class="last <?php if($more_menu)echo "active open";?>">
					<a href="javascript:;">
					<i class="icon-diamond"></i>
					<span class="title">{{trans('layout.notice')}}</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($more_1) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/thong-bao-da-tao')}}">{{trans('layout.shopcontact')}}</a></li>
						<li class="<?php if($more_2) echo "active"?>"><a href="{{Asset('/'.trans('layout.local_admin').'/tao-moi-thong-bao')}}">{{trans('layout.shopcontact_create')}}</a></li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>