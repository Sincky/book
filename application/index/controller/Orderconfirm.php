<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Receiver;
use app\index\model\Customer;
session_start();
class Orderconfirm extends Controller{
    public function orderconfirm(){
        if (empty(session('email'))) {
            $this->error('请先登录!', 'login/login');
        }
        
        $data = Receiver::where('custID', session('email'))->select();
        $this->assign('Receivers', $data);
        
        $Custo = Customer::get(session('email'));
        $this->assign('cust', $Custo);
        
        $cartIDs = input('post.cartID/a');
        session('cartIDs',$cartIDs);
        
        session('cartIDs', $cartIDs);
        
        $vcart = Db::table('vcart')->where('cartID', 'in', $cartIDs)->select();
        $this->assign('vcarts', $vcart);
//           $vcart = Db::table('vcart')->select();
//           $this->assign('vcarts', $vcart);

        return $this->fetch();
    }
}
