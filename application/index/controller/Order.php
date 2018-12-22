<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Receiver;
use app\index\model\Customer;
use app\index\model\Neworder;
session_start();


class Order extends Controller
{
    public function order()
    {
    	return $this->fetch();
    	 
	}
	public function orderconfirm(){
	    if (empty(session('email'))) {
	        $this->error('请先登录!', 'login/login');
	    }
	    
	    $data = Receiver::where('email', session('email'))->select();
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
	public function addOrder(){
	    if (empty(session('email'))) {
	        $this->error('请先登录!', 'login/login');
	    }
	    //事务处理开始
	    Db::transaction(function(){
	        $order=new Neworder();
	        $order->email=session('email');
	        $order->custID=input('post.custID');
	
	        $order->total=input('post.total');
	        
	
	        $order->save();
	
	        
	    });
	        return "success";
	}
}
