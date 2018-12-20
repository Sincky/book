<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Orderprocess extends Controller
{
    public function orderprocess()
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

    public function saveState(){
        $orderID = input('get.orderID');
        $state = input('get.state');

        if(Db::table('neworder')->where('orderID',$orderID)->update(['orderstate'=>$state])){
            $this->success('修改成功！',url('orderprocess/orderprocess')."?orderID=".$orderID,'','1');
        }else{
            $this->error('修改失败，请重试！',url('orderprocess/orderprocess')."?orderID=".$orderID,'','3');
        }
    }
}