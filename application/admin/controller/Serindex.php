<?php
namespace app\admin\controller;

use think\Controller;

class Serindex extends Controller
{
    public function serindex()
    {

    	return $this->fetch();
	}

    public function serhelo()
    {
        return $this->fetch();
    }
}
