<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model {

    protected $table = "bn_users";

    public function pagingSearch($page, $name = '', $arr_id_user) {
        try {
            $data = User::select('*');
            $data = $data->whereIn('id',$arr_id_user);
            if($name != ''){
                $data = $data->where('email', 'like', '%' . $name . '%')
                                ->orWhere('fullname', 'like', '%' . $name . '%');
            }
            $data = $data->orderBy('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getUserByHashcode($hashcode){
        try {
            $data = User::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function checkUser($email) {
        try {
            $data = User::select('id', 'email')->where('email', $email)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function checkUserByMobile($mobile) {
        try {
            $data = User::select('*')->where('mobile', $mobile)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
    public function checkUserById($id) {
        try {
            $data = User::select('*')->where('id', $id)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function getMobile($id) {//lấy danh sách các sđt của những người đã mua hàng của shop
        try {
            $data = User::select('id', 'mobile')->whereIn('id', $id)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
    public function getFullname($id) {//lấy danh sách các tên của những người đã mua hàng của shop
        try {
            $data = User::select('id', 'fullname','mobile','email','hashcode')->whereIn('id', $id)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	public function getNameUser($id) {//lấy  tên của người đã mua hàng của shop
        try {
            $data = User::select('id', 'fullname','mobile','email')->where('id', $id)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    

//=======================================================================
    public function UpdateData($id, $data) {
        try {
            User::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            User::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>