<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ConfigHistory extends Model {

    protected $table = "bn_shops_config_history";

    public function getConfigById($id) {
        try {
            $data = ConfigHistory::select('*')->where('id', $id)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function getConfigByHashcode($hashcode){
        try {
            $data = ConfigHistory::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function checkConfig($id_shop) {
        try {
            $data = ConfigHistory::select('id', 'id_shop')->where('id_shop', $id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function UpdateData($id, $data) {
        try {
            ConfigHistory::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            ConfigHistory::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>