<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ShopContact extends Model {

    protected $table = "bn_contact_shop_user";

	 public function pagingSearch($page, $id_shop, $id_user = null, $title = null) {
        try {
            $data = ShopContact::select('id','id_shop','hashcode','title','status','created_at')->where('id_shop',$id_shop);
            if ($title != null) {
                $data = $data->where('title', 'like', '%' . $title . '%')
                        ->orWhere('content', 'like', '%' . $title . '%');
            }
            $data = $data->orderBy('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	public function getTopNotification($id_shop){//lấy 6 thông báo mới nhất
		try {
            $data = ShopContact::select('*')->where('id_shop', $id_shop)->where('id_rep', 0)->where('status', 0)->skip(0)->take(6)->orderBy('id','desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}		
	
	public function getContactByHashcode($hashcode){
		try {
            $data = ShopContact::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}		
	public function getIdByHashcode($hashcode){
		try {
            $data = ShopContact::select('id')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}		
	
	public function getRepContact($id){
		try {
            $data = ShopContact::select('*')->where('id_rep', $id)->orderBy('time_send','asc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}	
	
	public function getCountNotification($id_shop){//lấy số tin nhắn chưa đọc 
		try {
            $data = ShopContact::select('id')->where('id_shop', $id_shop)->where('id_rep', 0)->where('status', 0)->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
	}
	
	public function UpdateData($id, $data) {
        try {
            ShopContact::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            ShopContact::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>