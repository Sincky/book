<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Receiver;
use app\index\model\Customer;
use app\index\model\Neworder;
use app\index\model\OrderInfo;
use app\index\model\Cart;
use app\index\model\Shoplist;
use app\index\model\Book;
use app\index\model\Showorder;
use app\index\model\Showshoplist;



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
//    	        $custID=customer::where(session('email'),'custID')->find();
 	        $order->email=session('email');
//  	        $a=input('post.receID');加不了这个
//  	        alert($a);
//  	        $order->payway="payway";
	        $order->recename=input('post.receName');
	        $order->receadd=input('post.receAdd');
	        $order->createtime=date('Y-m-d');
 	        $order->save();
 	        
//   	        $myorderinfo=new OrderInfo();加上这个就出错
//   	        $orderinfobookid=input('post.bookID');
//    	        $myorderinfo->orderID=$order->orderID;
//   	        $orderinfo->bookNum=input('post.bookNum');
//   	        $orderinfo->bookID=input('post.bookID');
 	       
//     	    $myorderinfo->save();
	         
// 	        alert($order->email);
	         
	    
// 	        $sch="email='".session('email')."' and createtime='".$order->createtime."' and custID=".$order->custID;
// 	        $orderN=Neworder::where($sch)->order('createtime desc')->limit(1)->find();
// 	        $orderID=$orderN->orderID;
	         
// 	        //读取cart中购买的商品信息
// 	        $cartIDs=session('cartIDs');
	    
// 	        $carts=Cart::where('cartID','in',$cartIDs)->select();
// 	        foreach($vcarts as $cart){
// 	            $shoplist=new Shoplist();
	    
// 	            $shoplist->orderID=$orderID;
// 	            $shoplist->bookID=$cart->bookID;
// 	            $shoplist->num=$cart->bookNum;
	    
// 	            $shoplist->save();
	    
// 	            $book=Book::get($cart->bookID);
// 	            //                 $book->SelledNum+=$cart->bookNum;
// 	            $book->save();
	    
// 	            $cart->delete();
// 	        }
  	         
	    });
	       return "success";
        
	
}
public function payment(){
    $email = session('email');
    if (empty($email)) {
        $this->error('请先登录!', 'login/login');
    }
    
    return $this->fetch();
}
public function paysuccess(){
    return $this->fetch();
}
}