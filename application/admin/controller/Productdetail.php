<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class Productdetail extends Controller
{
    public function productdetail()
    {
        $bookID = input('get.bookID');
        $book = Db::table('book')->where('bookID',$bookID)->find();
        $this->assign('book',$book);
        return $this->fetch();
    }
}