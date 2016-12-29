<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx9923337332ac68e8", "957de6505aa001e3d46819b5bc829e85");
$signPackage = $jssdk->GetSignPackage();
$src = $_GET['src'];

$url = $_GET['url'];
$content = urlencode('http://'.$_GET['url']);
$news = array("Title" =>"微盘交易", "Description"=>"微盘交易", "PicUrl" =>"$src", "Url" =>"$url");    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微盘分享</title>
</head>
<link rel="stylesheet" type="text/css" href="sajs/reset.css">
<link rel="stylesheet" type="text/css" href="sajs/share.css">
<body style="background: url(sajs/bg_1.jpg);background-size: 100% 100%;">
	<div class="box">
		<div class="box_div">
			<p class="expand">推广链接：</p>
			<p class="link"><?php echo $news['Url']; ?></p>
			<!----><div class="box_code">
				<img width="300px" height="300px" alt="二维码" src="http://www.xcsoft.cn/public/qrcode?text=<?php echo $content; ?>&size=4&level=L&padding=2&logo=">
			<!--
			
			<img width="300px" height="300px" alt="二维码" src="http://qr.topscan.com/api.php?text=<?php echo $content; ?>&size=4&level=L&padding=2&logo=">
			-->
			
			</div>
			
			<a href="javascript:;">点击右上方按钮分享到朋友圈</a>
			<div class="box_wz">
				<h1>代理规则</h1>
				<div class="box_txt">
					 <p>A用户分享连接到朋友圈，B用户是A用户的微信好友，此时B用户通过A用户连接注册成功后。B用户就是A 用户的一级代理。</p> 
					 <p>B用户分享连接。C用户通过B用户的连接注册后，C用户就是B用户的一级代理。C用户就是A用户的二级代理。</p>
					 <p>B用户产生交易后，A用户可以获得一定的佣金。</p>
					 <p>C用户产生交易后，A用户和B用户可以获得部分的佣金。</p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
     wx.config({
	    debug: false,
	    appId: '<?php echo $signPackage["appId"];?>',
	    timestamp: <?php echo $signPackage["timestamp"];?>,
	    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	    signature: '<?php echo $signPackage["signature"];?>',
	    jsApiList: [
	        'onMenuShareTimeline'
	    ]
	  });
    wx.ready(function () {
    	 wx.checkJsApi({
            jsApiList: ['onMenuShareTimeline'],
            success: function (res) {
            }
        });
          wx.onMenuShareTimeline({
          title: '<?php echo $news['Title'];?>',
          link: '<?php echo $news['Url'];?>',
          imgUrl: '<?php echo $news['PicUrl'];?>',
          trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
             //alert('用户点击分享到朋友圈');
          },
          success: function (res) {
              alert('分享成功');
              var url = "http://m.xinyicaijing.com/index.php/Home/Index/index.html";
              window.location=url;
          },
          cancel: function (res) {
             alert('已取消');
          },
          fail: function (res) {
             //alert(JSON.stringify(res));
          }
        });
   });

</script>