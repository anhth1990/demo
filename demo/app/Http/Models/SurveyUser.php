<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SurveyUser extends Model {

    protected $table = "bn_survey_campaigns_user";

	

    public function checkListUserByHashcode($hashcode) {
        try {
            $data = SurveyUser::select('*')->where('id_campaign', $hashcode)->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }	
	
    public function checkUserByHashcodeId($hashcode,$id) {
        try {
            $data = SurveyUser::select('*')->where('id_campaign', $hashcode)->where('id', $id)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }		
    public function getIdByHashcode($hashcode) {
        try {
            $data = SurveyUser::select('id','shop_check')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }	
    public function checkUserByHashcodeCode($id_campaign,$hashcode) {
        try {
            $data = SurveyUser::select('*')->where('id_campaign', $id_campaign)->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }	

    public function checkPoint($hashcode) {
        try {
            $data = SurveyUser::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPoint($code) {
        try {
            $data = SurveyUser::select('*')->where('code', $code)->where('status', 0)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    

//=======================================================================
    public function UpdateData($id, $data) {
        try {
            SurveyUser::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            SurveyUser::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>