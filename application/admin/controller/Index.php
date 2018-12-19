<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class Index extends Controller
{
   public function index(){
   
       return $this->fetch();
   }
   public function doLogin(){
       $username=input('post.username');
       $passw=input('post.passw');
       $has = db('admin')->where('username', $username)->find();
       
       if(empty($username)){
           $this->error('账号不能为空');
       }
       else if(empty($username)){
           $this->error('账号错误');
       }
       else if(empty($passw)){
           $this->error('密码不能为空');
       }
       else if($has['password'] != $passw){
           $this->error('密码错误');
       }
       session('username',$has['username']);
       $this->redirect(url('Serindex/Serindex'));
      
   }
}
