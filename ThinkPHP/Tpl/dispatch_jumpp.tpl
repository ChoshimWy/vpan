<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="email=no">
	<title>跳转提示</title>
	<style type="text/css">
		*{ padding: 0; margin: 0; font-family: "Microsoft YaHei", "微软雅黑", "宋体", Arial, Helvetica, sans-serif; }
		body{ background: #000; color: #333; font-size: 16px;  }
		.system-message{ padding: 24px 48px; background-color: #000; opacity: 0.5; width: 100%; height: 2000px; }
		.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
		.system-message .jump{ padding-top: 10px}
		.system-message .jump a{ color: #000; display: block; }
		.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
		.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}


		.fix{ width: 60%; height: 180px; background-color: #262626; position: fixed; z-index: 10; margin-left: 20%; margin-top: 17%; border-radius: 10px;}
		.fix_name{ width: 150px; height: 46px; margin:  auto; font-size: 22px; line-height: 46px; text-align: center; margin-top: 57px;
			background-color: #5fa0f4; color: #fff; }
		.fix p{width: 120px; height: 46px;  padding-top: 10px; margin: auto; font-size: 13px; color: #888888;}
			/*.fix span{ float: right; width:28px; height: 25px; line-height: 25px;  text-align: center; background: linear-gradient(top,#e1a59c,#bc3c27,#b8685a);
            background:-webkit-linear-gradient(top,#e1a59c,#bc3c27,#b8685a); }*/
		.fix span{ float: left; width:100%; height: 35px; line-height: 25px; text-align: right; background-color: #daac33;}
		.fix span a{  text-decoration: none; color: #283445; font-size: 16px; margin-right: 5px; }


	</style>
</head>
<body>
<div class="fix" >
	<span style="display: block; margin-bottom: 20px;"><a href="javascript:history.go(-1)" style="font-size: 26px; 	"> x</a></span>
	<present name="message">
		<div class="fix_name">操作成功</div>
		<else/>
		<p class="error" ><?php echo($error); ?></p>
	</present>
	<!-- <p>5秒之后自动跳转>></p> -->
	<p class="jump" style="margin-top: 25px;">页面自动跳转中<a id="href" href="<?php echo($jumpUrl); ?>"></a> 等待时间：<b id="wait" ><?php echo($waitSecond); ?></b></p>

</div>

<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 3000);
    })();



</script>
</body>
</html>
