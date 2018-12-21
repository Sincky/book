<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\Collect as CollectModel;
class Collect extends Controller
{
    public function collect()
    {
        $email = session('email');
         if(empty($email)){
            $this->error('请先登录!','login/login');
        }
        $custID = Db::table('customer')->where('email',$email)->find()['custID'];
        $goods = Db::table('collect')->where('custID',$custID)->select();
        foreach ($goods as $i => $good)
        {
            $book = Db::table('book')->where('bookID',$good['bookID'])->find();
            $goods[$i]['bookname'] = $book['bookname'];
            $goods[$i]['price'] = $book['price'];
        }
        $this->assign('goods',$goods);
        return $this->fetch();
	}
	public function addcollect(){
	    $email = session('email');
         if(empty($email)){
            $this->error('请先登录!','login/login');
        }
         $custID = Db::table('customer')->where('email',$email)->find()['custID'];
       //  echo $custID;
         $bookID=input('bookID');
    //     echo $bookID;
 	    $collect=CollectModel::where('custID', $custID)->where('bookID',$bookID)->find();
	    if(empty($collect)){
	        $collectn=new CollectModel();
	        $collectn->bookID=$bookID;
	        $collectn->custID=$custID;
	        $collectn->save();
	    }
	    $this->redirect(url('collect/collect'));
	}
}
