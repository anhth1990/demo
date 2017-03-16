<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model {

    protected $table = "bn_order";

    public function getListIdUser($id_shop) {//trả về các id_user có mua hàng của Shop này
        try {
            $data = Order::select('id', 'id_user')->where('id_shop', $id_shop)->groupby('id_user')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function getOrderByHashcode($hashcode){
        try {
            $data = Order::select('id','hashcode','type_campaign','id_campaign','date_buy','price','profit','address_shop')->where('hashcode', $hashcode)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function getOrderByIdUser($page,$id_user,$id_shop){
        try {
            $data = Order::select('*')->where('id_user',$id_user)->where('id_shop',$id_shop)->orderby('id', 'desc')->paginate($page);
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }   
    public function getOrderByIdShop($page=null,$id_shop,$start=null,$end=null,$mobile=null){
        try {
			$data = Order::join('bn_users', 'bn_order.id_user', '=', 'bn_users.id')
				->select('bn_order.*', 'bn_users.mobile as u_mobile', 'bn_users.email as u_email', 'bn_users.fullname as u_fullname', 'bn_users.hashcode as u_hashcode');
			$data = $data->where('bn_order.id_shop',$id_shop);
			if($start != null) $data->where('bn_order.date_buy','>=',($start-1));
			if($end != null) $data->where('bn_order.date_buy','<=',($end+1));	
			if($mobile != null) $data->where('bn_users.mobile','=',$mobile);	
			if($page != null) $data = $data->orderby('bn_order.id', 'desc')->paginate($page);
			else $data = $data->orderby('bn_order.id', 'desc')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
	public function getPageChart($id_shop,$start=null,$end=null,$mobile=null){
        try {
			$data = Order::join('bn_users', 'bn_order.id_user', '=', 'bn_users.id')
				->select(DB::raw('SUM(bn_order.price) as price'),DB::raw('SUM(bn_order.profit) as profit'),DB::raw("DATE_FORMAT(FROM_UNIXTIME(bn_order.date_buy), '%Y-%m-%d') AS dates"));
			$data = $data->where('bn_order.id_shop',$id_shop);
			if($start != null) $data->where('bn_order.date_buy','>=',$start);
			if($end != null) $data->where('bn_order.date_buy','<=',$end);	
			if($mobile != null) $data->where('bn_users.mobile','=',$mobile);	
			$data = $data->orderby('bn_order.date_buy', 'asc')->groupby('bn_order.date_buy')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function checkUser($email) {
        try {
            $data = Order::select('id', 'email')->where('email', $email)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function getTotalPrice($id_user,$id_shop) {//lấy tổng giá tiền mà user đã mua của shop, tổng lợi nhuận shop có được
        try {
            $data = Order::select('id', DB::raw('SUM(price) as total_sales'), DB::raw('SUM(profit) as total_profit'), DB::raw('SUM(bonus_points) as bonus_points'))->where('id_user', $id_user)->where('id_shop',$id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	public function getCountOrder($id_shop) {//Lấy số lượt mua hàng theo Shop
        try {
            $data = Order::select('id')->where('id_shop', $id_shop)->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	public function getCountUser($id_shop) {//Lấy số lượng user đã mua hàng ở Shop
		try {
            $data = Order::select('id')->where('id_shop', $id_shop)->groupBy('id_user')->get();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	public function getTotalPriceProfit($id_shop) {//lấy tổng doanh thu, lợi nhuận của shop
        try {
            $data = Order::select('id', DB::raw('SUM(price) as total_sales'), DB::raw('SUM(profit) as total_profit'), DB::raw('SUM(bonus_points) as bonus_points'))->where('id_shop',$id_shop)->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	public function getLastDayBuy($id_shop,$id_user) {//Lấy ngày mua cuối cùng của người dùng với 1 shop
		try {
            $data = Order::select('id','date_buy')->where('id_shop', $id_shop)->where('id_user', $id_user)->orderBy('date_buy','desc')->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
		
	public function getCountFrequency($id_shop,$id_user,$day) {//Lấy số lượng giao dịch trong 1 đơn vị thời gian
		try {
			$date = strtotime(date( 'd-m-Y', time())) - ($day * 86400);
            $data = Order::select('id')->where('id_shop', $id_shop)->where('id_user', $id_user)->where('date_buy','>=', $date)->orderBy('date_buy','desc')->count();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
			
	public function getCountMonetary($id_shop,$id_user,$day) {//Lấy số lượng giao dịch trong 1 đơn vị thời gian
		try {
			$date = strtotime(date( 'd-m-Y', time())) - ($day * 86400);
            $data = Order::select('id',DB::raw('SUM(price) as price'))->where('id_shop', $id_shop)->where('id_user', $id_user)->where('date_buy','>=', $date)->orderBy('date_buy','desc')->first();
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }
	
	
    public function UpdateData($id, $data) {
        try {
            Order::where("id", "=", $id)->update($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function insertData($data) {
        try {
            Order::insert($data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}

?>