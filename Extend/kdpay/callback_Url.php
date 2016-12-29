<?php
include_once("config.php");
$HtmlText="<html><head></head><body><div><h1>充值操作完毕！</h1>".
    "<script>window.location='http://m.xinyicaijing.com'</script>".
    "</div></body></html>";
echo $HtmlText;
return;


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
    	$ssql="insert into wp_balance (bptype,bptime,bpprice,uid,bpno) values ('充值测试',"
    	    .date(time()).",0,'1','0') ";
    	$sresult=mysql_query($ssql);
 
    mysql_close();
    echo "没有数据传过来！";
     return;
 }




$encodeStr=strtoupper(md5($postbuff."key=".$SalfStr));
if(strtoupper($postarr['sign'])==strtoupper($encodeStr))
{
	if($postarr['result_code']=="0") //支付成功
	{
        $ovalue	= $postarr['total_fee'];//$FaceValue;	
        $orderid =$postarr['out_trade_no'];// $OrderId;			
    // $db_user=$conf['db']['user'];
    // $db_pwd=$conf['db']['password'];
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
    //获取支付用户的openid
    $openid=$postarr['openid'];
    
    $ssql="select * from wp_userinfo where openid='".$openid ."'";
    $sresult=mysql_query($ssql);
    
    if($num=mysql_num_rows($sresult)){
    	$rss=mysql_fetch_array($sresult);
    	$uid=$rss['uid'];
    	
    	//获取该用户的当前金额
    	$sql_u="select * from wp_accountinfo where uid=".$uid;
    	$uresult=mysql_query($sql_u);
    	if($unum=mysql_num_rows($uresult)){
    	    //如果存在数据，说明该用户有账户记录，直接更改账号上的金额
    	    //获取用户当前的金额
    	    $rss=mysql_fetch_array($uresult);
    	    $CurrentMoney = $rss['balance'];
    	    $NewMoney=(float)$CurrentMoney + (float) $ovalue;
    	    $ssql="update wp_accountinfo set balance=".$NewMoney." where uid='".$uid."' ";
    	    $sresult=mysql_query($ssql);
    	   
    	}else 
    	{
    	    //如果不存在数据，说明该用户没有账号信息，新增一条账号信息
    	    $ssql="insert into wp_accountinfo (uid,balance) values ('".$uid."',".$ovalue.") ";
    	    $sresult=mysql_query($ssql);
    	}
 
    	//记录用户的充值log
    	$ssql="insert into wp_balance (bptype,bptime,bpprice,uid,bpno) values ('充值',"
    	    .date(time()).",".$ovalue.",'".$uid."','".$postarr['transaction_id']."') ";
    	$sresult=mysql_query($ssql);
    	 
        
        

    }
    
    mysql_close();

	echo "success";	
	}
	else
	{
		echo "支付失败";
	}
}
else
{
	echo "签名验证失败";
}
function xmlToArray($xml){
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $val = json_decode(json_encode($xmlstring),true);
    return $val;
}

?>