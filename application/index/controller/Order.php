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
	    $custID=customer::where('email',session('email'))->find()['custID'];
// 	    //$data=Neworder::where('custID',$custID)->select();
// 	    $data=Db::table('vorderinfo')->where('custID',$custID)->select(); 
// 	    $this->assign('data',$data);
	    
	    //以下是按照后台评论写的
	    $books = Db::query("select * from book,vorderinfo where book.bookID=vorderinfo.bookID and vorderinfo.custID='".$custID."'");
	    $data = [];
	    foreach ($books as $i => $book){
	        
	        $order=Db::table('vorderinfo')->where('bookID',$book['bookID'])->find();
	        $customer = Db::table('customer')->where('custID',$book['custID'])->find();
	        if(empty($data[$book['orderID']])){
	            $data[$book['orderID']]['orderID'] = $order['orderID'];
	            $data[$book['orderID']]['createtime'] = $order['createtime'];
	            $data[$book['orderID']]['books'] = "";
	        }
	        $data[$book['orderID']]['books'][$book['custID']]['orderID'] = $book['orderID'];
	        $data[$book['orderID']]['books'][$book['custID']]['bookID'] = $book['bookID'];
	        $data[$book['orderID']]['books'][$book['custID']]['bookname'] = $book['bookname'];
	        $data[$book['orderID']]['books'][$book['custID']]['bookNum'] = $book['bookNum'];
	        $data[$book['orderID']]['books'][$book['custID']]['press'] = $book['press'];
	        $data[$book['orderID']]['books'][$book['custID']]['price'] = $book['price'];
	        $data[$book['orderID']]['books'][$book['custID']]['orderstate'] = $book['orderstate'];
	    }
	    // 设置页面变量
	    $this->assign('books',$data);
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
	    //echo "fffff";
	   
	    //事务处理开始
	    Db::transaction(function(){
	       //echo "hhhhh";
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
 	        $bookIDs = $_POST['list'];
 	        $num=count($bookIDs);
 	        for($i=0;$i<$num;++$i){
 	            $bookNum = Db::query("select bookNum from vcart where bookID='".$bookIDs[$i]."' AND custID='".$custID."'")[0]['bookNum'];
 	            //订单信息列表增加
 	            $result = Db::execute("insert into orderinfo(orderID,bookID,bookNum) values('".$order->orderID."','".$bookIDs[$i]."','".$bookNum."')");
 	            //删除购物车对应的订单
 	            $deletecart=Db::execute("delete from cart where custID='".$custID."' AND bookID='".$bookIDs[$i]."'");
 	        }

	    });
	       return "success";
        
	
}

public function paysuccess(){
    $email = session('email');
    if (empty($email)) {
        $this->error('请先登录!', 'login/login');
    }
    $custID=customer::where('email',session('email'))->find()['custID'];
    $orderID=Db::query("select orderID from neworder where custID='".$custID."order by id desc'");
    $orderID= $orderID[0]['orderID'];

    $total=0;
    $books = Db::table('vorderinfo')->where('orderID',$orderID)->select();
  
    foreach ($books as $book)
    {
        $total+=(1*$book['price']*$book['bookNum']);
    }

    $this->assign('total', $total);
    $this->assign('orderId', $orderID);
    
    return $this->fetch();
}
public function orderUpdate(){
    $orderID=input('get.orderID/d');
    $bookID=input('get.bookID/d');
    $result=Db::execute("update neworder set orderstate='已收货' where orderID='".$orderID."'");
    //$result=Db::execute("delete from orderinfo where orderID='".$orderID."' AND bookID='".$bookID."'");
    //$result=Db::execute("delete from vorderinfo where orderID='".$orderID."' AND bookID='".$bookID."'");
    
    $this->redirect(url('order/order'));
}
//评价跳转
 public function evaluate(){
        $orderID = input('get.orderID/d');
        $data = Db::table('vorderinfo')->where('orderID', $orderID)->select();
        $this->assign('results', $data);
        return $this->fetch();
    }
//评价保存
 public function doEvaluate(){
     Db::transaction(function(){
         
         $custID=customer::where('email',session('email'))->find()['custID'];
         $comments = $_POST['listC'];
         $bookIDs = $_POST['listB'];
         $orderID= $_POST['orderID'];
         $time=date('Y-m-d');
         $num=count($comments);
         for($i=0;$i<$num;++$i){
             //$bookNum = Db::query("select bookNum from vcart where bookID='".$bookIDs[$i]."' AND custID='".$custID."'")[0]['bookNum'];
             //订单信息列表增加
             $result = Db::execute("insert into comment(custID,bookID,comment,time) values('".$custID."','".$bookIDs[$i]."','".$comments[$i]."','".$time."')");
             //删除购物车对应的订单
            // $deletecart=Db::execute("delete from cart where custID='".$custID."' AND bookID='".$bookIDs[$i]."'");
             
         }
         $result1=Db::execute("update neworder set orderstate='已评价' where orderID='".$orderID."'");
         
     });
     return "success";
    } 
}