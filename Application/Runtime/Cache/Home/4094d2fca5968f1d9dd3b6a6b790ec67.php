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
<div class="wrap">
  <div class="index" style="min-height: 891px;">
    <header class="list-head">
      <nav class="list-nav clearfix"> <a href="javascript:history.go(-1)" class="list-back"></a>
        <h3 class="list-title">修改登录密码</h3>
      </nav>
    </header>
    <!-- <form id="reviseForm" class="i-form" method="post" action="<?php echo U('User/edituser');?>"> -->
      <ul class="form-box">
        <li class="f-line clearfix">
          <label class="f-label">当前密码</label>
          <input style="color: #000;" id="c-pwd" class="f-input text" type="password" maxlength="18" placeholder="请输入当前登录密码" name="upwd">
        </li>
        <li class="f-line clearfix">
          <label class="f-label">新密码</label>
          <input style="color: #000;" id="n-pwd" class="f-input text" type="password" maxlength="18" placeholder="请输入六位新密码" name="newpwd">
        </li>
        <li class="f-line clearfix">
          <label class="f-label">确认密码</label>
          <input style="color: #000;" id="r-pwd" class="f-input text" type="password" maxlength="18" placeholder="再次输入登录密码" name="mypwd">
        </li>
      </ul>
      <input type="submit" value="确 认" class="f-sub" id="save">
    <!-- </form> -->
  </div>
</div>
<script src="/vpan/Public/Home/js/script.js"></script>
<script type="text/javascript">
  $("#save").click(function(){
      var c_pwd=$("#c-pwd").val();
      var n_pwd=$("#n-pwd").val();
      var r_pwd=$("#r-pwd").val();
      var flag = true;
      if( ''== $.trim(c_pwd)) {
            msg('原密码不能为空');
            flag=false;
      }else if( ''== $.trim(n_pwd)) {
            msg('新密码不能为空');
            flag=false;
      }else if( ''== $.trim(r_pwd)) {
           msg('确认密码不能为空');
           flag=false;
      }else if($.trim(n_pwd)!= $.trim(r_pwd)) {
           msg('两次密码不一致');
           flag=false;
      }
      if(flag == true) {
              $.ajax({
                  type:'post',
                  url:"<?php echo U('User/edituser');?>",
                  data:{"upwd":c_pwd,"newpwd":n_pwd},
                  success:function(data){
                   if (data==1) {
                      msg('修改成功');
                      window.setTimeout(function(){window.location.href="/vpan/index.php/Home/User/memberinfo.html";},1000);
                    }else if(data==2){
                      msg('修改失败');
                    }else if(data==0){
                      msg('原密码不正确');
                    }
                  }
              }); 
      }
  });
</script>

 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>