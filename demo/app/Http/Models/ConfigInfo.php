<?php namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class ConfigInfo extends Model{
	protected $table = "bn_shops_info";
	public function checkInfo($id_shop){
		try {
			$data = ConfigInfo::select('*')->where('id_shop',$id_shop)->first();
			return $data;
		} catch(Exception $e){
			return $e;
		}		
	}
	
	public function UpdateData($id,$data){
		try {
			ConfigInfo::where("id","=",$id)->update($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
	public function insertData($data){
		try {
			ConfigInfo::insert($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
}

?>