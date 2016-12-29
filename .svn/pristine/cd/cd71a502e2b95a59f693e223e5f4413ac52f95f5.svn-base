<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
//require_once 'log.php';

//初始化日志
/*
$logHandler= new CLogFileHandler("logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);
*/
//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}



//①、获取用户openid
$tools = new JsApiPay();

$str =  http_build_query($_REQUEST);

$openId = $tools->GetOpenid($str);



$product_id = "123456789";
//$body = $_REQUEST['body'];
$attach = "test";
//$trade_no = WxPayConfig::MCHID.date('YmdHis',$_POST['orderdate']);//$_POST['order_id'];
$price =  $_REQUEST['tfee']*100;
//$tag = $_REQUEST['tag'];



//②、统一下单
$input = new WxPayUnifiedOrder();

$input->SetAppid(WxPayConfig::APPID);//商户ID
$input->SetMch_id(WxPayConfig::MCHID);
$input->SetNonce_str("5K8264ILTKCH16CQ2502SI8ZNMTM67VS");
$input->SetBody("充值");//设置商品或支付单简要描述
$input->SetAttach("test");// 设置附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));//设置商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号
$input->SetTotal_fee($price);//设置订单总金额，只能为整数，详见支付金额
$input->SetTime_start(date("YmdHis"));//设置订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010
$input->SetTime_expire(date("YmdHis", time() + 600));//设置订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010
$input->SetGoods_tag("test");//设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
$input->SetNotify_url("http://m.xinyicaijing.com/Extend/weipay/native_notify.php");//设置接收微信支付异步通知回调地址
$input->SetTrade_type("JSAPI");//设置取值如下：JSAPI，NATIVE，APP，
$input->SetOpenid($openId);//设置trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的Openid。




$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>订单支付信息</b></font><br/>';

$jsApiParameters = $tools->GetJsApiParameters($order);


$SetOut_trade_no = $input->GetOut_trade_no();

//获取共享收货地址js函数参数
//$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
    <script type="application/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_msg);
				if(res.err_msg=="get_brand_wcpay_request:ok"){
					successjs();
					//check_order();
				}
			}
		);
	}
	function check_order()
	{
				
		$.post("/weipay/check_order.php", { "trade_id":"<?php echo $SetOut_trade_no ?>","fee":"<?php echo $price ?>"}, function (ret) {		
			var st = ret;
		    alert(st+':'+parseInt('2'));		
		    alert(st == 2);
			if(parseFloat(rs) == parseFloat('2'))
			{
			   successjs();	
			}else{
				return false;	
			}
		});
		
			 
	}
	function successjs()
	{

			  	window.location.href="http://m.xinyicaijing.com/index.php/Home/User/notify/?order_id=<?php echo $_REQUEST['order_id'] ?>";


	}
			 		 
	function callpay()
	{
       
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}

	}

	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		  //      document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		   //     document.attachEvent('WeixinJSBridgeReady', editAddress); 
		  //      document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
		//	editAddress();
		}
	};
	
	</script>
</head>



  <body style="background-color: #eeeeee" onLoad="callpay()">
   <div class="payBox">
     <div class="money">该笔订单支付金额为</div>
     <p class="sum">￥<?php  echo floatval($price)/100 ;?></p>
     <ul class="list">
       <li>
         <div class="list_left">商城订单号：</div>
         <div class="list_right"><?php echo $_REQUEST['order_id']; ?></div>
       </li>
       <li>
         <div class="list_left">创建时间：</div>
         <div class="list_right"><?php echo date('Y-m-d H:i:s',time()); ?></div>
       </li>
     </ul>
     <div class="submit">
       <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" id="pay_info" onclick="callpay()">立即支付</button>
     </div>
   </div>  



  </body>

<style type="text/css">
	/* css reset www.admin10000.com */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td { margin:0; padding:0; }
/**{ margin:0; padding:0; color:#333;}*/
body{ font: 12px/1.5 "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","Heiti SC","WenQuanYi Micro Hei",sans-serif; }
/*h1, h2, h3, h4, h5, h6 { font-weight:normal; font-size:100%; }*/
h3{display: block;font-size: 1.5em;webkit-margin-before:1em;webkit-margin-after: 1em;webkit-margin-start: 0px;webkit-margin-end: 0px;}
a{  text-decoration:none; cursor: pointer;}
a:hover { text-decoration:none; cursor:pointer; }
table { border-collapse:collapse; }
img { border:none; }
html {overflow-y: scroll;} 
.clearfix:after {content: "."; display: block; height:0; clear:both; visibility: hidden;}
.clearfix { *zoom:1; }
ol,ul,li { list-style-type:none; }
input,select,button{border: none; -ms-border:none;}
@charset "UTF-8";
.payBox{
	width: 100%;
	margin: 0 auto;
}
.payBox .money{
   text-align: center;
   color: #353535;
   font-weight: 600;
   font-size: 14px;
   margin-top: 30px;
}
.payBox .sum{
	text-align: center;
	color: #353535;
    font-size: 28px;
    margin: 10px auto 20px;
}
.payBox .list{
	background-color: #fff;
	padding-top: 10px;
	padding-bottom: 10px;
}
.payBox .list li{
	overflow: hidden;
	width: 90%;
	margin: 0 auto;
	height: 35px;
	line-height: 35px;
	font-size: 14px;
	color: #717171;
}
.payBox .list li .list_left{
	float: left;
}
.payBox .list li .list_right{
   float: right;
}
.payBox .submit{
	width: 100%;
	margin: 70px auto 0;
	text-align: center;
}
.payBox .submit input{
	width: 80%;
	height: 50px;
	line-height: 50px;
	margin: 0 auto;
	color: #fff;
	background-color: #fe6714;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	font-weight: bold;
	font-size: 18px;
}
</style>
</html>