<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Productadd extends Controller
{
    public function productadd()
    {
        return $this->fetch();
    }

    public function addproduct(Request $request)
    {

        $files = $request->file('files');
        $book = input('post.book');
        $book = json_decode($book,true);
        try{
            Db::table('book')->insert($book);
            //加入数据库成功，将添加图片
            foreach ($files as  $file){

                $name = $file->getInfo()['name'].'.jpg';
                $filepath = ROOT_PATH.'public/static/img/goods/'.$book['bookID'];
                $file->move($filepath,$name);
            }
            return true;
        }catch (Exception $e){
            echo $e;
            return false;
        }


    }
    public  function uploadfile(){

    }
}

