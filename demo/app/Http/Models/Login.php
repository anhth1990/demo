<?php namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Login extends Model{
	protected $table = "bn_shops";
	public function checkUser($user='',$password=''){
		try {
			$data = Login::select('*')->where('username','=',$user)->where('password','=',$password)->first();
			return $data;
		} catch(Exception $e){
			return $e;
		}		
	}
	
	public function UpdateData($id,$data){
		try {
			Login::where("id","=",$id)->update($data);
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}	
}

?>