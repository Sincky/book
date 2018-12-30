<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\Cart as CartModel;
class Cart extends Controller
{
 public function cart(){
        if(empty(session('email'))){
            $this->error('请先登录!','login/login');
        }
        $data=Db::table('vcart')->where('email',session('email'))->select();
        $this->assign('result',$data);
        return $this->fetch();
    }
    public function addCart(){
    
        if(empty(session('email'))){
            $this->error('请先登录!','login/login');
        }
        if(empty(input('get.bookID'))){
            $this->error('请选择商品!','index/index');
        }
        $cart=CartModel::where('email',session('email'))->where('bookID',input('get.bookID'))->find();
        if(empty($cart)){
            $cartn=new CartModel();
            $cartn->email=session('email');
            $cartn->bookID=input('get.bookID');
            $cartn->num=1;
            $cartn->save();
        }else{
            $cart->num=$cart->num+1;
            $cart->save();
        }
        $this->redirect(url('cart/cart'));
    }
    public function clearCart(){
        $email=session('email');
        $custID=Db::table('customer')->where('email',$email)->find()['custID'];
        $result	=Db::execute("delete from cart where custID='".$custID."'");
        dump($result);
        $this->redirect(url('cart/cart'));
        
    }
    public function deleteCart(){
        $cartID=input("get.cartID");
        $cart=CartModel::get($cartID);
        
        if($cart){
            $cart->delete();
            $this->redirect(url('cart/cart'));
        }
    }
    public function updateCart(){
    
        $cartID=input('get.cartID');
        $num=input('get.num');
        
        $cart=CartModel::get($cartID);
        $cart->bookNum=$num;
        if($cart->save()){ 
            $this->redirect(url('cart/cart'));
        }else{
            $this->redirect(url('login/login'));
        }
        
    }
}
