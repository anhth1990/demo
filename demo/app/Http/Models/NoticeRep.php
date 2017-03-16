<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class NoticeRep extends Model {

    protected $table = "bn_contact_shop_user_reps";

    public function getCountNotice($id_user) {
        try {
            $data = NoticeRep::select('id')->where('id_user', $id_user)->where('status', 0)->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
	
	public function getRepNoticeByHashcode($hashcode) {
        try {
            $data = NoticeRep::select('*')->where('id_contact', $hashcode)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
	
	public function getNoticeByHashcodeIdUser($hashcode,$user){//Lấy các record trả lời của user khi shop gửi thông báo
        try {
			$data = NoticeRep::select('*')->where('id_contact',$hashcode)->where('id_detail',$user)->orderBy('id','asc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }  
	
    public function insertData($data) {
        try {
            NoticeRep::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function UpdateData($id, $data) {
        try {
            NoticeRep::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>