<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class Orderlist extends Controller
{
    public function orderlist()
    {
        //查询订单表所有的订单
        $orders = Db::table('neworder')->order('orderID','desc')->select();
        foreach ($orders as $key => $order){
            $orderID = $order['orderID'];
            $priceNum = 0.;
            //查询这个订单id所购买的商品
            $books = Db::table('vorderinfo')->where('orderID',$orderID)->select();
            //获取此订单的总额
            foreach ($books as $book){
                $priceNum += ((float)$book['price'])*((float)$book['bookNum']);
            }
            $orders[$key]['priceNum'] = $priceNum;
        }
        $this->assign('orders',$orders);
        return $this->fetch();
    }
}