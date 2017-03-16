<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model {

    protected $table = "bn_contact_user_shop";

	 public function pagingSearch($page, $id_shop, $id_user = null) {
        try {
            $data = Contact::select('*')->where('id_shop',$id_shop)->where('id_rep',0);
            if ($id_user != null) {
                $data = $data->where('email', 'like', '%' . $name . '%')
                        ->orWhere('fullname', 'like', '%' . $name . '%');
            }
            $data = $data->orderBy('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	public function getTopNotification($id_shop){//lấy 6 thông báo mới nhất
		try {
            $data = Contact::select('*')->where('id_shop', $id_shop)->where('id_rep', 0)->where('status', 0)->skip(0)->take(6)->orderBy('id','desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}		
	
	public function getContactByHashcode($hashcode){
		try {
            $data = Contact::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}		
	
	public function getRepContact($id){
		try {
            $data = Contact::select('*')->where('id_rep', $id)->orderBy('time_send','asc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}	
	
	public function getCountNotification($id_shop){//lấy số tin nhắn chưa đọc 
		try {
            $data = Contact::select('id')->where('id_shop', $id_shop)->where('id_rep', 0)->where('status', 0)->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}
	
	public function UpdateData($id, $data) {
        try {
            Contact::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Contact::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
	/*
    public function pagingSearch($page, $name = '',$id_shop) {
        try {
            $data = Contact::select('*')->where('id_shop',$id_shop);
            if ($name != '') {
                $data = $data->where('email', 'like', '%' . $name . '%')
                        ->orWhere('fullname', 'like', '%' . $name . '%');
            }
            $data = $data->orderBy('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function getListCampaignActive($id_shop) {//lấy những khoảng thời gian của các chiến dịch được active
        try {
            $time = time();//Trạng thái =  active, Campaign chưa kết thúc
            $data = Contact::select('id','start_date','finish_date')->where('id_shop', $id_shop)->where('status', 1)->where('finish_date','>', $time)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function getCampaignUsing($id_shop) {//lấy campaign được áp dụng tại thời điểm hiện tại nếu có
        try {
            $time = time();//Trạng thái =  active, Campaign chưa kết thúc
            $data = Contact::select('*')->where('id_shop', $id_shop)->where('status', 1)->where('start_date','<', $time)->where('finish_date','>', $time)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function checkConfig($id_shop) {
        try {
            $data = Contact::select('*')->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }   

	public function getCampaignByHashcode($hashcode,$id_shop) {
        try {
            $data = Contact::select('*')->where('hashcode', $hashcode)->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
*/



}

?>