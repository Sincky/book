<?php
namespace app\admin\controller;

use think\Controller;

class Serindex extends Controller
{
    public function serindex()
    {
        $username = session('username');
        if(empty($username)){
           $this->error('信息错误，请重新登录！','index/index');
        }
        $this->assign('username',$username);
    	return $this->fetch();
	}

    public function serhelo()
    {
        return $this->fetch();
    }
}
