<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
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
	        $this->success('添加成功！');
	    }else{
	        $this->error('添加失败，请重试！');
	    }    
	    
	}
}
