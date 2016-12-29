<?php
SESSION_START();
//$mch_id=$_GET('mch_id');
$arr = array();
$arr['service'] ="cibwxh5";   //微信公众号支付
//$arr['service'] ="cibweixin";   //微信扫码支付

$arr['version'] = "1.0"; 
$arr['charset'] = "UTF-8"; 
$arr['sign_type'] ="MD5"; 
//$arr['mch_id'] =$mch_id; 
$arr['mch_id'] ='1862';
//$arr['out_trade_no'] =$_GET['openid'].time();
$arr['out_trade_no'] =$_GET['openid'].getMillisecond();
$arr['device_info'] = ""; 
$arr['body'] = "ces"; 
//$arr['sub_openid'] = ""; 
$arr['sub_openid'] = $_GET['openid'];   //用户的openid
//$arr['sub_openid'] = $_SESSION['MyOpenid'];   //用户的openid
$arr['attach'] = ""; 

//$arr['total_fee'] = "0.01"; 
$arr['total_fee'] = $_POST['tfee1'];   //充值金额
$arr['notify_url'] = "http://m.xinyicaijing.com/Extend/kdpay/notify_Url.php";    //接收爱益通知的url
$arr['callback_url'] = "http://m.xinyicaijing.com/Extend/kdpay/callback_Url.php";  //支付完毕后跳转展示给用户的页面
$arr['time_start'] = ""; 
$arr['time_expire'] = ""; 
$arr['goods_tag'] = ""; 
$arr['auth_code'] = ""; 
$arr['nonce_str'] = time(); 

$MyHtml="";

if ($arr['sub_openid']=="")
{
    //没有openid
    $MyHtml="<script>alert('没有获取到正确的用户ID,无法进行支付操作！请重新登录后再进行充值操作。');"
        ."window.location='http://m.xinyicaijing.com/index.php/Home/User/login.html';</script>";
    echo $MyHtml;
    return;
}



ksort($arr);


//为用户生成一个订单
$OrderNumber=$arr['out_trade_no'] ;
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
 
//@session_start();
mysql_query("SET NAMES 'utf8'");

$ssql="select * from wp_userinfo where openid='".$_GET['openid'] ."'";
$sresult=mysql_query($ssql);
//获取用户的id
if($num=mysql_num_rows($sresult)){
    $rss=mysql_fetch_array($sresult);
    $uid=$rss['uid'];
}

$ssql="insert into wp_balance (bptype,bptime,bpprice,uid,bpno,remarks) values ('充值',"
    	    .date(time()).",".$_POST['tfee1'].",'".$uid."','".$OrderNumber."','开始充值') ";
    	$sresult=mysql_query($ssql);

mysql_close();







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
$arr['sign'] =strtoupper(md5($string."&key=cd29c7ad13744a1db72d69f5279541f9")); 

$src = "<xml>";
foreach ($arr as $x=>$x_value)
{
$src .="<".$x .">".  $x_value . "</" .$x .">";
}
$src .="</xml>";
//echo $src;

$ReturnXml=postxml($src,"https://www.iyibank.com/pay/gateway");
//
$TmpStr="";
$TmpStr1="";
$url="https://pay.swiftpass.cn/pay/jspay?token_id=test_my_id&showwxtitle=1";
$token_id="";

if (strstr($ReturnXml,"<![CDATA[Success]]>"))
{
  //获取发起支付的url
  $BeginNum=strpos($ReturnXml,"<token_id>") ;
  $EndNum=strpos($ReturnXml,"</token_id>") ;
  
  $TmpStr=substr($ReturnXml,$BeginNum,$EndNum - $BeginNum);
  $TmpStr1=substr($ReturnXml,$BeginNum + 19,$EndNum - $BeginNum - 22);
  
  $token_id=$TmpStr1;
  $url=str_replace("test_my_id", $TmpStr1,$url);
}

//$HtmlText="<html><head></head><body><div><textarea rows='30' cols='100'>". $TmpStr ."--------".$TmpStr1. "</textarea></div></body></html>";
//$HtmlText="<html><head></head><body><div><textarea rows='30' cols='100'>".$ReturnXml. "</textarea></div></body></html>";

 $HtmlText="<html><head></head><body><div><h1>正在发起支付，请等待...</h1>".
     "<script>window.location='".$url."'</script>".
 "</div></body></html>";

// $HtmlText="<html><head></head><body><div><h1>正在发起支付，请等待...</h1>".
//     "<span>window.location='".$url."'</span>".
//     "</div></body></html>";


echo $HtmlText;


///////////////////////////////
//获取包含毫秒的时间戳
//版本：1.0
//编写：韦东沛
/////////////////////////////
function getMillisecond()
{
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}


/**
	 * 以post方式提交xml到对应的接口url
	 * 
	 * @param string $xml  需要post的xml数据
	 * @param string $url  url
	 * @param bool $useCert 是否需要证书，默认不需要
	 * @param int $second   url执行超时时间，默认30s
	 * @throws WxPayException
	 */
 function postxml($xml,$url)
	{		
$header[] = "Content-type: text/xml";        //定义content-type为xml,注意是数组
$ch = curl_init ($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
$response = curl_exec($ch);
if(curl_errno($ch)){
    print curl_error($ch);
}
curl_close($ch);
return $response;
	}
function send_post($post_data,$url) {  
  
  $postdata = http_build_query($post_data);  
  $options = array(  
    'http' => array(  
      'method' => 'POST',  
      'header' => 'Content-type:application/x-www-form-urlencoded',  
      'content' => $postdata,  
      'timeout' => 15 * 60 // 超时时间（单位:s）  
    )  
  );  
  $context = stream_context_create($options);  
  $result = file_get_contents($url, false, $context);  
  
  return $result;  
}  
  
?>