<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Fcm extends Model {

    protected $table = "gcm_users2";	
	
	public function getDataByArrayId($arr){
		try {
            $data = Fcm::select('*')->whereIn('id_user', $arr)->orderBy('id_user','desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}	
	/*
	public function getCountNotification($id_shop){//lấy số tin nhắn chưa đọc 
		try {
            $data = Fcm::select('id')->where('id_shop', $id_shop)->where('id_rep', 0)->where('status', 0)->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}
	*/
	public function UpdateData($id, $data) {
        try {
            Fcm::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Fcm::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>