<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Receiver;
class Orderconfirm extends Controller{
    public function orderconfirm(){
       
        
//         $rece=Db::table('receiver')->select();
         $vcart=Db::table('vcart')->select();
         $this->assign('vcarts',$vcart);
        return $this->fetch();
    }
}
