<?php

$arr = array();
$arr['service'] ="cibweixin";
$arr['version'] = "1.0"; 
$arr['charset'] = "UTF-8"; 
$arr['sign_type'] ="MD5"; 
$arr['mch_id'] ="121121"; 
$arr['out_trade_no'] = time(); 
$arr['device_info'] = ""; 
$arr['body'] = "ces"; 
$arr['sub_openid'] = ""; 
$arr['attach'] = ""; 

$arr['total_fee'] = "0.01"; 
$arr['notify_url'] = "kdpay/notify_Url.php"; 
$arr['callback_url'] = "同步接收地址"; 
$arr['time_start'] = ""; 
$arr['time_expire'] = ""; 
$arr['goods_tag'] = ""; 
$arr['auth_code'] = ""; 
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
$arr['sign'] =strtoupper(md5($string."&key=cd29c7ad13744a1db72d69f5279541f9")); 

$src = "<xml>";
foreach ($arr as $x=>$x_value)
{
$src .="<".$x .">".  $x_value . "</" .$x .">";
}
$src .="</xml>";
//echo $src;
echo postxml($src,"https://www.iyibank.com/pay/gateway"); 
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