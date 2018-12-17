<?php
namespace app\admin\controller;

use think\Controller;

class Orderlist extends Controller
{
    public function orderlist()
    {
        return $this->fetch();
    }
}