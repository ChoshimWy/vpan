<?php
error_reporting(0);
    $code=$_GET['code'];
    $interval=$_GET['interval'];
    $type=$_GET['type'];//candlestick   area
    $url = 'http://hqs.91jin.com/getmarketinfo/getKlineList2.do?code='.$code.'&im='.$interval;
    $data = array();
	$response = curl_https($url, $data, $header, 5); 
	$html = json_decode($response,true);
	if(!empty($html)){
		$days_array=$html;
		$new_array = array();
		$j = 99;
		for($i=0; $i <100; $i++)//这个是看你要生成多少个数字，然后循环生成
			{	
				$new_array[$j][0]= $days_array[$i]['Date'];
				$new_array[$j][1]= $days_array[$i]['Open'];
				$new_array[$j][2]= $days_array[$i]['High'];
				$new_array[$j][3]= $days_array[$i]['Low'];
				$new_array[$j][4]= $days_array[$i]['Close'];
				$new_array[$j][5] = date('Y-m-d H:i:s',$days_array[$i]['Date']*0.001);
				$j--; 
		  }
		ksort($new_array);
		$html=json_encode($new_array);	
		echo $html;	
}
  
function curl_https($url, $data=array(), $header=array(), $timeout=30){ 
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true); // 从证书中检查SSL加密算法是否存在 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
	//curl_setopt($ch, CURLOPT_POST, true); 
	//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
	$response = curl_exec($ch); 
	if($error=curl_error($ch)){ 
		die($error); 
	} 
	curl_close($ch); 
	return $response; 
}
?>