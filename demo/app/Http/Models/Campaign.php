<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Campaign extends Model {

    protected $table = "bn_shops_campaign";

    public function pagingSearch($page, $name = '',$id_shop) {
        try {
            $data = Campaign::select('*')->where('id_shop',$id_shop);
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
            $data = Campaign::select('id','start_date','finish_date')->where('id_shop', $id_shop)->where('status', 1)->where('finish_date','>', $time)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function getCampaignUsing($id_shop) {//lấy campaign được áp dụng tại thời điểm hiện tại nếu có
        try {
            $time = time();//Trạng thái =  active, Campaign chưa kết thúc
            $data = Campaign::select('*')->where('id_shop', $id_shop)->where('status', 1)->where('start_date','<', $time)->where('finish_date','>', $time)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function checkConfig($id_shop) {
        try {
            $data = Campaign::select('*')->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }   

	public function getCampaignByHashcode($hashcode,$id_shop) {
        try {
            $data = Campaign::select('*')->where('hashcode', $hashcode)->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }


    public function UpdateData($id, $data) {
        try {
            Campaign::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Campaign::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>