<?php namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Config extends Model{
	protected $table = "bn_shops_config_default";
	public function checkConfig($id_shop){
		try {
			$data = Config::select('*')->where('id_shop',$id_shop)->first();
			return $data;
		} catch(Exception $e){
			return $e;
		}		
	}
	
	public function UpdateData($id,$data){
		try {
			Config::where("id","=",$id)->update($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
	public function insertData($data){
		try {
			Config::insert($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
}

?>