<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PointUserShop extends Model {

    protected $table = "bn_users_point_shop";

    public function checkShopUser($id_user,$id_shop) {
        try {
            $data = PointUserShop::select('*')->where('id_user', $id_user)->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    } 

    public function insertData($data) {
        try {
            PointUserShop::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function UpdateData($id, $data) {
        try {
            PointUserShop::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>