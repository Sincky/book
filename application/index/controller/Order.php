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
	    //$data=Neworder::where('custID',$custID)->select();
	    $data=Db::table('vorderinfo')->where('custID',$custID)->select();
	    $this->assign('data',$data);
	    //$data1=Neworder::where('custID',$custID)->find()['orderID'];
	    //$this->assign('orders',$data);
	    
	    //$data=Db::execute("select orderID,bookname,press,price from vorderinfo where orderID='".$data1."'");
	    //$data=Db::execute("select ".'bookNum'.",".'press'.",".'price'.",".'orderstate'." from vorderinfo where custID='".$custID."'");
	    //foreach ($data1 as $orderid){
	       // $data+=Db::execute("select * from vorderinfo where orderID='".$orderid."'");
	   // }
	    
	    //$orderlists=array();
	    //foreach ($data as $showorder){
	        //$orderlistsitems=array();
	        //print_r($orderlistsitems);
	       // $orderID=$showorder->orderID;
	       // echo $orderID ;
	        
	       // $books=Db::table('vorderinfo')->where('orderID',$orderID)->select();
	       // foreach ($books as $book){
	           // print_r($book);
	            //array_push($orderlistsitems,$book);
	        //}
	        
	        
	       // $this->assign('books',$books);
	        
	        //$orderlistsitems=array();
	        //foreach($showorder->vorderinfo as $shoplist){
	            //if($showorder->orderID == $vorderinfo->orderID){
	                //array_push($orderlistitems,$shoplist);
	           // }
	        //}
	        //array_push($orderlists,$orderlistitems);
	    //}
	    //print_r($orderlistsitems[0]);
	    //array_push($orderlists,$orderlistsitems);
	    
	    //$this->assign('books',$orderlists);
	   // print_r($orderlists);
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
 	            $bookNum=Db::execute("select bookNum from vcart where bookID='".$bookIDs[$i]."'");
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

  	        $bookNum=input('post.bookNum');
   	        $bookID=input('post.bookID');
 	       
//      	    $orderinfo->save();
     	    
     	    $result = Db::execute("insert into orderinfo(orderID,bookID,bookNum) values('".$order->orderID."','".$bookID."','".$bookNum."')");
	        

	         
	        $deletecart=Db::execute("delete from cart where custID='".$custID."' AND bookID='".$bookID."'");
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

public function paysuccess(){
    $email = session('email');
    if (empty($email)) {
        $this->error('请先登录!', 'login/login');
    }
    $custID=customer::where('email',session('email'))->find()['custID'];
    $orderID=Db::execute("select orderID from neworder where custID='".$custID."'");
    $orderID=$orderID;
    //$orderIDs=Neworder::where('custID',$custID)->find()['orderID'];
    //$orderids=count($orderIDs);
    //echo $orderIDs;
    //$orderID=$orderIDs[$orderids];
    //for($i=0;$i<$orderids;++$i){
        //echo $orderIDs[$i];
    //}
    //echo $orderID;
    $total=0;
    $prices = Db::table('vorderinfo')->where('orderID',$orderID)->select();
    $nums = Db::table('vorderinfo')->where('orderID',$orderID)->select();
    foreach ($prices as $i => $price)
    {
        $num=$nums[$i]['bookNum'];
        $total+=($prices[$i]['price']*$num);
    
    }
    echo $total;
    //echo $orders;
    //$bookPrice=Db::table('vorderinfo')->where('orderID',$orderID)->find()['price'];
    //$bookNum=Db::execute("select bookNum from vorderinfo where orderID='".$orderID."'");
    //echo $bookPrice;
    //echo $bookNum;
    $this->assign('total', $total);
    $this->assign('orderId', $orderID);
    
    return $this->fetch();
}
public function orderUpdate(){
    $orderID=input('get.orderID/d');
    $result=Db::execute("delete from neworder where orderID='".$orderID."'");
    $result=Db::execute("delete from orderinfo where orderID='".$orderID."'");
    $this->redirect(url('order/order'));
}
}