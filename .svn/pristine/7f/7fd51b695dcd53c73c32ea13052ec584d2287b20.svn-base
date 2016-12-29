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


<div class="wrap" style="overflow:scroll;overflow-x:hidden;">
  <div class="index" style="min-height: 1339px; position: relative; ">


      <div style="position: absolute; width: 45%; height: 8%; margin: 25% 25%; background-color: #ffffff;
       border-radius:5px;box-shadow: 3px 3px 3px #666666; z-index: 100; display: none; "class="sure">
          <div style=" width: 100%; height: 20%; background-color: #ff7c83; border-radius:5px;" class="sure-top"></div>
          <div style=" position:relative;width: 100%; height: 80%; " class="sure-two">
              <p style="text-align: center; margin-top: 13%; font-size: 16px;" >是否确定购买？</p>
              <input class="quxiao" style=" position: absolute;left: 16%; top:32%; width:19%;
              background-color: #ff7c83; height: 22%;color: #ffffff; border-radius: 3px;" type="button" value="取消"/>
              <input class="queding" style="position: absolute;right: 16%; top:32%; width:19%;
              background-color: #00b555; height: 22%;color: #ffffff;border-radius: 3px;" type="button" value="確定"/>
          </div>
      </div>


    <input type="hidden" id="tpqh" value="1">
    <!-- 账户有建仓订单时显示所有没有平仓的订单 -->
    <?php if(empty($nolist)): else: ?> 
       <div class="jryk">
              <div class="yk_left">今日盈亏(元)</div>
              <div class="yk_con"></div>
              <div class="yk_right box2">
                 <!-- <a href="javascript:;" class="bounceIn">查看交易</a> -->
                 <a href="<?php echo U('Detailed/dtrading');?>" class="bounceIn">交易记录</a>
              </div>
              <div class="clearfix"></div>
            </div>
          <div class="b-line noclearfix" style="margin-bottom:0;" id="useror">
                 <table width="100%" cellspacing="0" cellpadding="0">
	                 	<tr>
			             		<td width="10%">盈亏</td>
			             		<td width="25%">建仓价</td>
			             		<td width="30%">产品</td>
			             		<td width="8%">手数</td>
			             		<td></td>
			             	</tr>
                     <?php if(is_array($nolist)): $i = 0; $__LIST__ = $nolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$on): $mod = ($i % 2 );++$i;?><!-- 油 -->
                          <?php if($on["cid"] == 1): ?><tr class="ykzf openpay" id="<?php echo ($on["oid"]); ?>">
                                  <td class="ykzfwave" style="display: none"><?php echo ($on["wave"]); ?></td>
                                  <td class="ykzfostyle" style="display:none"><?php echo ($on["ostyle"]); ?></td>
                                  <td class="ykzfeid" style="display:none"><?php echo ($on["eid"]); ?></td>
                                  <td class="ptitle" style="display:none"><?php echo ($on["ptitle"]); ?></td>
                                  <td class="uprice" style="display:none"><?php echo ($on["uprice"]); ?></td>
                                  <td class="oid" style="display:none"><?php echo ($on["oid"]); ?></td>
                                  <td style="display:none" class="yincangyoujia latest-price"></td>
                                	
                                  <td class="cash1 ploss"></td>
                                  <td class="buyprice"><?php echo ($on["buyprice"]); ?>
                                  <?php if($on["ostyle"] == 1): ?><font color="#2fb44e">(空)</font><?php else: ?><font color="#ed0000">(多)</font><?php endif; ?>
                                  </td>                     
                                  <td><?php echo ($on["ptitle"]); ?>(<?php echo ($on["company"]); ?>)</td>
								  <td class="onumber"><?php echo ($on["onumber"]); ?></td>                        
                                  <td class="mypwd-btn chr">
                                  	<!--<?php echo U('Detailed/orderid');?>?orderid=<?php echo ($on["oid"]); ?>-->
                                  	 <a href="<?php echo U('Detailed/orderid',array('orderid'=>$on['oid']));?>" class="red" data-cid='<?php echo ($on["cid"]); ?>' data-oid='<?php echo ($on["oid"]); ?>'>查看订单</a>
                                  	<!--  <a href="javascript:void(0);" class="blue" data-onumber='<?php echo ($on["onumber"]); ?>' data-oid='<?php echo ($on["oid"]); ?>' data-zy='<?php echo ($on["endprofit"]); ?>' data-zk='<?php echo ($on["endloss"]); ?>'>设置</a> -->
                                  	 <div style="clear: both;"></div>
                                  </td>
                              </tr><?php endif; ?>
                        <!-- 银-->
                          <?php if($on["cid"] == 2): ?><tr class="ykzf1 openpay" id="<?php echo ($on["oid"]); ?>">
                                  <td class="ykzfwave" style="display:none"><?php echo ($on["patx"]); ?></td>
                                  <td class="ykzfostyle" style="display:none"><?php echo ($on["ostyle"]); ?></td>
                                  <td class="ykzfeid" style="display:none"><?php echo ($on["eid"]); ?></td>
                                  <td class="ptitle" style="display:none"><?php echo ($on["ptitle"]); ?></td>
                                  <td class="uprice" style="display:none"><?php echo ($on["uprice"]); ?></td>
                                  <td class="oid" style="display:none"><?php echo ($on["oid"]); ?></td>      
                                  <td style="display:none" class="ycbaiyinjia latest-price"></td>
                                  
                                  <td class="cash2 ploss"></td>  
                                  <td class="buyprice2"><?php echo ($on["buyprice"]); ?>
								  <?php if($on["ostyle"] == 1): ?><font color="#2fb44e">(空)</font><?php else: ?><font color="#ed0000">(多)</font><?php endif; ?>
                                  </td>                       
                                  <td ><?php echo ($on["ptitle"]); ?>(<?php echo ($on["company"]); ?>)</td>
								  <td class="onumber"><?php echo ($on["onumber"]); ?></td>                               
                                  <td class="mypwd-btn chr">
                                  	 <a href="<?php echo U('Detailed/orderid',array('orderid'=>$on['oid']));?>" class="red" data-cid='<?php echo ($on["cid"]); ?>' data-oid='<?php echo ($on["oid"]); ?>'>查看订单</a>
                                  	<!--  <a href="javascript:void(0);" class="blue" data-onumber='<?php echo ($on["onumber"]); ?>' data-oid='<?php echo ($on["oid"]); ?>' data-zy='<?php echo ($on["endprofit"]); ?>' data-zk='<?php echo ($on["endloss"]); ?>'>设置</a> -->
                                  	 <div style="clear: both;"></div>
                                  </td>
                              </tr><?php endif; ?>
                          <!-- 铜 -->
                          <?php if($on["cid"] == 3): ?><tr class="ykzf2 openpay" id="ys_<?php echo ($on["oid"]); ?>"> 
                                  <td class="ykzfwave" style="display:none"><?php echo ($on["patx"]); ?></td>
                                  <td class="ykzfostyle" style="display:none"><?php echo ($on["ostyle"]); ?></td>
                                  <td class="ykzfeid" style="display:none"><?php echo ($on["eid"]); ?></td>
                                  <td class="ptitle" style="display:none"><?php echo ($on["ptitle"]); ?></td>
                                  <td class="uprice" style="display:none"><?php echo ($on["uprice"]); ?></td>
                                  <td class="oid" style="display:none"><?php echo ($on["oid"]); ?></td>     
                                  <td style="display:none" class="yctojia latest-price"></td>   

                                  <td class="cash3 ploss"></td>  
                                  <td class="buyprice3"><?php echo ($on["buyprice"]); ?>
																	<?php if($on["ostyle"] == 1): ?><font color="#2fb44e">(空)</font><?php else: ?><font color="#ed0000">(多)</font><?php endif; ?>
                                  </td>
									<td><?php echo ($on["ptitle"]); ?>(<?php echo ($on["company"]); ?>)</td>
									<td class="onumber"><?php echo ($on["onumber"]); ?></td>
                                  <td class="mypwd-btn chr">
                                  	 <a href="<?php echo U('Detailed/orderid',array('orderid'=>$on['oid']));?>" class="red" data-cid='<?php echo ($on["cid"]); ?>' data-oid='<?php echo ($on["oid"]); ?>'>查看订单</a>
                                  <!-- 	 <a href="javascript:void(0);" class="blue" data-onumber='<?php echo ($on["onumber"]); ?>' data-oid='<?php echo ($on["oid"]); ?>' data-zy='<?php echo ($on["endprofit"]); ?>' data-zk='<?php echo ($on["endloss"]); ?>'>设置</a> -->
                                  	 <div style="clear: both;"></div>
                                  </td>
                              </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div><?php endif; ?> 
    <div class="account-info clearfix">
      <div class="info-detail left" ><?php if($user["portrait"] == ''): else: endif; ?>
      <a href="<?php echo U('User/memberinfo');?>"> <span class="a-u">个人账户(元)</span> <em class="a-d "><?php if($user["price"] != 0): ?><span id="usprice"><?php echo ($user["price"]); ?></span><?php else: ?><span id="usprice">0.0</span><?php endif; ?></em></a> </div>
      <a href="<?php echo U('User/recharge');?>" class="charge-btn
      ">充值</a>
      <div class="info-detail right"> <a href="<?php echo U('User/experiencelist');?>"> <span class="a-u">体验劵(张)</span> <em class="a-d"><?php if($user["exper"] != 0): echo ($user["exper"]); else: ?>0<?php endif; ?></em> </a> </div>
    </div>
<div style="width:100%;height:235px;overflow:hidden;">
    <div class="switch-product">
      <ul class="clearfix">
        <li class="sw_active" value="1">
            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["cid"] == 1): ?><a ><?php echo ($vo["ptitle"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </li>
      </ul>
    </div>

    <div class="product-box" value="1">
    	<!--***油***-->
      <div class="trade-box">
        <div class="price-info clearfix">
          <h3 class="price-current">
              <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["cid"] == 1): ?><span  style="font-size: 1rem;"><?php echo ($vo["ptitle"]); ?>(元/批)</span><?php endif; endforeach; endif; else: echo "" ;endif; ?>

          <?php if($isopen == 0): ?><em>休市</em>
          <?php else: ?>
            <em class="" id="youjia"></em><?php endif; ?>
         
            <!--降-->
 
          </h3>
          <ul class="price-trend clearfix">
            <li>昨收<em id="yzs"></em></li>
            <li>最高<em id="yzg"></em></li>
            <li>今开<em id="yjk"></em></li>
            <li>最低<em id="yzd"></em></li>
          </ul>
        </div>
        <div class="swiper-container   swiper3">
          <div class="swiper-wrapper" style=" width: 1232px; height: 85px; -webkit-transform: translate3d(0px, 0px, 0px); transition: 0s; -webkit-transition: 0s;">
        <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["cid"] == 1): ?><div class="swiper-slide swiper-slide-visible swiper-slide-active" data-l="6" data-b="2" style="width: 410.67px; height: 85px;">
                <input type="hidden" value="<?php echo ($vo["pid"]); ?>">
                <h3><?php echo ($vo["ptitle"]); ?></h3>
                <h4><span class="vouprice"><?php echo ($vo["uprice"]); ?></span>元/批</h4>
                <h5>波动盈亏：<?php echo ($vo["wave"]); ?>元</h5>
                <img src="/vpan/Public/Home/images/pick.png" class="p-selected"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </div>
        </div>

      </div>
    </div>


</div>
    <!--***油***-->    
    <div>
      <div class="trade-box">
        <ul class="buy-choose clearfix box" id="may" style="padding:0">
            <?php if($isopen != 0): endif; ?>
          <!-- <li><a href="javascript:" class="up bounceIn" onClick="buy(2,2)">买涨</a></li> -->
          <input id="isopen" type="hidden" value="$isopen">
          <li><a href="javascript:" class="up bounceIn" onclick="return false;" value="涨">买涨</a></li>
          <li><a href="javascript:" class="down bounceIn" value="跌">买跌</a></li>
   
        </ul>
      </div>
    </div>


<!--       <div class="payment_time_title bg-3" style="">
        <span><em class="cor-6">点击我弹出</em> ></span>
      </div> -->
      <div id="bg">   
      </div>
      <div  class="payment_time_mask" style="z-index: 99; ">
          <li id="guanbi"></li>

        <!--建仓确认-->
          <div id="buildBox" >
            <nav class=""> <a href="javascript:;" class="back" id="claseDialogBtn"></a>

            </nav>
            <form id="jcForm" class="" method="post" ><!-- action="<?php echo U('Detailed/addorder');?>" -->
              <div class="" style="overflow: hidden;margin:10px;">
                <label class="b-label">选择数量：</label>
                <p class="num-list   clearfix" id="jcsh"> <span class="num-left"></span>
                  <input type="text" value="1" class="num-in" id="sls" disabled="">
                  <span class="num-right"></span> </p>
                <p class="price clearfix"> <span>方向：</span> <em class="fx"><span id="zhd" style="font-size:1.1em"></span></em>
                  <!--降-->
                  <!--<em class="drop">3.983</em>-->
                </p>
              </div>
              <div class="b-line clearfix">
                <label class="b-label">品种：</label>
                <div class="type-choose clearfix">
               <!--   <a class="t-left"  onclick="zyclick('z')">加</a>  -->
                    <div class="type-list clearfix">
                      <ul class="p-baiyin" style="margin-top: 0px;">
                        <li id="opname" class="xz6" data-l="2" data-bz="200" data-pid="6" data-sxf="30.0" data-juan="0"></li>
                      </ul>
                    </div>
                <!--   <a class="t-right" onclick="zyclick('you')">减</a>  --></div>
                <p class="price clearfix"> <span>当前价格：</span>
                <em class="c-13" id="ydangqianj" style="display:none"></em> 
                <em class="c-13" id="bdangqianj" style="display:none"></em> 
                <em class="c-13" id="tdangqianj" style="display:none"></em>
                <em  id="dqcid" style="display:none"></em>
               <!--  <em class="c-13" id="dangqianj">0</em>  -->
                <!-- <em class="c-13  c-you  none rise" style="display: inline;">2053.6</em> -->
                  <!--降-->
                  <!--<em class="drop">3.983</em>-->
                </p>
              </div>
                <!-  体验券-->
              <div class="b-line clearfix">
                <p class="c-c-l clearfix">
                  <input type="checkbox" id="choose" value="">
                  <label for="choose" id="mychoose"></label>
                </p>
                <em class="c-c-i">使用&nbsp;<img src="/vpan/Public/Home/images/ticket-small.png">&nbsp;
                    <i class="c11" id="c11">200</i>元体验劵(<span style="font-size:0.8em">一次只能使用一张</span>)
                </em>
              </div>


             <!--<div class="b-line clearfix">-->
                <!--<label class="b-label">时间:</label>-->
                  <!--<select class="type-choose clearfix sjval" >-->
                    <!--<option value="180" selected = "selected">3分钟</option>-->
                    <!--<option value="300">5分钟</option>-->
                    <!--<option value="900">15分钟</option>-->
                    <!--<option value="1800">30分钟</option>-->
                    <!--<option value="3600">60分钟</option>-->
                  <!--</select>-->
                <!--<p class="price clearfix"> <span>(分钟)</span></p>-->
              <!--</div>-->


              <div class="b-line clearfix">
                <label class="b-label">优惠券：</label>
                <p class="num-list clearfix" id="yingjia">
                  <input type="text" value="0" class="num-in" style="margin-left:30px" readonly="">
                </p>
                <input type="hidden" name="juansl" value="0" id="juansl">
                <p class="b-info">剩&nbsp;<span class="big" id="big">0</span>&nbsp;张</p>
              </div>

              <div class="b-line clearfix">
                <label class="b-label">所用费用：</label>
                <p class="pay"><span id="opprice">0</span>元</p>
                <input type="hidden" name="sxf" id="sxf" value="30.0">
                <p class="b-info">手续费&nbsp;<span id="j-5">1</span>&nbsp;元&nbsp;<img src="/vpan/Public/Home/images/qrgm.png" style="height:20px" id="shuoming"></p>
              </div>

              <input type="hidden" name="type" value="1" id="type" >
              <input type="hidden" name="bz" value="2" id="bz">
              <input type="hidden" name="sl" value="1" id="sl">
              <input type="hidden" name="ordernumber" value="">
              <input type="hidden" name="product" value="6" id="product">
              <input type="hidden" name="jine" value="<?php echo ($user["price"]); ?>" id="jine">
              <input type="hidden" name="isJuan" value="" id="isJuan">
              
              <input type="button" class="pwd-btn" onclick="buyClick()" id="conform1" value="确 认">
              <!--余额不足，去充值-->
              <a href="<?php echo U('User/recharge');?>" class="pwd-btn chr failure  none" id="conform2">余额不足，去充值</a>
              <a href="<?php echo U('Index/index');?>" class="pwd-btn chr failure  none" style="display: none;" id="conform3">此商品已购买</a>
            </form>
          </div>
  
      </div>


      <div id="bg2">   
      </div>
      <div class="payment_time_mask2" style="">
         <li id="guanbi"> <h3>设置止盈/止损</h3></li>
        <!--建仓确认-->
            <nav class=""> <a href="javascript:;" class="back" id=""></a>
             
            </nav>
            <form id="jccg" class="build-form" method="post" action="<?php echo U('Index/edityk');?>" autocomplete="off">
            <div class="b-line">
                <label class="b-label" style="margin-left: 0px;">确认数量：</label>
                <p class="num qrsl"><?php echo ($order["onumber"]); ?></p>
            </div>
            <div class="b-profit">
                <p class="b-p-t">止盈</p>
                <ul class="toclearfix">
                    <li value="100">不设</li>
                    <li value="10">10%</li>
                    <li value="20">20%</li>
                    <li value="30">30%</li>
                    <li value="40">40%</li>
                    <li value="50">50%</li>
                </ul>
                <p class="b-p-t">止损</p>
                <ul class="myclearfix">
                    <li value="100">不设</li>
                    <li value="10">10%</li>
                    <li value="20">20%</li>
                    <li value="30">30%</li>
                    <li value="40">40%</li>
                    <li value="50">50%</li>
                </ul>
            </div>
        	  <input type="hidden" name="oid" value="" id="buyid">
        		<input type="hidden" name="zy" value="" id="zy">
        		<input type="hidden" name="zk" value="" id="zk">
        		<input type="submit" class="pwd-btn" value="保存设置" onclick="baocun()">
		        </form>
         

    
      </div>


    <div class="info-box">
      <div class="info-d">
        <div class="trend-box">

            <!--<div class="info-box">-->
            	<ul class="info_a">
                    <li><a id="time" class="selected" onclick="chooseTime()">分时线</a></li>
                    <li style="width:50%"><a id="date" onclick="chooseDate()">日K线</a></li>
            	</ul>
            <!--</div>-->

          <div class="trend-chart" id="myDiv">
          </div>

        </div>
      </div>
    </div>

      <div class="info-box">
      <ul class="info-nav clearfix">
        <li value="1"><a class="selected" id="newInformation">最新资讯</a></li>
        <li value="2" style="width:33.4%"><a id="newEconomics">财经要闻</a></li>
        <li value="3"><a id="system">系统公告</a></li>
      </ul>
      <div class="info-d">
      <?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="news-list clearfix">
          <div class="news_pic"> <a class="clearfix"><img src="/vpan/Public/Home/images/pic<?php echo ($i); ?>.gif"></a> </div>
          <div class="news_text"> 
            <p class="zx"><img src="/vpan/Public/Home/images/zx.png"></p>
            <p class="n_t"><a class="clearfix"> <span><?php echo ($vo["ntitle"]); ?></span></a> </p>
           <!-- <p class="n_cs"><a class="clearfix"> <span><?php echo (substr($vo["ncontent"],0,30)); ?></span></a> </p>-->
            <p class="n_m"><a href="<?php echo U('News/newsid',array('nid'=>$vo['nid']));?>" class="news-more">阅读&gt;</a></p>
           </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="ckgd"><a href="<?php echo U('News/newslist',array('fid'=>1));?>">查看更多</a></div>
      </div>
      <div class="info-d none">
        <ul class="news-list clearfix">
        <?php if(is_array($focus)): $i = 0; $__LIST__ = $focus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo U('News/newsid',array('nid'=>$vo['nid']));?>" class="clearfix"> <span><?php echo ($vo["ntitle"]); ?></span> 
		  <i><?php echo (date('Y-m-d H:i:s',$vo["ntime"])); ?></i> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
          <a href="<?php echo U('News/newslist',array('fid'=>2));?>" class="news-more">查看更多&gt;</a>
        </ul>
      </div>
      <div class="info-d none">
        <ul class="news-list clearfix">
          <?php if(is_array($notices)): $i = 0; $__LIST__ = $notices;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo U('News/newsid',array('nid'=>$vo['nid']));?>" class="clearfix"> <span><?php echo ($vo["ntitle"]); ?></span> <i><?php echo (date('Y-m-d H:i:s',$vo["ntime"])); ?></i> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
          <a href="<?php echo U('News/newslist',array('fid'=>3));?>" class="news-more">查看更多&gt;</a>
        </ul>
      </div>
    </div>
  </div>
  <!--遮罩层-->
</div>

 <!--弹窗开始-->
<link rel="stylesheet" href="/vpan/Public/Home/css/common.css"/>
<script src="/vpan/Public/Home/js/jquery-2.1.1.min.js"></script>

    <script type="text/javascript">

        //=-------默认K线
        document.getElementById('myDiv').innerHTML='<iframe  frameborder=0 width=100% height=350px marginheight=0 marginwidth=0 scrolling=no src="/xh/tu2.php"></iframe>';

        //-------切换K线
        function chooseDate() {
            document.getElementById("date").className="selected";
            document.getElementById("time").className="none";
            document.getElementById('myDiv').innerHTML='<iframe  frameborder=0 width=100% height=350px marginheight=0 marginwidth=0 scrolling=no src="/xh/tu.php"></iframe>';

        }

        function chooseTime() {
            document.getElementById("time").className="selected";
            document.getElementById("date").className="none";
            document.getElementById('myDiv').innerHTML='<iframe  frameborder=0 width=100% height=350px marginheight=0 marginwidth=0 scrolling=no src="/xh/tu2.php"></iframe>';
        }


        //--------切换资讯
        $('#newInformation').click(function () {
            document.getElementById("newInformation").className="selected";
            document.getElementById("newEconomics").className="none";
            document.getElementById("system").className="none";

        });

        $('#newEconomics').click(function () {
            document.getElementById("newInformation").className="none";
            document.getElementById("newEconomics").className="selected";
            document.getElementById("system").className="none";
        });

        $('#system').click(function () {
            document.getElementById("newInformation").className="none";
            document.getElementById("newEconomics").className="none";
            document.getElementById("system").className="selected";
        });


    </script>

<script type="text/javascript">


var w,h,className;
function getSrceenWH(){
  w = $(window).width();
  h = $(window).height();
//  $('#dialogBg').width(w).height(h);
//  $('#dialogBg2').width(w).height(h);
//  $('#dialogBg3').width(w).height(h);
}
window.onresize = function(){  
  getSrceenWH();
} 
$(window).resize();  

$(function() {

    getSrceenWH();

    //购买显示弹框
    $('#may a').click(function () {
      
      var but = $(this).attr('value');

        //规定时间内开市
        var NowDate = new Date();
        var H = NowDate.getHours();
        var M = NowDate.getMinutes();

        //当前时间
        var nowTime = H*60+M;
        //早上时间
        var morningStart = 9*60;
        var morningEnd = 11*60+30;

        //下午时间
        var noonStart = 13*60+30;
        var noonEnd = 15*60;

        //晚上时间
        var eveningStart = 19*60+30;
        var eveningEnd = 21*60+30;


        var weak = NowDate.getDay();

        //周末不开市
        if (weak!=0 && weak!=6){


            if ((nowTime>=morningStart && nowTime<=morningEnd) || (nowTime>=noonStart && nowTime<=noonEnd) || (nowTime>=eveningStart&&nowTime<=eveningEnd)){
                opening(but);
            }
            else {
                alert("尚未到开市时间");
            }


        }else {

            alert("周末不开市");
        }



    });

    //弹起购买框
    function opening(but) {





        //获取选择是涨还是跌的值
//        var but = $("#stu").attr("value");
////         = $(this).attr('value');

        $('#zhd').html(but);
        //买涨，买跌的时候执行。
        $(".product-box").each(function () {
            var status = $(this).attr('status');
            if (status == "mark") {

                var pid = $(this).find(".swiper-slide-active").children("input").val();
                var vouprice = $(this).find(".swiper-slide-active h4 span").html();
                var ubalance = $('#usprice').text();
                //var vouprice = $("#opprice").text();
                if (eval(ubalance) <= eval(vouprice)) {
                    $("#conform1").attr("type", "hidden");
                    $("#conform2").show();
                } else {
                    $("#conform1").attr("type", "button");
                    $("#conform2").hide();
                }

                $.ajax({
                    type: "post",
                    url: "<?php echo U('Index/selectid');?>",
                    data: "pid=" + pid,
                    async: false,
                    success: function (data) {

                        if (data['cid'] == 1) {
                            $('#ydangqianj').css('display', "block");
                            $('#dqcid').html(1);
                        } else if (data['cid'] == 2) {
                            $('#bdangqianj').css('display', "block");
                            $('#dqcid').html(2);
                        } else {
                            $('#tdangqianj').css('display', "block");
                            $('#dqcid').html(3);
                        }
                        $('#opname').html(data['ptitle']);
                        $('#opprice').html(data['uprice']);
                        $('#j-5').html(data['feeprice']);
                        $('#c11').html(data['uprice']);
                        $('#big').html(data['sum']);
                        $('#pid').val(data['pid']);

                        //算加减传的值
                        $('#bz').val(data['uprice']);
                        $('#sxf').val(data['feeprice']);
                        $('#juansl').val(data['sum']);
                        $('#type').val(data['pid']);

                    },
                    error: function (data) {

                    }
                });
            }
        });

        //商品id
        var mypid = $('#type').val();

        $.ajax({
            type: 'post',
            url: "<?php echo U('Detailed/judgment');?>",
            data: {"mypid": mypid},
            async: false,
            success: function (data) {
                if (data == 99) {
                    $('#conform1').attr("type", "hidden");
                    $('#conform2').css('display', 'none');
                    $('#conform3').css('display', 'block');
                }
            }
        });

        $("#bg").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask');
        $box.css({
            display: "block"
        });

//  关闭弹窗
//   $("#guanbi").on('click',function () {
//         $("#bg,.payment_time_mask").css("display", "none");
//     });

    }

});


</script>
<script type="text/javascript">
setInterval('pcprice()', 1000);

function pcprice() 
    {

        
      var yinprice1=0;
      var yinprice2=0;
      var yinprice3=0;
      var ykzf = $(".ykzf");
      var yincangyoujia=parseFloat($('.yincangyoujia').html()).toFixed(2);

//      console.log(yincangyoujia);
      ykzf.each(function(){
          var buyprice = parseFloat($(this).children(".buyprice").html()).toFixed(2);

          //状态0是涨，1是跌
          var ykzfostyle = $(this).children(".ykzfostyle").html();
          //是否体验卷0不是，1是
          var ykzfeid = $(this).children(".ykzfeid").html();
          //数量
          var onumber = $(this).children(".onumber").html();
					//波动
          var ykzfwave = $(this).children(".ykzfwave").html();

              if (ykzfostyle==0) {
                  //买涨
                   var newprice1 = (yincangyoujia-buyprice)*onumber;
              }else{
                  //买跌
                   var newprice1 = (buyprice-yincangyoujia)*onumber;
              }
              yinprice1 = newprice1+yinprice1;
              var newprice3 = Math.floor(newprice1);

              var minYingPrice = Math.floor(buyprice/30)*onumber * -1;
      			if(yincangyoujia=="NaN"){
      				$(this).children(".cash1").text("");
      			}else{

//                    alert(newprice3+"----"+minYingPrice);
                    //自动平仓
                    if (newprice3 <= minYingPrice){

                        ClosePosition();
                    }


      				$(this).children(".cash1").html(newprice3);
      				if(newprice3>=0){
      						$(this).children(".cash1").css('color','#ed0000')
      				}else{
      						$(this).children(".cash1").css('color','#2fb44e')
      				}
      			}         
    //        $(this).children(".cash11").html(newprice4);
      });

      var ykzf1 = $(".ykzf1");
      var ycbaiyinjia=parseFloat($('.ycbaiyinjia').html()).toFixed(2);
      //console.log(ycbaiyinjia);
      ykzf1.each(function(){
          var buyprice1 = parseFloat($(this).children(".buyprice2").html()).toFixed(2);
          //状态0是涨，1是跌
          var ykzfostyle = $(this).children(".ykzfostyle").html();
           //是否体验卷0不是，1是
          var ykzfeid = $(this).children(".ykzfeid").html();
          //数量
          var onumber = $(this).children(".onumber").html();
        	//波动
          var ykzfwave = $(this).children(".ykzfwave").html();
     
          if (ykzfostyle==0) {
              var yinprice1 = (ycbaiyinjia-buyprice1)*ykzfwave*onumber;
          }else{
              var yinprice1 = (buyprice1-ycbaiyinjia)*ykzfwave*onumber;
          };
          yinprice2 = yinprice1+yinprice2;
          var yinprice3 =yinprice1.toFixed(2);
       
          if(ycbaiyinjia=="NaN"){
						$(this).children(".cash2").text("");
					}else{
						$(this).children(".cash2").html(yinprice3);
						if(yinprice3>=0){
								$(this).children(".cash2").css('color','#ed0000')
						}else{
								$(this).children(".cash2").css('color','#2fb44e')
						}
					}
           
      //     $(this).children(".cash22").html(yinprice4);
      });        
      var ykzf2 = $(".ykzf2");
      var yctojia=parseFloat($('.yctojia').html()).toFixed(2);
      ykzf2.each(function(){
          var buyprice2 = parseFloat($(this).children(".buyprice3").html()).toFixed(2);
           //状态0是涨，1是跌
          var ykzfostyle = $(this).children(".ykzfostyle").html();
          //是否体验卷0不是，1是
          var ykzfeid = $(this).children(".ykzfeid").html();
          //数量
          var onumber = $(this).children(".onumber").html();
          //波动
          var ykzfwave = $(this).children(".ykzfwave").html();
          
           if (ykzfostyle==0) {
                var newpr3 = (yctojia-buyprice2)*ykzfwave*onumber;
          }else{
                var newpr3 = (buyprice2-yctojia)*ykzfwave*onumber;
          };
              yinprice3=newpr3+yinprice3;
              newpr3 = newpr3.toFixed(2);
       
          
          if(yctojia=="NaN"){
						$(this).children(".cash3").text("");	
					}else{
						$(this).children(".cash3").html(newpr3);
						if(newpr3>=0){
								$(this).children(".cash3").css('color','#ed0000')
						}else{
								$(this).children(".cash3").css('color','#2fb44e')
						}
					}
    //      $(this).children(".cash33").html(newpr5);
      });  

 
      var picsum=Number(yinprice1+yinprice2+yinprice3).toFixed(2);

      // picsum =picsum/2
      $('.ploss').each(function(){
      	if($(this).text()==""){
	      	$('.yk_con').html();
	      }else{
	      	$('.yk_con').html(picsum);
	      }	
      })



       
}

//平仓
function ClosePosition() {
    var orderno = "<?php echo ($on["orderno"]); ?>";
    var buytime = "<?php echo ($on["buytime"]); ?>";

    $.ajax({
        type: "post",
        url: "<?php echo U('Detailed/setClosePosition');?>",
        data: {"orderno": orderno, "buytime": buytime,"sellType":"自动"},
        success: function (data) {
            //平仓成功后更新页面
            window.location.reload();
        },
        error: function (data) {

            alert('false');
        }
    });
}

</script>
<script type="text/javascript">


    function buyClick() {
        $(".sure").css("display","block");
    }


     //取消
    $(".quxiao").click(function(){

     $(".sure").css("display","none")

    });

    //确定
     $(".queding").click(function(){
         $(".queding").css("display","none")

         //获取选择的时间
         //var region_id=$('.sjval option:selected').val();
         //数量
         var mysum=$('#sl').val();
         //所用费用
         var myfy=$('#opprice').html();
         //方向
         var myfx=$('#zhd').html();
         //手续费
         var mysxf=$('#j-5').html();
         //入仓价
         // var mygetpeice=$('#dangqianj').html();

         if($('#dqcid').html()==1){
             var mygetpeice=$('#ydangqianj').html();
         }else if($('#dqcid').html()==2){
             var mygetpeice=$('#bdangqianj').html();
         }else if($('#dqcid').html()==3){
             var mygetpeice=$('#tdangqianj').html();
         }
         var mytyj=$('#isJuan').val();
         //商品id
         var mypid=$('#type').val();

         if(mygetpeice!=''&& mypid!=''&&mygetpeice!='0')
         {
             //体验卷值
             $.ajax({
                 type:'post',
                 url:"<?php echo U('Detailed/addorder');?>",
                 data:{"mysum":mysum,"myfy":myfy,"myfx":myfx,"mysxf":mysxf,"mytyj":mytyj,"mypid":mypid,"mygetpeice":mygetpeice},
                 success:function(data){

                     if (data==0) {
                         $('#message').css('display','block');
                         window.location.reload();
                     }else{
//                     window.location.href="<?php echo U('Detailed/orderid');?>?orderid="+data+"&marker=first";
                         window.location.reload();

                     }
                 }
             });

         }

     });




</script>

<script src="/vpan/Public/Home/js/idangerous.swiper.min.js"></script>
<script src="/vpan/Public/Home/js/fastclick.js"></script>
    <script src="/vpan/Public/Home/js/script.js"></script>
<script>
    
	
	var mySwiper = new Swiper('.swiper2', {
        paginationClickable: true,
        centeredSlides: true,
        slidesPerView:1.5,
        watchActiveIndex: true
    });
  var mySwiper = new Swiper('.swiper1', {
        paginationClickable: true,
        centeredSlides: true,
        slidesPerView:1.5,
        watchActiveIndex: true
    });
      
  var mySwiper = new Swiper('.swiper3', {
        paginationClickable: true,
        centeredSlides: true,
        slidesPerView:1.5,
        watchActiveIndex: true
    });

	$("#shuoming").click(function(){
	   $("#sm").show();
	   $(".mask1").show();
	});
	$(".back1").click(function(){
	    $("#sm").hide();
	    $(".mask1").hide();
	
	});

	</script>
    <script>
       setInterval('butt1()', 2000);
       setInterval('butt2()', 2000);
       setInterval('butt3()', 2000);
       setInterval('orderlist()', 5000);
         
      $('.blue').click(function(){
			//className = $(this).attr('class');
			var onumber = $(this).attr('data-onumber');
			var zy = $(this).attr('data-zy');
			var zk = $(this).attr('data-zk');
			$('.qrsl').text(onumber);
			$('#buyid').val($(this).attr('data-oid'));
			$('zy').val(zy);
			$('zk').val(zk);
			$('.toclearfix li').each(function(){
				if($(this).val()==zy) {
					$(".toclearfix  li").eq($(this).index()).addClass("selected").siblings().removeClass("selected");
				};
			});
			$('.myclearfix li').each(function(){
				if ($(this).val()==zk) {
					$(".myclearfix  li").eq($(this).index()).addClass("selected").siblings().removeClass("selected");
				};
			});
			
        $("#bg2").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask2');
        $box.css({
            display: "block"
        });

		});

		function openpay(oid,pe,expend){
			var openpay = $('.openpay');
			var newprice,ploss,wine,bfb;
			if(openpay){
				openpay.each(function(){
					if($(this).find('.oid').text()==oid){
						ploss = $(this).find('.ploss').text();
						newprice = $(this).find('.latest-price').text();
						wine = parseFloat(ploss*1+expend*1,2);
						bfb = parseFloat(ploss/expend*100,2);
					}
				})
				if(newprice>=pe){
					$('.payprice').html('<em class="rise" id="payprice">'+newprice+'</em>');
				}else{
					$('.payprice').html('<em class="drop" id="payprice">'+newprice+'</em>');
				}
				$('.payploss').html(ploss+'('+bfb+'%)');
				$('.comiss').text(wine);
				if(ploss<0){
					$('.payploss').css('color','#2fb44e');
				}else{
					$('.payploss').css('color','#ed0000');
				}
				
			}
			
		}
		//关闭弹窗
	 	$('#claseDialogBtn3').click(function(){
		   	$('#dialogBg3').fadeOut(200,function(){
		    	$('#dialog3').addClass('bounceOutUp').fadeOut(200);
		    });
		});
		$('.payout').click(function(){
		   	$('#dialogBg3').fadeOut(200,function(){
		    	$('#dialog3').addClass('bounceOutUp').fadeOut(200);
		    });
		});

	function butt1(){  

      var yprice = $('#youjia').text();
      //alert(yprice);
    //获取油的价格到页面
      $.ajax({  
        type: "post",  
        url: "<?php echo U('Index/price');?>",         
        success: function(data) { 
          //最新油价
          if (data[0]>0) {
             $('#youjia').html(data[0]); 
            //隐藏油价
             $('.yincangyoujia').html(data[0]);
             //现在
             $('#ydangqianj').html(data[0]);
          }
          
          //昨收
          $('#yzs').html(data[7]);   
          //最高   
          $('#yzg').html(data[4]);   
          //今开
          $('#yjk').html(data[8]);   
          //最低
          $('#yzd').html(data[5]);
         
          //var sum= data[12];
          if(data[0]<yprice){
            $('#youjia').attr("class","drop");
          }else if(data[0]==yprice){}else{
            $('#youjia').attr("class","rise");
          }              
        },  
        }); 
     };
function butt2(){
  var yprice = $('#baiyinjia').text();
 //获取白银的价格到页面  
    $.ajax({  
    type: "post",  
    url: "<?php echo U('Index/byprice');?>",         
    success: function(data) {
		console.dir(data);
	//  //最新白银价
       if (data[0]>0) {
            $('#baiyinjia').html(data[0]); 
      // //隐藏白银价
            $('.ycbaiyinjia').html(data[0]); 
            //现在
          $('#bdangqianj').html(data[0]);
       }
      // //昨收
       $('#byzs').html(data[7]);   
      // //最高  
       $('#byzg').html(data[4]);   
      // //今开
       $('#byjk').html(data[8]);   
      // //最低
       $('#byzd').html(data[5]);

      //var sum= data[12];
      if(data[0]<yprice){
        $('#baiyinjia').attr("class","drop");
      }else if(data[0]==yprice){}else{
        $('#baiyinjia').attr("class","rise");
      }              
      },  
      });
      
    };
     function butt3(){
      var yprice = $('#tojia').text();
         //获取铜的价格到页面  
        $.ajax({  
        type: "post",  
        url: "<?php echo U('Index/toprice');?>",         
        success: function(data) {
        //alert(data); 
         if (data[0]>0) {
             //最新白银价
           $('#tojia').html(data[0]); 
           // //隐藏白银价
           $('.yctojia').html(data[0]); 
            //现在
           $('#tdangqianj').html(data[0]);
         }
          
          // //昨收
           $('#tozs').html(data[7]);   
          // //最高  
           $('#tozg').html(data[4]);   
          // //今开
           $('#tojk').html(data[8]);   
          // //最低
           $('#tozd').html(data[5]);
          
          if(data[0]<yprice){
            $('#tojia').attr("class","drop");
          }else if(data[0]==yprice){}else{
            $('#tojia').attr("class","rise");
          }              
          },  
          }); 
  } ;  

    function orderlist(){
      $.ajax({  
        type: "post",  
        url: "<?php echo U('Index/orderlist');?>",         
        success: function(data) {
           console.dir(data);
           if (!data) {
               $('.jryk').css('display','none');
               $('.noclearfix').css('display','none');
           }else{
             $('.openpay').each(function(){
                var oid=$(this).find('.oid').text();
                // console.dir(oid);
                var str=inArray1(oid,data);
                if (!str) {
                  $('#ys_'+oid).hide();
                }
             });

           }
        }
      });
    }
	   
    function inArray1(needle,array,bool){  
    if(typeof needle=="string"||typeof needle=="number"){  
        for(var i in array){  
            if(needle===array[i]){  
                if(bool){  
                    return i;  
                }  
                return true;  
            }  
        }  
        return false;  
    }


    function getPrice() {

    }
}

  </script>

 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>