<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Notice extends Model {

    protected $table = "bn_notice";

	public function getCountNotice($id_shop){//lấy số lượng người đã trả lời khảo sát mà Shop chưa xem kết quả
        try {
			$data = Notice::select('*')->where('id_shop',$id_shop)->where('status','=','0')->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }  
	
	public function getTopNotice($id_shop){//lấy 8 tin thông báo mới nhất
        try {
			$data = Notice::select('*')->where('id_shop',$id_shop)->skip(0)->take(8)->orderBy('id','desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
	

	
	
	public function pagingSearch($page,$id_shop,$title=null){
		try {
			$data = Notice::select('*')->where('id_shop',$id_shop);
			if($title != null) $data = $data->where('title','like','%'.$title.'%'); 
			$data = $data->orderBy('id','desc')->paginate($page);                                      
			return $data;
		} catch (Exception $e) {
			return $e;
		}
	}
	
	public function UpdateData($url, $data) {
        try {
            Notice::where("url", "=", $url)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
/*
    public function getSurveyByHashCode($hashcode) {
        try {
            $data = Notice::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPoint($code) {
        try {
            $data = Notice::select('*')->where('code', $code)->where('status', 0)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
	
	public function getSurvey($id_shop){//lấy danh sách người đã trả lời khảo sát mà Shop chưa xem kết quả
        try {
			$data = Notice::join('bn_survey_campaigns_user', 'bn_survey_campaigns.hashcode', '=', 'bn_survey_campaigns_user.id_campaign')->join('bn_users', 'bn_survey_campaigns_user.id_user', '=', 'bn_users.id')
				->select('bn_users.fullname','bn_survey_campaigns.id','bn_survey_campaigns_user.id as scu_id','bn_survey_campaigns_user.hashcode','bn_survey_campaigns_user.id_user','bn_survey_campaigns_user.id_campaign','bn_survey_campaigns_user.updated_at');
			$data = $data->where('bn_survey_campaigns.id_shop',$id_shop)->where('bn_survey_campaigns_user.status','=','1')->where('bn_survey_campaigns_user.shop_check','=','0')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }	
	
	public function getListSurvey($page,$id_shop){//lấy danh sách người đã trả lời khảo sát 
        try {
			$data = Notice::join('bn_survey_campaigns_user', 'bn_survey_campaigns.hashcode', '=', 'bn_survey_campaigns_user.id_campaign')->join('bn_users', 'bn_survey_campaigns_user.id_user', '=', 'bn_users.id')
				->select('bn_users.fullname','bn_survey_campaigns.id','bn_survey_campaigns_user.id as scu_id','bn_survey_campaigns_user.hashcode','bn_survey_campaigns_user.id_user','bn_survey_campaigns_user.id_campaign','bn_survey_campaigns_user.time_rep');
			$data = $data->where('bn_survey_campaigns.id_shop',$id_shop)->where('bn_survey_campaigns_user.status','=','1')->orderBy('id','desc')->paginate($page);         
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

//=======================================================================
    public function UpdateData($id, $data) {
        try {
            Notice::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Notice::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
*/
}

?>