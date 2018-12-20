<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Orderdetail extends Controller
{
    public function orderdetail()
    {
        $orderID = input('get.orderID');
        $order =  Db::table('vorderinfo')->where('orderID',$orderID)->select();
        $priceNum = 0.;
        //获取此订单的总额
        foreach ($order as $book){
            $priceNum += ((float)$book['price'])*((float)$book['bookNum']);
        }
        $order[0]['priceNum'] = $priceNum;
        $this->assign('order',$order);
        return $this->fetch();
    }
}