<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigRequest;
use App\Http\Requests\ShopInfoRequest;
use App\Http\Requests\CampaignRequest;
use App\Http\Models\Config;
use App\Http\Models\ConfigInfo;
use App\Http\Models\ConfigHistory;
use App\Http\Models\Campaign;
use App\Http\Models\ShopConfigRatings;

class ConfigController extends Controller {

    public function __construct() {
        $this->config_model = new Config();
        $this->config_info_model = new ConfigInfo();
        $this->config_history_model = new ConfigHistory();
        $this->campaign_model = new Campaign();
        $this->config_ratings_model = new ShopConfigRatings();
        $this->admin_local = trans('layout.local_admin');
        $this->id_shop = Session::get('login_adpc')['id'];
    }

    public function config() {
        $admin_local = $this->admin_local;
        $arr_type = array();
        $arr_type['1'] = trans('config.scoring_type_1');
        $arr_type['2'] = trans('config.scoring_type_2');

        $arr_bonus = array();
        $arr_bonus['1'] = trans('config.bonus_type_1');
        $arr_bonus['2'] = trans('config.bonus_type_2');
        $arr_bonus['3'] = trans('config.bonus_type_3');
        $config = $this->config_model->checkConfig($this->id_shop);
        if (count($config) > 0) {//vào để cập nhật dữ liệu
            return view('Admin.config.edit', compact('admin_local', 'arr_type', 'config', 'arr_bonus'));
        } else {//lần đầu vào 
            return view('Admin.config.index', compact('admin_local', 'arr_type', 'arr_bonus'));
        }
    }

    public function postConfig(ConfigRequest $request) {
        $data = $request->input();
        $keyStr = "scoring,block,exchange,pointShare";
        $config = $this->config_model->checkConfig($this->id_shop);
        $hashcode =  $this->getHashcode();
        if (count($config) > 0) {//vào để cập nhật dữ liệu
            $data_update = $this->getInput($data, $keyStr, $status = 1);
            $data_update['hashcode'] = $hashcode;
            $this->config_model->UpdateData($this->id_shop, $data_update);
            $data_update['id_shop'] = $this->id_shop;          
            $data_update['created_at'] = time();
            $data_update['type'] = 1; //cấu hình mặc định
            $this->config_history_model->insertData($data_update);
        } else {//lần đầu vào 
            $data_insert = $this->getInput($data, $keyStr, $status = 1, time());
            $data_insert['id_shop'] = $this->id_shop;
            $data_insert['hashcode'] = $hashcode;
            $this->config_model->insertData($data_insert);
            $data_insert['type'] = 1; //cấu hình mặc định
            $this->config_history_model->insertData($data_insert);
        }
        return redirect('/' . $this->admin_local . '/cau-hinh-mac-dinh');
    }
//Rating
	
    public function rating() {
        $admin_local = $this->admin_local;
        $arr_type = array();
        $arr_type['1'] = trans('config.scoring_type_1');
        $arr_type['2'] = trans('config.scoring_type_2');

        $arr_bonus = array();
        $arr_bonus['1'] = trans('config.bonus_type_1');
        $arr_bonus['2'] = trans('config.bonus_type_2');
        $arr_bonus['3'] = trans('config.bonus_type_3');
        $config = $this->config_model->checkConfig($this->id_shop);
        if (count($config) > 0) {//vào để cập nhật dữ liệu
            return view('Admin.config.rating', compact('admin_local', 'arr_type', 'config', 'arr_bonus'));
        } else {//lần đầu vào 
            return view('Admin.config.rating', compact('admin_local', 'arr_type', 'arr_bonus'));
        }
    }
//Rating
    public function info() {
        $admin_local = $this->admin_local;
        $config = $this->config_info_model->checkInfo($this->id_shop);
        if (count($config) > 0) {//vào để cập nhật dữ liệu
            return view('Admin.config.info-edit', compact('admin_local', 'config'));
        } else {//lần đầu vào 
            return view('Admin.config.info-create', compact('admin_local'));
        }
    }

    public function postInfo(ShopInfoRequest $request) {
        $data = $request->input();
        $keyStr = "sort_name,full_name,boss_name,email,mobile,address,introduct,price";
		       
        $config = $this->config_info_model->checkInfo($this->id_shop);
        if (count($config) > 0) {//vào để cập nhật dữ liệu
            $data_update = $this->getInput($data, $keyStr, $status = 1);
			if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK){
				$data_update['image'] = $this->uploadImages($_FILES);
			} 
            $this->config_info_model->UpdateData($this->id_shop, $data_update);
        } else {//lần đầu vào 
            $data_insert = $this->getInput($data, $keyStr, $status = 1, time());
            $data_insert['id_shop'] = $this->id_shop;
            $data_insert['hashcode'] = Session::get('login_adpc')['hashcode'];
			if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK){echo '123';
				$data_insert['image'] = $this->uploadImages($_FILES);
			}  
            $this->config_info_model->insertData($data_insert);
        }
        return redirect('/' . $this->admin_local . '/thong-tin-cua-hang');
    }

    public function campaign() {
        $admin_local = $this->admin_local;
        $arr_bonus = array();
        $arr_bonus['1'] = trans('config.bonus_type_1');
        $arr_bonus['2'] = trans('config.bonus_type_2');
        $arr_bonus['3'] = trans('config.bonus_type_3');
        return view('Admin.config.campaign-create', compact('admin_local', 'arr_bonus'));
    }

    public function postCampaign(CampaignRequest $request) {
        $data = $request->input();
        $keyStr = "campaign,start_date,finish_date,scoring,block,exchange,pointShare";
        $data_insert = $this->getInput($data, $keyStr, $status = 1, time());
        $data_insert['id_shop'] = $this->id_shop;
        $data_insert['hashcode'] =  $this->getHashcode();
        $data_insert['start_date'] = strtotime($data_insert['start_date']);
        $data_insert['finish_date'] = strtotime($data_insert['finish_date']);
        //check xem thời gian có phù hợp không?
        $listCampaignActive = $this->campaign_model->getListCampaignActive($this->id_shop);
        $check = true;
        foreach($listCampaignActive as $value){
            if(($data_insert['start_date'] > $value['start_date'] && $data_insert['start_date'] < $value['finish_date']) || ($data_insert['finish_date'] > $value['start_date'] && $data_insert['finish_date'] < $value['finish_date'])){
                $check = false;//thời gian đã chọn trong khoảng thời gian đã tồn tại chiến dịch trước đó
            }
        }
        if($check == false){
            echo "<script>alert('".trans('config.duplicate_campaign')."');</script>"; 
            echo "<script>location.href='".Asset('/'. $this->admin_local .'/tao-moi-chien-dich')."'</script>";
        }else{
            $this->campaign_model->insertData($data_insert);
            return redirect('/' . $this->admin_local . '/campaign');
        }
    }

    public function indexCampaign() {
        $admin_local = $this->admin_local;
        $campaign = $this->campaign_model->pagingSearch($this->numberPage(),$name='',$this->id_shop);
        return view('Admin.config.campaign-index', compact('admin_local', 'campaign'));
    }
    
    public function campaignView($hashcode){
        $admin_local = $this->admin_local;
        $campaign = $this->campaign_model->getCampaignByHashcode(base64_decode($hashcode),$this->id_shop);
		if(count($campaign) >0 ){
			$campaign['start_date'] = date("m/d/Y",$campaign['start_date']);
			$campaign['finish_date'] = date("m/d/Y",$campaign['finish_date']);
			$arr_bonus = array();
			$arr_bonus['1'] = trans('config.bonus_type_1');
			$arr_bonus['2'] = trans('config.bonus_type_2');
			$arr_bonus['3'] = trans('config.bonus_type_3');
			return view('Admin.config.campaign-view', compact('admin_local', 'campaign','arr_bonus'));
		}else{
			return view('errors.404');
		}

    }
    
    public function checkUsingCampaign(){//Lấy cấu hình áp dụng cho Shop tại thời điểm hiện tại
        $campaign = $this->campaign_model->getCampaignUsing($this->id_shop);
        $defaul = $this->config_model->checkConfig($this->id_shop);//thông  tin cấu hình mặc định của Shop
        if(count($campaign)>0){//có bản ghi trong bảng config (lưu campaign)
            $time_now = time();
            if($time_now > $campaign['start_date'] && $time_now < $campaign['finish_date']){//hiện tại nằm trong khoảng thời gian của chính dịch
                return $campaign;
            }else{//hiện tại không còn áp dụng campaign nữa, dùng cấu hình mặc định
                return $defaul;
            }
        }else{//không có trong bảng config=>chắc chắn dùng bảng default
            return $defaul;
        }
    }
	
	private function uploadImages($FILE) {
        if (isset($FILE["image"]) && $FILE["image"]["error"] == UPLOAD_ERR_OK) {
            $UploadDirectory = 'public/uploads/shop/avatar/';

            if ($FILE["image"]["size"] > 5242880) {
                return 'error2'; //die("File size is too big!");
            }

            //allowed file type Server side check
            switch (strtolower($FILE['image']['type'])) {
                //allowed file types
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                    break;
                default:
                    return 'error3'; //die('Unsupported File!'); //output error
            }
            $File_Name = strtolower($FILE['image']['name']);
            $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
            $Random_Number = md5(time()); //Random number to be added to name.
            $NewFileName = $Random_Number . $File_Ext; //new file name
            if (move_uploaded_file($FILE['image']['tmp_name'], $UploadDirectory . $NewFileName)) {
                return $UploadDirectory . $NewFileName;
            } else {
                return 'error4';
            }
        }
    }
	
    public function getUsingCampaign(){
        echo "<pre>";
            print_r($this->checkUsingCampaign());
    }
}

?>