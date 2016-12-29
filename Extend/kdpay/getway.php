<?php
include_once("config.php");
$P_CardId=$_REQUEST["cardId"];
$P_CardPass=$_REQUEST["cardPass"];
$P_FaceValue=$_REQUEST["price"];
$P_ChannelId=$_REQUEST["P_ChannelId"];
$P_Subject="";
$P_Price=$_REQUEST["price"];
$P_Quantity="1";
$P_Description="";
$P_Notic="";
$P_Bankid=$_REQUEST["pd_FrpId"];//银行ID
$P_Result_url=$result_url;
$P_Notify_url=$notify_url;
if(empty($P_Price)){$P_Price=0;};
if(empty($P_Bankid)){$P_Bankid=0;};
$P_OrderId=$_REQUEST["order_no"];
$preEncodeStr=$UserId."".$SalfStr."".$P_OrderId."".$P_Price;
$P_PostKey=md5($preEncodeStr);

$params="P_UserId=".$UserId;
$params.="&P_OrderId=".$P_OrderId;
$params.="&P_CardId=".$P_CardId;
$params.="&P_CardPass=".$P_CardPass;
$params.="&P_FaceValue=".$P_FaceValue;
$params.="&P_ChannelId=".$P_ChannelId;
$params.="&P_Subject=".$P_Subject;
$params.="&P_Price=".$P_Price;
$params.="&P_Quantity=".$P_Quantity;
$params.="&P_Description=".$P_Bankid;
$params.="&P_Notic=".$P_Notic;
$params.="&P_Result_url=".$P_Result_url;
$params.="&P_Notify_url=".$P_Notify_url;
$params.="&P_PostKey=".$P_PostKey;

//在这里对订单进行入库保存


$arr = array();
$arr['total_fee'] =$P_Price;
$arr['body'] = "账户充值"; 
$arr['attach'] = "账户充值"; 
$arr['notify_url'] =$P_Notify_url; 
$arr['callback_url'] = $P_Result_url; 
$arr['out_trade_no'] =$P_OrderId; 
$arr['mch_id'] = $UserId; 
$arr['service'] = "qrcode"; 
$arr['nonce_str'] = time(); 
ksort($arr);
$buff = "";
foreach ($arr as $x=>$x_value)
{
if($x != "sign" &&  $x_value != ""&& !is_array($x_value)){
$buff .= $x . "=" .  $x_value . "&";
}
}
		
$buff = trim($buff, "&");
$string =$buff;
//签名步骤二：在string后加入KEY

//echo $string . "&key=".$SalfStr;
$buff .= "&sign=".strtoupper(md5($string . "&key=".$SalfStr));

//下面这句是提交到API
//echo $buff;
header("location:$gateWary?$buff");
function getOrderId()
{
	return date("YmdHis")."".rand(1000000,9999999);
}
?>