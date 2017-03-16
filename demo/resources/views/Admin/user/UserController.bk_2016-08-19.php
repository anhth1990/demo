<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;

class UserController extends Controller {

    public function __construct() {
        $this->user_model = new User();
        $this->admin_local = trans('layout.local_admin');
    }

    public function register() {
        $keyStr = 'mobile,password';
        $data = $this->getInput($_POST, $keyStr);

        $result = array();
        $user = $this->user_model->checkMobile($data['mobile']);
        if (count($user) > 0) {//có tồn tại sđt
            if ($user->password == "") {//có sđt nhưng chưa đăng ký (trường hợp SHOP thêm)
                $arr_update = array();
                $arr_update['mobile'] = $data['mobile'];               
                $arr_update['password'] = $this->hashMd5($data['password']);
                $arr_update['status'] = 1;
                $arr_update['created_at'] = time();
                $arr_update['updated_at'] = time();
                if ($this->user_model->UpdateData($user->id, $arr_update)) {//thêm mới thành công
                    $result['title'] = 'success';
                    $result['data'] = 'Đăng ký thành công';
                } else {//thêm mới thất bại
                    $result['title'] = 'error';
                    $result['data'] = 'Đăng ký thất bại, vui lòng thử lại';
                }
            } else {//Tồn tại tài khoản -> thông báo đã tồn tại tài khoản, chọn tài khoản đăng ký khác.
                $result['title'] = 'error';
                $result['data'] = 'Số điện thoại đã tồn tại, vui lòng chọn số khác để đăng ký';
            }
        } else {//chưa tồn tại sđt, thêm mới bình thường
            $arr_insert = array();
            $arr_insert['mobile'] = $data['mobile']; 
            $arr_insert['password'] = $this->hashMd5($data['password']);
            $arr_insert['hashcode'] = $this->getHashcode();
            $arr_insert['status'] = 1;
            $arr_insert['created_at'] = time();
            $arr_insert['updated_at'] = time();
            if ($this->user_model->insertData($arr_insert)) {//thêm mới thành công
                $result['title'] = 'success';
                $result['data'] = 'Đăng ký thành công';
            } else {//thêm mới thất bại
                $result['title'] = 'error';
                $result['data'] = 'Đăng ký thất bại, vui lòng thử lại';
            }
        }
        echo json_encode($result);
    }

    public function login() {
        $keyStr = 'mobile,password';
        $data = $this->getInput($_POST, $keyStr);
        $user = $this->user_model->checkLogin($data['mobile'], $this->hashMd5($data['password']));
        $result = array();
        if(count($user)>0){//có tồn tại tài khoản
            $token = $this->getTokenKey($user['mobile']);
            
            //update vào bảng User với token key
            $data_update = array();
            $data_update['_token'] = $token;
            $this->user_model->UpdateData($user['id'],$data_update);
            
            $result['title'] = 'success';
            $datas['user']['mobile'] = $user['mobile'];
            $datas['user']['fullname'] = $user['fullname'];
            $datas['user']['age'] = $user['age'];
            $datas['user']['address'] = $user['address'];
            $datas['user']['point'] = $user['point'];
            $datas['_token'] = $token;
            $result['data'] = $datas;
        }else {
            $result['title'] = 'error';
            $result['data'] = 'Đăng nhập thất bại';
        }
        echo json_encode($result);
    }
    
    public function testApi(){
        $arr = array();
        $arr['name'] = "Name";
        $arr['pass'] = "Pass";
        $arr['_token'] = $this->getTokenKey('0987654321');
        return json_encode($arr);
    }

}

?>