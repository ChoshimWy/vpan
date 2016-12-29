<?php
namespace Home\Controller;
use Think\Controller;
/**
 * Created by PhpStorm.
 * User: xinyicaijing
 * Date: 2016/11/23
 * Time: 下午4:09
 */
class GetDataController
{
    public function index(){
        echo '测试';
    }

    public function getDataList(){
       $db = M('catproduct');
        $data = $db->select();
        echo $data;
    }
}