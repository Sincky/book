<?php
namespace app\admin\controller;

use think\Controller;

class Productlist extends Controller
{
    public function productlist()
    {
        return $this->fetch();
    }
}