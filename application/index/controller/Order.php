<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Receiver;
use app\index\model\Customer;
use app\index\model\Neworder;
use app\index\model\Orderinfo;
use app\index\model\Cart;
use app\index\model\Shoplist;
use app\index\model\Book;
use app\index\model\Showorder;
use app\index\model\Showshoplist;



class Order extends Controller
{
    public function order()
    {
        if (empty(session('email'))) {
	        $this->error('请先登录!', 'login/login');
	    }
// 	    $data = Receiver::where('email', session('email'))->select();
// 	    $this->assign('Receivers', $data);
	    
// 	    $cust = Customer::get(session('email'));
// 	    $this->assign('customer', $cust);
	    
// 	    $cartIDs = input('post.cartID/a');
// 	    session('cartIDs',$cartIDs);
	    
// 	    session('cartIDs', $cartIDs);
	    
// 	    $vcart = Db::table('vcart')->where('cartID', 'in', $cartIDs)->select();
// 	    $this->assign('vcart', $vcart);
// 	    return $this->fetch();
	    
	    $custID=customer::where('email',session('email'))->find()['custID'];
	    
	    $data=Neworder::where('custID',$custID)->select();
	    //$data=Db::execute("select ".'bookNum'.",".'press'.",".'price'.",".'orderstate'." from vorderinfo where custID='".$custID."'");
	    
	    $this->assign('data',$data);
        
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
    	    $custID=customer::where('email',session('email'))->find()['custID'];
 	        //支付订单列表更新
 	        $order->custID=$custID;
 	        $order->payway="网上支付";
	        $order->recename=input('post.receName');
	        $order->receadd=input('post.receAdd');
	        $order->createtime=date('Y-m-d');
	        $order->orderstate="处理中";
 	        $order->save();
 	        //订单处理列表 
//   	        $orderinfo=new Orderinfo();
//    	        $orderinfo->orderID=$order->orderID;
  	        //$bookNum=input('post.bookNum');
 	        $bookIDs = $_POST['list'];
 	        $num=count($bookIDs);
 	        for($i=0;$i<$num;++$i){
 	            //echo $bookIDs[$i];
 	            $bookNum=Db::execute("select ".'bookNum'." from vcart where bookID='".$bookIDs[$i]."'");
 	            $result = Db::execute("insert into orderinfo(orderID,bookID,bookNum) values('".$order->orderID."','".$bookIDs[$i]."','".$bookNum."')");
 	            $deletecart=Db::execute("delete from cart where custID='".$custID."' AND bookID='".$bookIDs[$i]."'");
 	            //echo $bookNum;
 	            
 	        }
 	        //request()->post('list/a');
   	        //$bookIDs=input('post.list');
   	        //foreach ($bookIDs as $bookID){
   	           // echo $bookID;
   	            //$bookNum=Db::execute("select from cart where bookID='".$bookID."'");
   	            //$result = Db::execute("insert into orderinfo(orderID,bookID,bookNum) values('".$order->orderID."','".$bookID."','".$bookNum."')");
   	             
   	            
   	            
   	           // $deletecart=Db::execute("delete from cart where custID='".$custID."' AND bookID='".$bookID."'");
   	        
   	        //}
 	       
//      	    $orderinfo->save();
     	    
     	    
//  	        $sch="email='".session('email')."' and createtime='".$order->createtime."' and custID=".$order->custID;
//  	        $orderN=Neworder::where($sch)->order('createtime desc')->limit(1)->find();
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

public function paysuccess(){
    $email = session('email');
    if (empty($email)) {
        $this->error('请先登录!', 'login/login');
    }
    $custID=customer::where('email',session('email'))->find()['custID'];
    $orderID=Db::execute("select orderID from neworder where custID='".$custID."'");
    $orderID=$orderID+1;
    //$orderIDs=Neworder::where('custID',$custID)->find()['orderID'];
    //$orderids=count($orderIDs);
    //echo $orderIDs;
    //$orderID=$orderIDs[$orderids];
    //for($i=0;$i<$orderids;++$i){
        //echo $orderIDs[$i];
    //}
    //echo $orderID;
    $bookPrice=Db::execute("select price from vorderinfo where orderID='".$orderID."'");
    $bookNum=Db::execute("select bookNum from vorderinfo where orderID='".$orderID."'");
    echo $bookNum;
    $this->assign('total', $bookNum*$bookPrice);
    $this->assign('orderId', $orderID);
    
    return $this->fetch();
}
}