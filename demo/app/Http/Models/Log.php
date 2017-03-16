<?php namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Log extends Model{
	protected $table = "bn_shops_logs";
	public function paging(){
		try {
			$data = Log::orderBy('id','desc')->get();
			return $data;
		} catch (Exception $e) {
			return $e;
		}
	}
	
	public function insertData($data){
		try {
			Log::insert($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
	
	public function updateData($id,$data){
		try {
			Log::where("id","=",$id)->update($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}
	
	public function deleteData($id){
		try {
			Log::where("id","=",$id)->delete();
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}		
}

?>