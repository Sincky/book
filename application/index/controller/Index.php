<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {	
        //从数据库读入书本出版分类
		$bclass=Db::table('book')->distinct('true')->field('press')->select();
		$this->assign('bclass',$bclass);
		
		//从主界面获取用户的模糊查询，如无数据，则展示所有商品
		$minprice=input('post.minprice');
		$maxprice=input('post.maxprice');
		$bookname=input('post.bookname');
		$bcls=input('post.bookclass');
		//echo $bcls;
		if(empty($maxprice)){
		    $maxprice=100000;
		}
		if(empty($minprice)){
		    $minprice=0;
		}
		$searchstr = 'price between '. $minprice.' and '.$maxprice;
		if(!empty($bookname)){
		    $searchstr .= " and bookname like '%".$bookname."%'";
		}
		if(!empty($bcls)){
		    $searchstr .= " and press='".$bcls."'";
		}		
		
		//分页的实现
		$pname=input('get.pname');
		echo $pname;
		$pvalue=input('get.pvalue');
		echo $pvalue;
		$pvalue1=input('get.pvalue1');
		$pvalue2=input('get.pvalue2');
		if(empty($pvalue1)){
		    //
		    $goods=Db::table('book')->where( $searchstr)->where($pname,$pvalue)->paginate(12);
		
		}else {
		    $goods=Db::table('book')->where( $searchstr)->where("$pname>$pvalue1")->where("$pname<$pvalue2")->paginate(12);
		}
		
		$page=$goods->render();
		$this->assign('page',$page);
		//写进goods，让html渲染的时候读取
        $this->assign('goods',$goods);
        // 返回渲染好的html
    	return $this->fetch();
	}
}
