<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<title><?php echo (C("website")); ?>微盘</title>

<link rel="stylesheet" type="text/css" href="/vpan/Public/Home/css/cd.css" />
<script language="javascript" type="text/javascript" src="/vpan/Public/Home/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/vpan/Public/Home/js/cd.js"></script>
</head>
<body>
<!--顶部开始-->
<div class="top_div">
      <div class="cdan_div"><img src="/vpan/Public/Home/images/cdan.png" width="35" height="32"/></div>
      <div class="jypt_div">
    <h1>交易平台</h1>
  </div>
 <!--   <div style="float:right;"><h1>返回</h1></div> -->
    </div>
<div class="dbjjDiv"></div>
<div class="ycdcdDiv">
      <div class="gbtb"><img src="/vpan/Public/Home/images/gbtb.png"/></div>
      <ul>
    <li><a href="<?php echo U('Index/index');?>"><span><img src="/vpan/Public/Home/images/jygz.png"/></span><span>首页</span></a></li>
    <li><a href="<?php echo U('User/recharge');?>"><span><img src="/vpan/Public/Home/images/cz.png"/></span><span>充值</span></a></li>
    <li><a href="<?php echo U('User/cash');?>"><span><img src="/vpan/Public/Home/images/tx.png"/></span><span>提现</span></a></li>
    <li><a href="<?php echo U('Detailed/dtrading');?>"><span><img src="/vpan/Public/Home/images/jyls.png"/></span><span>交易历史</span></a></li>
    <li><a href="<?php echo U('Detailed/drevenue');?>"><span><img src="/vpan/Public/Home/images/szmx.png"/></span><span>收支明细</span></a></li>
    <li><a href="<?php echo U('User/memberinfo');?>"><span><img src="/vpan/Public/Home/images/grxx.png"/></span><span>个人中心</span></a></li>
    <li><a href="<?php echo U('User/share');?>"><span><img src="/vpan/Public/Home/images/fxhy.png"/></span><span>分享好友</span></a></li>
    <li><a href="<?php echo U('User/ranking');?>"><span><img src="/vpan/Public/Home/images/phb.png"/></span><span>排行榜</span></a></li>
    <li><a href="<?php echo U('User/help');?>"><span><img src="/vpan/Public/Home/images/jygz.png"/></span><span>帮助</span></a></li>
    <li><a href="<?php echo U('User/logout');?>"><span><img src="/vpan/Public/Home/images/cs.png"/></span><span>退出</span></a></li>
    
  </ul>
    </div>
<!--顶部结束-->
<div class="main"> 	
       
    <link rel="stylesheet" href="/vpan/Public/Home/css/global.css">
    <link rel="stylesheet" href="/vpan/Public/Home/css/index.css">
    <link rel="stylesheet" href="/vpan/Public/Home/css/pwd.css">

    <div class="content" style="text-align: center">

        <p class="yh_all">长按推广链接分享好友<p>
        <p><input  id='link' type="text" value="http://m.xinyicaijing.com/index.php?s=/Home/User/login.html&sale="+data  class="st"/>&nbsp;&nbsp;
        <!-- <button data-clipboard-target="#link" class="tjrz" id="cop" alt="Copy to clipboard">复制推广链接</button></p> -->

        <p class="form_sfrz">

        <div style="margin-left: auto; margin-right: auto; width: 200px; height: 200px" id="code">
        </div>

        <br>
        <button class="tjrz2">长按二维码分享好友</button>
        <br>
    </div>
    <script type="text/javascript" src="/vpan/Public/Home/js/jquery.qrcode.min.js"></script>
    <script type="text/javascript" src="/vpan/Public/Home/js/clipboard.min.js"></script>
    <script type="text/javascript">

        //获取当前用户ID作为分享人
        $.ajax({
            type: "post",
            url: "<?php echo U('User/getSession');?>",
            async: false,
            success: function (data) {
                var URL = "http://m.xinyicaijing.com/index.php?s=/Home/User/login.html&sale="+data;

                document.getElementById('link').value=URL;

                //生成二维码(canvas)
                $("#code").qrcode({
                    render: "canvas", //table方式
                    width: 200, //宽度
                    height:200, //高度
                    text: URL //任意内容
                });


                //将canvas转为img
                var myCanvas = document.getElementsByTagName("canvas")[0];
                var img = convertCanvasToImage(myCanvas);
                $("#code").html(img);

                // canvas-->image
                function convertCanvasToImage(canvas){
                    //新Image对象,可以理解为DOM;
                    var image = new Image();
                    //canvas.toDataURL返回的是一串Base64编码的URL,当然,浏览器自己肯定支持
                    //指定格式PNG
                    image.src = canvas.toDataURL("image/png");
                    return image;
                }
            },
            error: function (data) {

            }
        });


        // function copy(){
        //     var content=$('#link');//对象是多行文本框contents
        //     content.select(); //选择对象
        //     document.execCommand("Copy"); //执行浏览器复制命令
        //     $('#cop').html('已复制');
        // }
    //      $(document).ready(function(){    
    //     var targetText=$("#target").text();    
    //     var clipboard = new Clipboard('#copy_btn');    
     
    //     clipboard.on('success', function(e) {    
    //         console.info('Action:', e.action);    
    //         console.info('Text:', e.text);    
    //         console.info('Trigger:', e.trigger);    
    //         alert("复制成功");    
     
    //         e.clearSelection();    
    //     });    
    // });    
     var clipboard = new Clipboard('.tjrz');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });


    </script>
    <style>
        .yh_all{ font-size:16px; font-weight:bold; border:none;}
        .zl_table{ border-radius:5px; background:#fff; }
        .zl_table tr{ height:42px; line-height:42px;}
        .st{ width:50%; height:32px; line-height:32px; border:none; border:1px #d5d5d5 solid; border-radius:3px; }
        .tjrz{ background:none; border:none; padding:5.5px 2px; background:#ffb709; border-radius:2px; color:#fff; font-size:14px; margin-top:12px;}
        .tjrz2{ text-align: center;background:none; border:none; padding:9px 35px; background:#19b2ff; border-radius:2px; color:#fff; font-size:14px; margin-top:12px;margin-left: auto;margin-right: auto}
        .form_sfrz{ background:#fcf8e3; border:1px #ebd97b solid; border-radius:5px; padding:20px 0 20px 20px; width:100%; font-size:15px; text-align:center;}
    </style>

 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>