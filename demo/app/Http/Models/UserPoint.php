<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserPoint extends Model {

    protected $table = "bn_users_point_history";

    public function pagingSearch($page, $id,$id_shop) {
        try {
            $data = UserPoint::select('*');
            $data = $data->where('id_user',$id)->where('id_shop',$id_shop);
            $data = $data->orderBy('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getUserByHashcode($hashcode){
        try {
            $data = UserPoint::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function checkUser($email) {
        try {
            $data = UserPoint::select('id', 'email')->where('email', $email)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function checkUserByMobile($mobile) {
        try {
            $data = UserPoint::select('id', 'mobile','point')->where('mobile', $mobile)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    

//=======================================================================
    public function UpdateData($id, $data) {
        try {
            UserPoint::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            UserPoint::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>