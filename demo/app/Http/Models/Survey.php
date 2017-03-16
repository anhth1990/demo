<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Survey extends Model {

    protected $table = "bn_survey_campaigns";

	public function pagingSearch($page,$title='',$id_shop){
		try {
			$data = Survey::select('id','title','hashcode','count_user','count_rep','created_at')->where('id_shop',$id_shop);
			if($title != '') $data = $data->where('title','like','%'.$title.'%'); 
			$data = $data->orderBy('id','desc')->paginate($page);                                      
			return $data;
		} catch (Exception $e) {
			return $e;
		}
	}

    public function getSurveyByHashCode($hashcode) {
        try {
            $data = Survey::select('*')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPoint($code) {
        try {
            $data = Survey::select('*')->where('code', $code)->where('status', 0)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function getCountSurvey($id_shop){//lấy số lượng người đã trả lời khảo sát mà Shop chưa xem kết quả
        try {
			$data = Survey::join('bn_survey_campaigns_user', 'bn_survey_campaigns.hashcode', '=', 'bn_survey_campaigns_user.id_campaign')
				->select('bn_survey_campaigns.id');
			$data = $data->where('bn_survey_campaigns.id_shop',$id_shop)->where('bn_survey_campaigns_user.status','=','1')->where('bn_survey_campaigns_user.shop_check','=','0')->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
	
	public function getSurvey($id_shop){//lấy danh sách người đã trả lời khảo sát mà Shop chưa xem kết quả
        try {
			$data = Survey::join('bn_survey_campaigns_user', 'bn_survey_campaigns.hashcode', '=', 'bn_survey_campaigns_user.id_campaign')->join('bn_users', 'bn_survey_campaigns_user.id_user', '=', 'bn_users.id')
				->select('bn_users.fullname','bn_survey_campaigns.id','bn_survey_campaigns_user.id as scu_id','bn_survey_campaigns_user.hashcode','bn_survey_campaigns_user.id_user','bn_survey_campaigns_user.id_campaign','bn_survey_campaigns_user.updated_at');
			$data = $data->where('bn_survey_campaigns.id_shop',$id_shop)->where('bn_survey_campaigns_user.status','=','1')->where('bn_survey_campaigns_user.shop_check','=','0')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }	
	
	public function getListSurvey($page,$id_shop){//lấy danh sách người đã trả lời khảo sát 
        try {
			$data = Survey::join('bn_survey_campaigns_user', 'bn_survey_campaigns.hashcode', '=', 'bn_survey_campaigns_user.id_campaign')->join('bn_users', 'bn_survey_campaigns_user.id_user', '=', 'bn_users.id')
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
            Survey::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Survey::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>