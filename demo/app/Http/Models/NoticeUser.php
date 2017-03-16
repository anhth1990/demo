<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class NoticeUser extends Model {

    protected $table = "bn_notice_user";

	public function getCountNotice($id_shop){//lấy số lượng người đã trả lời khảo sát mà Shop chưa xem kết quả
        try {
			$data = NoticeUser::select('*')->where('id_shop',$id_shop)->where('status','=','0')->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }  
	
	public function getTopNotice($id_shop){//lấy 8 tin thông báo mới nhất
        try {
			$data = NoticeUser::select('*')->where('id_shop',$id_shop)->skip(0)->take(8)->orderBy('id','desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }    
	

	
	
	public function pagingSearch($page,$id_shop,$title=null){
		try {
			$data = NoticeUser::select('*')->where('id_shop',$id_shop);
			if($title != null) $data = $data->where('title','like','%'.$title.'%'); 
			$data = $data->orderBy('id','desc')->paginate($page);                                      
			return $data;
		} catch (Exception $e) {
			return $e;
		}
	}
	
//=======================================================================
    public function UpdateData($id, $data) {
        try {
            NoticeUser::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            NoticeUser::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>