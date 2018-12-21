<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Register extends Controller
{
    public function register(){
        return $this->fetch();
    }
    public function doregister()
    {
        $email=input('post.email');
        $username =input('post.name');
        $password=input('post.pwd');
        $phone=input('tel');

        $emailexist = db('customer')->where('email', $email)->find();
        if(empty($emailexist)&& !empty($phone)){
            $result = Db::execute("insert into customer(email,username,password,phone) values('".$email."','".$username."','".$password."','".$phone."')");
            dump($result);          
            $this->success('用户['. $email.']新增成功','login/login');
        }
        elseif (!empty($emailexist)){
            session('emailexits',$emailexist['email']);
            $this->error('您输入的email已被注册！');
        }       
	}

}
