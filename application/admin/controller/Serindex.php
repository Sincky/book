<?php
namespace app\admin\controller;

use think\Controller;

class Serindex extends Controller
{
    public function serindex()
    {
        $username = session('username');
        $this->assign('username',$username);
    	return $this->fetch();
	}

    public function serhelo()
    {
        return $this->fetch();
    }
}
