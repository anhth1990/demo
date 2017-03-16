<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Point extends Model {

    protected $table = "bn_users_point";


    public function checkPoint($hashcode) {
        try {
            $data = Point::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPoint($code) {
        try {
            $data = Point::select('*')->where('code', $code)->where('status', 0)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    

//=======================================================================
    public function UpdateData($id, $data) {
        try {
            Point::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Point::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>