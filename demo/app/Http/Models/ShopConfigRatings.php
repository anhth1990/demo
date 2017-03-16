<?php namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class ShopConfigRatings extends Model{
	protected $table = "bn_shop_config_ratings";
	public function checkConfig($id_shop){
		try {
			$data = ShopConfigRatings::select('*')->where('id_shop',$id_shop)->first();
			return $data;
		} catch(Exception $e){
			return $e;
		}		
	}
	
	public function UpdateData($id,$data){
		try {
			ShopConfigRatings::where("id","=",$id)->update($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
	public function insertData($data){
		try {
			ShopConfigRatings::insert($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
}

?>