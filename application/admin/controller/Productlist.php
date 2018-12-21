<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class Productlist extends Controller
{
    public function productlist()
    {
        $books = Db::table('book')->order('pressdate','desc')->select();
        $this->assign('books',$books);
        return $this->fetch();
    }
}