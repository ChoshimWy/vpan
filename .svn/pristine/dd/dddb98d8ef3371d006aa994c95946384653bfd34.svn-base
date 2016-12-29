<?php

error_reporting(0);
function getData($code){
    $url = "http://hqs.91jin.com/getmarketinfo/getQuotationByCode2.do?code=".$code;

    //file_get_contents — 将整个文件读入一个字符串
    $newhtml=file_get_contents($url);
    if(!empty($newhtml)){
        $msg = explode(',',$newhtml);

        $hello[1] = str_replace('name:', '',str_replace('"','',$msg[2]));//名字
        $hello[4] = round(str_replace('last:', '',str_replace('"','',$msg[5])), 2);//最新价
        $last[1] = round(str_replace('open:', '',str_replace('"','',$msg[6])), 2);//今开
        $last[4] = round(str_replace('lastclose:', '',str_replace('"','',$msg[10])), 2);//昨收
        $last[2] = round(str_replace('high:', '',str_replace('"','',$msg[7])), 2);//最高
        $last[3] = round(str_replace('low:', '',str_replace('"','',$msg[8])), 2);//最低
    }
    if(!empty($hello[1])&&!empty($hello[4])&&!empty($last[1])&&!empty($last[2])&&!empty($last[3])&&!empty($last[4])){
        return array("name"=>$hello[1],"price"=>$hello[4],"jk"=>$last[1],"zk"=>$last[4],"zg"=>$last[2],"zd"=>$last[3],"class"=>'空山新雨');
    }
}

//////////////////
//作者：韦儒健
//功能说明：请求商品最新价格数据 
//
//版本:1.0
//////////////////////////、
function postData(){
    //59.51.65.127是中南数据服务器
    $url = 'http://59.51.65.127:9081/MIS-Adapter/marketAdapter.action';

    $data = array(
        'ADAPTER' => 'MT2001',
        'MODE' => 'JQ',
        'SIGNATURE' => 'f5a86a62-d964-4946-9a4b-e9527d5c1372'
    );
    $postData = http_build_query($data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postData,
            'timeout' => 15 * 60
        )
    );
    $context = stream_context_create($options);
    $res = json_decode(file_get_contents($url, false, $context),true);

//    echo $res;
    if(!empty($res)){

        $prudctCode = select();

        if ($prudctCode == 'DS1612'){
            $msg = $res["DATAS"][1];

            echo 'DS1612';
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'DS1704'){
            echo 'DS1704';
            $msg = $res["DATAS"][2];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'GJXFZ'){
            echo 'GJXFZ';
            $msg = $res["DATAS"][3];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'GJXQLB'){
            echo 'GJXQLB';
            $msg = $res["DATAS"][4];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'GJXTJ'){
            echo 'GJXTJ';
            $msg = $res["DATAS"][5];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'LFFZC'){
            echo 'LFFZC';
            $msg = $res["DATAS"][6];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'YCZY'){
            echo 'YCZY';
            $msg = $res["DATAS"][7];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }
        else if ($prudctCode == 'YMHSFT'){
            echo 'YMHSFT';
            $msg = $res["DATAS"][8];
            //寫入數據ku
            saveData($msg);
            //寫入TXT
            $hello[1] = $msg[2];//名字
            $hello[4] = $msg[4];//最新价
//            $hello[4] = '500';//最新价
            $last[1] = $msg[3];//今开
            $last[4] = $msg[12];//昨收
            $last[2] = $msg[6];//最高
            $last[3] = $msg[7];//最低
        }else{
            echo 'sssss'+$prudctCode;
        }





    }
    if(!empty($hello[1])&&!empty($hello[4])&&!empty($last[1])&&!empty($last[2])&&!empty($last[3])&&!empty($last[4])){
        return array("name"=>$hello[1],"price"=>$hello[4],"jk"=>$last[1],"zk"=>$last[4],"zg"=>$last[2],"zd"=>$last[3],"class"=>'空山新雨');
    }




}
function saveData($res_data){


    header( "Content-type:text/html;charset=utf-8" );
    $db_host = 'localhost';
    $db_name = 'vpan';
    $db_user = 'root';
    $db_pwd = 'xycj_1125_yun';

//面向过程方式的连接方式

    $mysqli = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);

//判断是否连接成功
    if(!$mysqli ){

        echo mysqli_connect_error();
    }
    echo '连接成功';
    //设置数据库写入的编码方式UTF8
    mysqli_query($mysqli, "SET NAMES UTF8");

<<<<<<< .mine
    $uprice = floor($res_data[4] / 30);
||||||| .r119
    $uprice = round($res_data[4] / 30,0) ;
=======
    $uprice = round($res_data[4] / 30,2) ;
>>>>>>> .r136

    $sql = "UPDATE wp_productinfo SET ptitle = '$res_data[2]', uprice = '$uprice', wave = '1' WHERE wp_productinfo.pid = 1";
    $result = $mysqli->query($sql);
    if($result === false){//执行失败
        echo $mysqli->error;
        echo $mysqli->errno;
    }

//关闭连接
    mysqli_close($mysqli);

}


function select(){
    try{
        header( "Content-type:text/html;charset=utf-8" );
        $db_host = 'localhost';
        $db_name = 'vpan';
        $db_user = 'root';
        $db_pwd = 'xycj_1125_yun';

//面向过程方式的连接方式

//    $mysqli = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
        $db_connect = new mysqli($db_host,$db_user,$db_pwd,$db_name);
        $sql = "SELECT * FROM wp_productmain";

        $re = $db_connect->query($sql);
        //遍历数据
        while ($row=mysqli_fetch_assoc($re)){
//            var_dump($row);

            return $row['ProductCode'];
        }

        $re->close();
        $db_connect->close();


    } catch(Exception $e){}
//    return $result;
}
?>