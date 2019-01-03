<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\Receiver;
class Addressadd extends Controller
{
    public function addressadd()
    {
    	
    	return $this->fetch();
	}

	public function doaddressadd(){
	    $name=input('post.name');
	    $address=input('post.address');
	    $tel=input('post.tel');
	    
	    $email = session('email');
	   
	    if($name!=""&&$address!=""&&$tel!=""){
	        $result = Db::execute("insert into Receiver(email,receName,receAdd,recePhone) values('".$email."','".$name."','".$address."','".$tel."')");
	        //$this->success('添加成功！');
	        $this->redirect(url('addressadd/myaddress'));
	    }else{
	        $this->error('添加失败，请重试！');
	    }    
	    
	}
	public function myaddress(){
	    if (empty(session('email'))) {
	        $this->error('请先登录!', 'login/login');
	    }
	    $receivers=Receiver::where('email',session('email'))->select();
	    $this->assign('receivers',$receivers);
	    return $this->fetch();
	}
	public function deleteaddress(){
	    $receID=input('get.receID/d');
	    $result=Db::execute("delete from Receiver where receID='".$receID."'");
	    $this->redirect(url('addressadd/myaddress'));
	}
	public function editaddress(){
	    $receID=input('get.receID/d');
	    $data = Receiver::where('receID',$receID)->find();
	    //print_r($data);
	   // $receiver=Db::execute("select from Receiver where receID='".$receID."'");
	    $this->assign('receiver',$data);
	    return $this->fetch();
	}
	public function addressUpdate(){
	    $receID = input('post.receID');
	    $receName = input('post.receName');
	    $receAdd = input('post.receAdd');
	    $recePhone = input('post.recePhone');
	    try{
	        Db::table('receiver')->where('receID',$receID)->update(['receName'=>$receName,'receAdd'=>$receAdd,'recePhone'=>$recePhone]);
	        echo true;
	    }catch (Exception $e){
	        echo false;
	    }
	}
}
