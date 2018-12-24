<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
class Setting extends Controller
{
    public function setting()
    {
    	
    	return $this->fetch();
	}
	public function dosetting(){
	    $oldPwd=input('post.oldPwd');
	    $newPwd=input('post.newPwd');
	    $surePwd=input('post.surePwd');
	    
	    $email = session('email');
	    $password = session('password');
	    if($oldPwd != $password){
	        $this->error('原密码输入错误');	        
	    }
	    else{
	        if(Db::table('customer')->where('email',$email)->update(['password'=>$surePwd])){
	            session('password',$surePwd);
	            $this->success('修改成功！');
	        }else{
	            $this->error('修改失败，请重试！');
	        }    
	    }
	    
	}
}
