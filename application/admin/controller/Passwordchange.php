<?php
namespace app\admin\controller;
use think\Controller;

class passwordchange extends Controller
{
    public function passwordchange(){
        return $this->fetch();
    }
}