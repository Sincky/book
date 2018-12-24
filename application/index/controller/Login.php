<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    public function login()
    {
    	return $this->fetch();
	}
	public function doLogin(){
	    $email=input('post.email');
        $passw=input('post.pwd');
	    $has = db('customer')->where('email', $email)->find();
	    
	    if(empty($email)){
	        $this->error('email不能为空');
	    }
	    else if(empty($has)){
	        $this->error('邮箱错误');
	    }
	    else if(empty($passw)){
	        $this->error('密码不能为空');
	    }
	    else if($has['password'] != $passw){
	        $this->error('密码错误');
	    }
	    session('identity',$has['identity']);
	    session('email',$has['email']);
	    session('password',$has['password']);
	    $this->redirect(url('index/index'));
	}
	
	public  function LogOut(){
	    session('identity',null);
	    session('email',null);
	    session('password',null);
	    $this->redirect(url('index/index'));
	}
	
}
