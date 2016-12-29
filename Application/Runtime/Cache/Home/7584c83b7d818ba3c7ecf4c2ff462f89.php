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
<link rel="stylesheet" href="/vpan/Public/Home/css/ticket.css">
<script id="G--xyscore-load" type="text/javascript" charset="utf-8" async="" src="/vpan/Public/Home/js/xyscore_main.js"></script>
<div class="wrap">
  <div class="index" >
    <header class="list-head">
      <nav class="list-nav clearfix"> <a href="<?php echo U('User/memberinfo');?>" class="list-back"></a>
        <h3 class="list-title">收支明细</h3>
      </nav>
    </header>
    <ul class="ticket-list2" style="max-height:100%">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Detailed/revenueid',array('jno'=>$vo['jno']));?>" class="clearfix"> 
          <?php if($vo["jtype"] != '建仓'): ?><img src="/vpan/Public/Home/images/sz.png" class="t-icon2">
          <?php else: ?>
              <img src="/vpan/Public/Home/images/sz2.png" class="t-icon2"><?php endif; ?>
          <div class="t-left2">
              <p class="pc"><?php echo ($vo["jtype"]); ?>(<?php echo ($vo["remarks"]); ?> <?php echo ($vo["number"]); ?>手)</p>
              <p class="ye">余额：<?php echo ($vo["balance"]); ?></p>
               <p class="ye">手续费：<?php echo ($vo["jfee"]); ?></p>
          </div>
          <div class="t-right2">
             <?php if($vo["jtype"] == '建仓'): ?><p class="jg2">-<?php echo ($vo["jincome"]); ?></p>
            <?php else: ?>
              <p class="jg">+<?php echo ($vo["jincome"]); ?></p><?php endif; ?>
            <p class="rq"><?php echo (date('Y-m-d',$vo["jtime"])); ?></p>
          </div>
          <div class="clearfix"></div>
         </a>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>  
    </ul>
      <div class="pagelist"><?php echo ($page); ?></div>
  </div>

</div>
<style type="text/css">
.pagelist{ text-align:center; padding:7px 0;}
.pagelist a{ margin:0 5px; border:#ccc solid 1px; display:inline-block; padding:2px 10px 1px; line-height:16px; background:#fff; color:#1c1c1c;}
.pagelist span{ margin:0 5px; display:inline-block; padding:2px 10px 1px; line-height:16px; color:#6185a2; color:#fff; background:#ccc;}
</style>
<script src="/vpan/Public/Home/js/jquery-2.1.1.min.js"></script>
<script src="/vpan/Public/Home/js/script.js"></script>
<script src="/vpan/Public/Home/js/getJuan.js"></script>
<script type="text/javascript" charset="utf-8" src="/vpan/Public/Home/js/sea.js" async=""></script>

 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>