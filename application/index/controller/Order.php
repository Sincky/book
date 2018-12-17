<?php
namespace app\index\controller;

use think\Controller;

class Order extends Controller
{
    public function order()
    {
    	
    	return $this->fetch();
	}
}
