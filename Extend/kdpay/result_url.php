<?
////////////////////////
//本文件没有用
//////////////////////
include_once("config.php");
include_once("../config.php");
$arr = array();
$arr['version'] =$_REQUEST["version"];
$arr['charset'] ="utf-8";
$arr['sign_type'] =$_REQUEST["sign_type"];
$arr['status'] =$_REQUEST["status"];
$arr['message'] =$_REQUEST["message"];
$arr['result_code'] =$_REQUEST["result_code"];
$arr['mch_id'] = $_REQUEST["mch_id"];
$arr['device_info'] = $_REQUEST["device_info"];
$arr['nonce_str'] =$_REQUEST["nonce_str"];
$arr['err_code'] =$_REQUEST["err_code"];
$arr['err_msg'] =$_REQUEST["err_msg"];
$arr['service'] =$_REQUEST["service"];
$arr['total_fee'] =$_REQUEST["total_fee"];
$arr['orderid'] =$_REQUEST["orderid"];
$arr['out_trade_no'] =$_REQUEST["out_trade_no"];
$arr['sign'] =$_REQUEST["sign"];
ksort($arr);
$postbuff = "";
foreach ($arr as $x=>$x_value)
{
			if($x != "sign" &&  $x_value != ""&& !is_array($x_value)){
				$postbuff .= $x . "=" .  $x_value . "&";
			}
}
$preEncodeStr=strtoupper(md5($postbuff."key=".$SalfStr));	
if(strtoupper($preEncodeStr)==strtoupper($arr['sign']))
{
	if($_REQUEST["result_code"]=="0") //支付成功
	{
$ovalue	= $arr['total_fee'];	
$orderid =$arr['out_trade_no'];			
$db_user=$conf['db']['user'];
$db_pwd=$conf['db']['password'];

$db_name=$dbname;
$db_host=$dbhost;
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
$ssql="select * from ssc_member_recharge where state=0 and rechargeId=".$orderid;
$sresult=mysql_query($ssql);
if($num=mysql_num_rows($sresult)){
	$rss=mysql_fetch_array($sresult);
	$uid=$rss['uid'];
	$sql_u="select * from ssc_members where uid=".$uid;
	$uresult=mysql_query($sql_u);
	
$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$ovalue=$ovalue*(1+number_format($czzs/100,2,'.',''));
}
	 if($unum=mysql_num_rows($uresult)){
		$rsu=mysql_fetch_array($uresult);
		$rechargeTime=time();
		$afmoney=$rsu["coin"]+$ovalue;
		$rsc=$rsu["coin"];
		$sql_o="update ssc_member_recharge set state=1,rechargeAmount=".$ovalue.",coin=".$rsc.",rechargeTime=".$rechargeTime." where rechargeId=".$orderid;
		mysql_query($sql_o);
		$sql_2="insert into ssc_coin_log (uid,type,playedID,coin,userCoin,fcoin,liqType,actionUID,actionTime,ActionIP,info,extfield0,extfield1,extfield2)values('".$uid."','0','0','".$ovalue."','".$afmoney."','0','1','0','".$rechargeTime."','0','充值','".$orderid."','".$orderid."','')";

		mysql_query($sql_2);

		$sql_u="update ssc_members set coin=".$afmoney." where uid=".$rss['uid'];
		mysql_query($sql_u);
	 }
}

mysql_close();

	echo "支付成功";	
		
		
		
	}
	else
	{
		//支付失败
		echo "-err";
	}
}
else
{
	echo "-数据被传改";
}
?>