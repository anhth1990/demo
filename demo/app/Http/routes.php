<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */ 
Route::get('/', function(){
	echo 'index';
});
Route::filter("check-login", function() {
    if (!Session::has("login_adpc")) {
        return redirect("/admapp/login"); 
    }
});

Route::filter("check-config", function() {
$users = DB::table('bn_shops_config_default')->select('id')->where('id_shop',Session::get('login_adpc')['id'])->first();
$info = DB::table('bn_shops_info')->select('id')->where('id_shop',Session::get('login_adpc')['id'])->first();
$ratings = DB::table('bn_shop_config_ratings')->select('id')->where('id_shop',Session::get('login_adpc')['id'])->first();
    if(count($users) < 1){
        return redirect("/admapp/cau-hinh-mac-dinh"); 
    }
	if(count($info) < 1){
        return redirect("/admapp/thong-tin-cua-hang"); 
    }	
	if(count($ratings) < 1){
        //return redirect("/admapp/cau-hinh-thanh-vien"); 
    }
});
Route::get('/admapp/login', '\App\Http\Controllers\LoginController@getLogin');
Route::post('/admapp/login', '\App\Http\Controllers\LoginController@postLogin');
Route::get('/admapp/logout', '\App\Http\Controllers\LoginController@logout');

Route::group(array('prefix' => 'admapp', 'before' => 'check-login'), function() {
    //Cấu hình Shop
	Route::get('/cau-hinh-mac-dinh', '\App\Http\Controllers\ConfigController@config');
	Route::post('/cau-hinh-mac-dinh', '\App\Http\Controllers\ConfigController@postConfig');    
	
	//Cấu hình xếp hạng thành viên
	Route::get('/cau-hinh-thanh-vien', '\App\Http\Controllers\ConfigController@rating');
	Route::post('/cau-hinh-thanh-vien', '\App\Http\Controllers\ConfigController@postRating');
	
	Route::get('/thong-tin-cua-hang', '\App\Http\Controllers\ConfigController@info');
	Route::post('/thong-tin-cua-hang', '\App\Http\Controllers\ConfigController@postInfo');
	
	Route::group(array('before' => 'check-config'), function() {//cần phải cấu hình điểm thưởng cho Shop trước
		//INDEX
		Route::get('/', '\App\Http\Controllers\DashboardController@index');
		
		//Thanh Thông báo
		Route::get('/thong-bao', '\App\Http\Controllers\NoticeController@index');//trang danh sách các thông báo
		Route::get('/nguoi-dung-tra-loi-thong-bao/{id}/{user}', '\App\Http\Controllers\ShopContactController@viewRep');//type=4: Xem chi tiết Khi user trả lời 1 thông báo của shop
		Route::post('/nguoi-dung-tra-loi-thong-bao/{id}/{user}', '\App\Http\Controllers\ShopContactController@postRep');//Shop trả lời thông báo cho trường hợp trên
		Route::get('/nguoi-dung-tra-loi-khoa-sat/{hashcode}', '\App\Http\Controllers\SurveyController@detailUser');//type=3: Xem chi tiết Khi user trả lời 1 cuộc khảo sát của shop
		Route::get('/nguoi-dung-phan-hoi/{hashcode}', '\App\Http\Controllers\ContactController@view');//type=1: Khi user gửi "Phản hồi" cho Shop
		Route::post('/nguoi-dung-phan-hoi/{hashcode}', '\App\Http\Controllers\ContactController@repView');//Shop trả lời Phản hồi cho trường hợp trên
		
		
		//User
		Route::get('/user', '\App\Http\Controllers\UserController@index');
		Route::get('/ban-hang/them-moi', '\App\Http\Controllers\UserController@getCreate');
		Route::post('/ban-hang/them-moi', '\App\Http\Controllers\UserController@postCreate');
		Route::post('/get-info-user', '\App\Http\Controllers\UserController@getInfo');
		Route::get('/import-user', '\App\Http\Controllers\UserController@getImport');
		Route::post('/import-user', '\App\Http\Controllers\UserController@postImport');
		Route::post('/check-code', '\App\Http\Controllers\PromotionController@checkCode');
		
		Route::get('/bao-cao-nguoi-mua/{hashcode}', '\App\Http\Controllers\UserController@viewUser');
		Route::get('/diem-thuong/{hashcode}', '\App\Http\Controllers\UserController@viewHistoryPoint');
		Route::get('/user/campaign-using/', '\App\Http\Controllers\UserController@viewCampaignUsing');
		Route::post('/create-user-csv', '\App\Http\Controllers\UserController@postCreateCSV');
		Route::get('/download-guide', '\App\Http\Controllers\UserController@downloadGuide');
		
		//Report
		Route::get('/bao-cao', '\App\Http\Controllers\SaleController@index');
		Route::get('/bieu-do-doanh-so', '\App\Http\Controllers\SaleController@chart');
		Route::get('/sales/export-excel-price', '\App\Http\Controllers\SaleController@exportExcelPrice');
		Route::get('/sales/export-pdf-price', '\App\Http\Controllers\SaleController@exportPdfPrice');		
		
		Route::get('/sales/export-excel-order', '\App\Http\Controllers\SaleController@exportExcelOrder');
		Route::get('/sales/export-pdf-order', '\App\Http\Controllers\SaleController@exportPdfOrder');

		//Cấu hình Shop
		Route::get('/campaign', '\App\Http\Controllers\ConfigController@indexCampaign');
		Route::get('/tao-moi-chien-dich', '\App\Http\Controllers\ConfigController@campaign');
		Route::get('/campaign/view/{hashcode}', '\App\Http\Controllers\ConfigController@campaignView');
		Route::post('/tao-moi-chien-dich', '\App\Http\Controllers\ConfigController@postCampaign');
		
		
		//Liên hệ giữa User và shop
		Route::get('/notification', '\App\Http\Controllers\ContactController@index');
		Route::get('/view-notification/{hashcode}', '\App\Http\Controllers\ContactController@view');
		Route::post('/view-notification/{hashcode}', '\App\Http\Controllers\ContactController@repView');
		
		Route::get('/thong-bao-da-tao', '\App\Http\Controllers\ShopContactController@index');
		Route::get('/tao-moi-thong-bao', '\App\Http\Controllers\ShopContactController@create');
		Route::post('/tao-moi-thong-bao', '\App\Http\Controllers\ShopContactController@postCreate');
		Route::get('/view-notice/{hashcode}', '\App\Http\Controllers\ShopContactController@view');
		
		
		//Khảo sát		
		Route::get('/survey', '\App\Http\Controllers\SurveyController@index');
		Route::get('/them-khao-sat', '\App\Http\Controllers\SurveyController@create');
		Route::post('/them-khao-sat', '\App\Http\Controllers\SurveyController@postCreate');
		Route::get('/survey/load-form', '\App\Http\Controllers\SurveyController@loadForm');
		Route::get('/survey/load-form-answer', '\App\Http\Controllers\SurveyController@loadFormAnswer');
		Route::get('/chi-tiet-khoa-sat/{hashcode}', '\App\Http\Controllers\SurveyController@view');
		Route::get('/survey/user/{hashcode}', '\App\Http\Controllers\SurveyController@viewUser');
		Route::get('/nguoi-dung-tra-loi-khao-sat/{hashcode}', '\App\Http\Controllers\SurveyController@detailUser');
		Route::post('/nguoi-dung-tra-loi-khao-sat/load-form', '\App\Http\Controllers\SurveyController@loadFormUser');
		Route::get('/survey-notification', '\App\Http\Controllers\SurveyController@allNotification');
		
		//Đổi mật khẩu
		Route::get('/doi-mat-khau', '\App\Http\Controllers\DashboardController@changePass');
		Route::post('/doi-mat-khau', '\App\Http\Controllers\DashboardController@postChangePass');
		
		//Test lấy cấu hình điểm thưởng được áp dụng
		Route::get('/get-config', '\App\Http\Controllers\ConfigController@getUsingCampaign');
		Route::get('/get-rating-r', '\App\Http\Controllers\RatingController@getRecensyRating');
		Route::get('/get-rating-f', '\App\Http\Controllers\RatingController@getFrequencyRating');
		Route::get('/get-rating-m', '\App\Http\Controllers\RatingController@getMonetaryRating');
		Route::get('/get-rating', '\App\Http\Controllers\RatingController@getRatingUser');
		// test noti
		Route::get('/push-noti', '\App\Http\Controllers\RatingController@getPushNoti');
	});
});
