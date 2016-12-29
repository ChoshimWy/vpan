<?php
ignore_user_abort();//关闭浏览器仍然执行
set_time_limit(0);//让程序一直执行下去
//http://www.jingdetouzi.com/coller.html
$interval=1;//每隔1s运行
include_once("xh/functions.php");	
 // do{   
    //获取沥青
//	$content1 = json_encode(getData('hf_cad'));
    $content1 = json_encode(postData());
    $cont1=file_get_contents('xh/conc.txt');

    if($content1!=$cont1){
        echo $content1;
        echo $cont1;
        $of1 = fopen('xh/conc.txt','w+') or die('打开失败');
        fwrite($of1,$content1);
        fclose($of1);

        echo file_get_contents('xh/conc.txt');
    }





    //获取白银
    $content2 = json_encode(getData('xpd'));
    $cont2=file_get_contents('xh/baiyin.txt');
    if($content2!=$cont2){
      $of2 = fopen('xh/baiyin.txt','r+');
      fwrite($of2,$content2);
      fclose($of2);
    }

    //获取现货黄金
    $content3 = json_encode(getData('hf_cad'));
    $cont3=file_get_contents('xh/tong.txt');
    if($content3!=$cont3){
         $of3 = fopen('xh/tong.txt','r+');
         fwrite($of3,$content3);
         fclose($of3);
    }
    

//sleep($interval);//等待时间，进行下一次操作。
//}while(true);