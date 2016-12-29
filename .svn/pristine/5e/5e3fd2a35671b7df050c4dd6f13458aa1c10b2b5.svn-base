<?php
include_once("config.php");
//include_once("../config.php");
// $HtmlText="<html><head></head><body><div><h1>充值操作完毕！</h1>".
//     "<script>//window.location='http://m.xinyicaijing.com'</script>".
//     "</div></body></html>";
// echo $HtmlText;
// return;


$input = file_get_contents("php://input"); //接收POST数据

$postarr =xmlToArray($input);
$postbuff = "";
$ArrayValue="";
$ArrayKeyName="";


 if (is_array($postarr))
 {
  
     ksort($postarr);
      
     foreach ($postarr as $x=>$x_value)
     {
         if($x != "sign" &&  $x_value != ""&& !is_array($x_value)){
             $postbuff .= $x . "=" .  $x_value . "&";
         }
     }
     
//     //获取数组的key值
//     $MyKeyNameArray=array_keys($postarr);
//     for ($i= 0;$i< count($postarr); $i++){
//         $ArrayValue= $postarr[$i];
//         $ArrayKeyName=$MyKeyNameArray[$i];
//         if ($ArrayKeyName!="sign" && $ArrayValue != "" && !is_array($ArrayValue))
//         {
//             $postbuff .= $ArrayKeyName . "=" . $ArrayValue . "&";
//         }
//     }
    

 }else 
 {
     $db_user='root';
     $db_pwd='xycj_1125_yun';
     $dbname='vpan';
      
     $db_name=$dbname;
     $db_host='localhost';
     $conn=mysql_connect($db_host,$db_user,$db_pwd);
     if(!$conn){
         die("Can not connect:".mysql_error());
     }
     $dbconn=mysql_select_db($db_name);
     if(!$dbconn){
         die("Can not select this database:".mysql_error($conn));
     }
      
     
     mysql_query("SET NAMES 'utf8'");
     //获取支付用户的openid
     
     //记录用户的充值log
     $ssql="insert into wp_balance (bptype,bptime,bpprice,uid,bpno) values ('没有数据传过来',"
         .date(time()).",0,'1','0') ";
     $sresult=mysql_query($ssql);
     
     mysql_close();
     echo "没有数据传过来！";
     return;
 }

 /////////////////////////////////
 //测试开始

 
 //测试结束
 ////////////////////////////////////////
 
 
 
 

 $db_user='root';
 $db_pwd='xycj_1125_yun';
 $dbname='vpan';
 
 $db_name=$dbname;
 $db_host='localhost';
 $conn=mysql_connect($db_host,$db_user,$db_pwd);
 if(!$conn){
     die("Can not connect:".mysql_error());
 }
 $dbconn=mysql_select_db($db_name);
 if(!$dbconn){
     die("Can not select this database:".mysql_error($conn));
 }
 
 
 
 
 @session_start();
 mysql_query("SET NAMES 'utf8'");


 //数据初始化

$OrderID=$postarr['out_trade_no'];   //本公司的订单id
$ActionType = "充值";  //操作类型
$ActionRemark = "";   //说明
$OutOrderID = $postarr['orderid'];   //外部支付平台的订单的ID
$PayWay = $postarr['service'];        //支付方式
$TotalFee	= $postarr['total_fee'];//支付金额
$uid="";   //用户ID
$MoneyAfterCharge=0;   //充值后金额
$MoneyBeforeCharge=0;   //充值前金额


$encodeStr=strtoupper(md5($postbuff."key=".$SalfStr));
if(strtoupper($postarr['sign'])==strtoupper($encodeStr))   //验证正确处理开始
{
	if($postarr['result_code']=="0") //支付成功处理开始
	{

        //先判断是否重复发过来的数据
        $ssql="select * from wp_balance where bpno='".$OrderID ."' and remarks='支付成功'";
        $sresult=mysql_query($ssql);
        $num=mysql_num_rows($sresult);
        
        if($num>0){
            //重复发过来的数据
            echo "success";
            //直接跳出
            return;
            
        }

        //获取用户id
        $ssql="select * from wp_balance where bpno='".$OrderID ."'";
        $sresult=mysql_query($ssql);
        $num=mysql_num_rows($sresult);
        



        if($num>0){
            $rss=mysql_fetch_array($sresult);
            $uid=$rss['uid'];
        }else
        {
            echo "获取用户ID失败或没有这个用户ID";
            return;
        }



        //获取该用户的当前账户上的金额

         $sql_u="select * from wp_accountinfo where uid=".$uid;
         $uresult=mysql_query($sql_u);
         $unum=mysql_num_rows($uresult);
        if($unum>0){
            //如果存在数据，说明该用户有账户记录，直接更改账号上的金额
            //获取用户当前的金额
            $rss=mysql_fetch_array($uresult);
            $MoneyBeforeCharge = $rss['balance'];
            //把用户充值的金额加入账户上
            $MoneyAfterCharge=(float)$MoneyBeforeCharge + (float) $TotalFee;
            //保存金额
            $ssql="update wp_accountinfo set balance=".$MoneyAfterCharge." where uid=".$uid." ";

        
        }else
        {
            //如果不存在数据，说明该用户没有账号信息，新增一条账号信息
            //把用户充值金额增加到账户上
            $MoneyAfterCharge=(float) $TotalFee;
            $ssql="insert into wp_accountinfo (uid,balance) values (".$uid.",".$MoneyAfterCharge.") ";

        }
        $sresult=mysql_query($ssql);

        $ActionRemark="支付成功";   //说明
	    echo "success";	
	}//支付成功处理结束
	else
	{
        $ActionRemark="支付失败";   //说明
		echo "支付失败";
	}
}//验证正确处理结束
else
{
    //验证失败
    $ActionRemark="签名验证失败";
	echo "签名验证失败";
}

//记录用户的操作
$ssql="insert into wp_balance ("
    ."bptype,"
    ."bptime,"
    ."bpprice,"
    ."uid,"
    ."bpno,"
    ."OutOrderID,"
    ."PayWay,"
    ."MoneyBeforeCharge,"
    ."MoneyAfterCharge,"
    ."Remarks".
    ") values ('"
    .$ActionType."',"
    .date(time()).","
    .$TotalFee.","
    .$uid.",'"
    .$OrderID."','"
    .$OutOrderID. "',"
    ."'".$PayWay."',"
    .$MoneyBeforeCharge.","
    .$MoneyAfterCharge.",'"
    .$ActionRemark."'"
    .") ";
$sresult=mysql_query($ssql);

mysql_close();

function xmlToArray($xml){
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $val = json_decode(json_encode($xmlstring),true);
    return $val;
}

?>