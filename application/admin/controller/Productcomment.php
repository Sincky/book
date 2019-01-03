<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Productcomment extends Controller
{
    public function Productcomment()
    {
        $comments = Db::table('comment')->select();
        $data = [];

        foreach ($comments as $i => $comment){
            $book = Db::table('book')->where('bookID',$comment['bookID'])->find();
            $customer = Db::table('customer')->where('custID',$comment['custID'])->find();
            if(empty($data[$comment['bookID']])){
                $data[$comment['bookID']]['bookname'] = $book['bookname'];
                $data[$comment['bookID']]['comments'] = "";
            }
            $data[$comment['bookID']]['comments'][$comment['custID']]['name'] = $customer['username'];
            $data[$comment['bookID']]['comments'][$comment['custID']]['comment'] = $comment['comment'];
            $data[$comment['bookID']]['comments'][$comment['custID']]['time'] = $comment['time'];
            $data[$comment['bookID']]['comments'][$comment['custID']]['commentID'] = $comment['commentID'];
        }
        // 设置页面变量
        $this->assign('comments',$data);
        return $this->fetch();
    }
    public function deletecomment()
    {
        $commentID = input('post.commentID');
        try{
            Db::table('comment')->where('commentID',$commentID)->delete();
            echo true;
        }catch (Exception $e){
            echo false;
        }
    }
}