<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shop extends Model {

    protected $table = "bn_shops";
	
    public function insertData($data) {
        try {
            Shop::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function UpdateData($id, $data) {
        try {
            Shop::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>