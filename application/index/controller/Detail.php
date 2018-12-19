<?php
/**
 * Created by PhpStorm.
 * User: Sincky
 * Date: 2018/12/18 0018
 * Time: 16:40
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\Cart as CartModel;

class Detail extends Controller
{
    public function detail()
    {
        $bookID = input("get.bookID");
        if(empty($bookID))
        {
            $this->error("无法查询此商品");
        }
        // 查询此id的信息
        $good = Db::table('book')->where('bookID',$bookID)->find();
        $comments = Db::table('comment')->where('bookID',$bookID)->select();

        if(empty($good))
        {
            $this->error("数据库查询失败！");
        }
        //获取评论对应的名字
        foreach ($comments as $i => $comment)
        {
            $customer = Db::table('customer')->where('custID',$comment['custID'])->find();
            $comments[$i]['name'] = $customer['username'];

        }
        // 设置页面变量
        $this->assign('good',$good);
        $this->assign('comments',$comments);

        return $this->fetch();
    }

    public function addCart($bookID,$bookNum)
    {
        $email = session('email');
        if(empty($email)){
            $this->error('请先登录!','login/login');
        }
        $custID = Db::table('customer')->where('email',$email)->find()['custID'];
        
        $dbBook = CartModel::get(['custID'=>$custID,'bookID'=>$bookID]);
        if(empty($dbBook)){
            //如果查询为空,则说没有相关商品加入到购物车中
            //加入商品条目到购物车
            Db::transaction(function () use ($custID,$bookID){
                CartModel::create(['custID'=>$custID,'bookID'=>$bookID,'bookNum'=>1]);
            });

            //跳转到购物车
            //$this->redirect(url('cart/cart'));
        }else{
            $dbbookNum = $dbBook->getData('bookNum') + $bookNum;
            //如果查询不为空，则说明已经有商品加入到购物车中
            //只增加商品数量
            $dbBook->bookNum = $dbbookNum;
            $dbBook->save();

            //跳转到购物车
            //$this->redirect(url('cart/cart'));

        }
        echo '加入购物车成功！~';

    }
}