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
}