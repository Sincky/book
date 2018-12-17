<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {
    	//从数据库读入书本
    	$goods = Db::table('book')->select();
		if(empty($goods)){
			$this->error("数据库读取失败!");	
		}
		//写进goods，让html渲染的时候读取
		$this->assign('goods',$goods);
		// 返回渲染好的html
    	return $this->fetch();
	}
}
