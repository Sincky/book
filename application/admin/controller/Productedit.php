<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Exception;

class Productedit extends Controller
{
    public function productedit()
    {
        $bookID = input('get.bookID');
        $book = Db::table('book')->where('bookID',$bookID)->find();
        $this->assign('book',$book);
        return $this->fetch();
    }

    public function productUpdate()
    {
        $bookID = input('post.bookID');
        $price = input('post.price');
        $stock = input('post.stock');
        try{
            Db::table('book')->where('bookID',$bookID)->update(['price'=>$price,'stock'=>$stock]);
            echo true;
        }catch (Exception $e){
            echo false;
        }
    }

    public function productdelete()
    {
        $bookID = input('post.bookID');
        try{
            Db::table('book')->where('bookID',$bookID)->delete();
            echo true;
        }catch (Exception $e){
            echo false;
        }
    }
}