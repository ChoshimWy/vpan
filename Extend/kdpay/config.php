<?php
header( "content-type:text/html; charset=utf-8" );
//口袋支付 Kdpay.Com
date_default_timezone_set('PRC');

//接口密钥，需要更换成你自己的密钥，要跟后台设置的一致
//登录API平台，商户管理-->接入方式-->API接入，这里查看自己的密钥和ID
$UserId="1862";//平台商户ID，需要更换成自己的商户ID

$SalfStr="cd29c7ad13744a1db72d69f5279541f9";//商户密钥


//网关地址
$gateWary="https://www.iyibank.com/pay/gateway";


//充值结果后台通知地址
$result_url="http://m.xinyicaijing.com/Extend/kdpay/notify_Url.php";


//充值结果用户在网站上的转向地址
$notify_url="http://m.xinyicaijing.com/Extend/kdpay/callback_Url.php";
?>