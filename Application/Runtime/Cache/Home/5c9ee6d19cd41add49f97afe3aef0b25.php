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
    <!-- <li><a href="<?php echo U('User/recharge');?>"><span><img src="/vpan/Public/Home/images/cz.png"/></span><span>充值</span></a></li> -->
    <!-- <li><a href="<?php echo U('User/cash');?>"><span><img src="/vpan/Public/Home/images/tx.png"/></span><span>提现</span></a></li> -->
    <!-- <li><a href="" id="cash"><span><img src="/vpan/Public/Home/images/tx.png"/></span><span>提现</span></a></li> -->
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
  <?php if($is_weixin == 0): ?><header >
      <nav class="list-nav clearfix"> <!-- <a href="javascript:history.go(-1)" class="list-back"></a> -->
        <h3 class="list-title">登录</h3>
      </nav>
    </header>
      <!-- 普通浏览器登录 -->
        <form id="reviseForm" class="i-form" method="post" action="<?php echo U('User/login');?>">
          <ul class="form-box">
               <li class="f-line clearfix">
                <label class="f-label">登录号码</label>
                <input id="c-pwd" class="f-input" type="text" maxlength="20" placeholder="请输入账号" name="username">
               </li>
            <li class="f-line clearfix">
              <label class="f-label">登录密码</label>
              <input style="color: #000;" id="n-pwd" class="f-input" type="password" maxlength="20" placeholder="请输入密码" name="password">
            </li>
          </ul>
          <input type="submit" value="立即登录" class="f-sub">
          <div class="forgot"><span class="fl"></span><span class="fr"><a href="<?php echo U('User/reg');?>">新用户免费注册</a></span></div>
        </form><?php endif; ?> 
 <?php if($is_weixin == 2): ?><header class="list-head">
      <nav class="list-nav clearfix"> <a href="javascript:history.go(-1)" class="list-back"></a>
        <h3 class="list-title">登录</h3>
      </nav>
     </header>
      <!-- 微信浏览器登录 -->
         <form id="reviseForm" class="i-form" method="post" action="<?php echo U('User/login');?>">
          <ul class="form-box">
                <li class="f-line clearfix" style="display:none">
                <label class="f-label">登录号码</label>
                <input id="c-pwd" class="f-input" type="text" value="<?php echo ($username); ?>" maxlength="20" placeholder="请输入账号" name="username">
               </li>
            <li class="f-line clearfix">
              <label class="f-label">登录密码</label>
              <input style="color: #000;" id="n-pwd" class="f-input" type="password" maxlength="20" placeholder="请输入密码" name="password">
            </li>
            <div style="display:none"><input type="text" id="my_openid" value=""></div>
          </ul>

             <a style="float: right;color: #009ad6" href="<?php echo U('User/retrievepwd');?>">找回密码</a>
          <input type="submit" value="立即登录" class="f-sub" id="denglu">
          <div class="forgot"><span class="fl"></span><span class="fr"></span></div>
        </form><?php endif; ?> 
    <div style="text-align: center;">
    <img src="/vpan/Public/Home/images/log.jpg"  width="200px" height="200px">
    <p style="font-size: 14px;">长按二维码关注新意财经公众号</p>
    <p style="font-size: 14px;">点关注进去就送三十元现金卷</p>
  </div>
  </div>
</div>

<input type="hidden" id="ustatus" value="<?php echo ($ustatus); ?>">
<script src="/vpan/Public/Home/js/jquery-2.1.1.min.js"></script>
<script src="/vpan/Public/Home/js/script.js"></script>
<script type="text/javascript">
  // $("#denglu").click(function(){
  //     var c_pwd = $("#c-pwd").val();
  //     var n_pwd = $("#n-pwd").val();
  //     var flag = true;
  //     if( ''== $.trim(n_pwd)) {
  //           msg('登录密码不能为空');
  //           flag=false;
  //     }
  //     if(flag == true) {
  //             $.ajax({
  //                 type:'post',
  //                 url:"<?php echo U('User/login');?>",
  //                 data:{"username":c_pwd,"password":n_pwd},
  //                 success:function(data){
  //                   if (data==1) {
  //                     msg('登录成功');
  //                     window.setTimeout(function(){window.location.href="/vpan/index.php/Home/Index/index.html";},1000);
  //                     //window.setTimeout(function(){window.location.href="{:U('Index/index')}";},1000);
  //                   }else if(data==2){
  //                     msg('密码不正确');
  //                   }
  //                 }
  //             }); 
  //     }
  // });
//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}
if ($('#ustatus').val()==1) {
     //alert('你已经被加入黑名单');
     $('.f-sub').attr("type","button");
}
$('#my_openid').val(getUrlParam("openid"));

</script>

<style>


/*风险条款*/
.risk{
	position: fixed;
	top: 0;
	left: 0;
	background-color: #000;
	z-index: 999;
	width: 100%;
	height: 100%;
}
.risk .risk_div{
	color: #8b8b8b;
	background-color: #262626;
	width: 90%;
	margin:80px auto 0;
	border-radius: 10px;
	padding-top: 20px;
	padding-bottom: 20px

}
.risk .risk_div h2{
	text-align: center;
}
.risk .risk_div .proclaim{
	width: 90%;
	margin: 0 auto;
	height:260px;
	font-size: 14px;
	overflow-y:scroll;
}
.risk .risk_div a{
	width: 90%;
	margin: 0 auto;
	text-align: center;
	height: 35px;
	line-height: 35px;
	background-color: #d2af2f;
	border-radius: 5px;
	color: #433324;
	display: block;
	font-size: 14px;
}
  </style>
<div class="risk">
	<div class="risk_div">
		<h2>风险声明</h2>
		<div class="proclaim">
			尊敬的客户：<br/><br/>

在进行大宗商品交易投资时，可能会获得较高的投资收益，但同时也存在着较大的投资风险，为了使您了解其中的风险，根据有关大宗商品交易法律法规、行政法规、大宗商品登记结算机构业务规则和大宗商品交易所业务规则，特提供本风险提示书，请您认真详细阅读。投资者从事大宗商品交易投资包括但不限于如下风险：<br/><br/>

1.宏观经济风险：由于我国宏观经济形势的变化以及其他国家、地区宏观经济环境和大宗商品交易市场的变化，可能会引起国内大宗商品交易市场的波动，使您存在亏损的可能，您不得不承担由此造成的损失。<br/><br/>

2.政策风险：有关大宗商品交易市场的法律、法规及相关政策、规则发生变化，可能引起证券市场价格波动，使您存在亏损的可能，您不得不承担由此造成的损失。<br/><br/>

3.市场经营风险：由于市场所处行业整体经营形势的变化；由于市场经营管理等方面的因素，如经营决策重大失误、高级管理人员变更、重大诉讼等引起的商品价格的波动；由于市场的其他原因，导致不能继续运营的情况等，这些都使您存在亏损的可能。<br/><br/>


4.技术风险：由于交易撮合、清算交收、行情揭示及银商转账是通过电子通讯技术和电脑技术来实现的，这些技术存在着被网络黑客和计算机病毒攻击的可能，同时通讯技术、电脑技术和相关软件具有存在缺陷的可能，这些风险可能给您带来损失或银商转账资金不能及时到账。<br/><br/>

5.不可抗力因素导致的风险：诸如地震、台风、火灾、水灾、战争、瘟疫、社会动乱等不可抗力因素可能导致大宗商品交易系统的瘫痪；大宗商品交易市场无法控制和不可预测的系统故障、设备故障、通讯故障、电力故障等也可能导致银商转账系统非正常运行甚至瘫痪，这些都会使您的交易委托无法成交或者无法全部成交，或者银商转账资金不能及时到账，您不得不承担由此导致的损失和不便。<br/><br/>

6.其他风险：由于您密码失密、操作不当、投资决策失误等原因可能会使您发生亏损；网上委托、热键操作完毕后未及时退出，他人进行恶意操作而造成的损失；网上交易未及时退出还可能遭遇黑客攻击，从而造成损失；委托他人代理大宗商品交易，且长期不关注账户变化，致使他人恶意操作而造成的损失，上述损失都将由您自行承担。在您进行大宗商品交易投资时，他人给予您的保证获利或不会发生亏损的任何承诺都是没有根据的，类似的承诺不会减少您发生亏损的可能。<br/><br/>

特别提示：本公司敬告投资者，应当根据自身的经济条件和心理承受能力认真制定大宗商品交易投资策略。大宗商品交易市场是一个风险无时不在的市场。您在进行大宗商品交易投资时存在盈利的可能，也存在亏损的风险。本风险提示书并不能揭示从事大宗商品交易投资的全部风险及大宗商品市场的全部情形。您务必对此有清醒的认识，认真考虑是否进行证券交易。<br/><br/>

投资有风险，入市需谨慎！<br/><br/>


以上《风险提示书》本人/机构已阅读并完全理解，愿意承担大宗商品交易市场的各种风险<br/><br/>
		</div>
		<a href="javascript:;" class="read">我已阅读并同意</a>
	</div>
</div>
<script>
	$(".read").on("click",function(){
       $(".risk").hide();
	})
</script>

 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>