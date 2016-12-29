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
  <!-- <script id="G--xyscore-load" type="text/javascript" charset="utf-8" async="" src="/vpan/Public/Home/js/xyscore_main.js"></script> -->

  <div class="wrap">
    <div class="index">
      <header class="list-head" style="width:100%;">
        <nav class="list-nav clearfix"> <a href="<?php echo U('Index/index');?>" target="_self" class="list-back"></a>
          <input value="<?php echo ($order["cid"]); ?>" id="orcid" type="hidden">
          <h3 class="list-title"><?php echo ($order["ptitle"]); ?></h3>
        </nav>
      </header>

      <div class="news-list2 clearfix">
        <input value="<?php echo ($order["wave"]); ?>" id="orwave" type="hidden">
        <input value="<?php echo ($order["ostyle"]); ?>" id="orostyle" type="hidden">
        <input value="<?php echo ($order["uprice"]); ?>" id="uprice" type="hidden">

        <p><span class="l_l3">订单号：</span><span class="l_l"><?php echo ($order["orderno"]); ?></span></p>
        <p><span class="l_l3">建仓时间：</span><span class="l_l"><?php echo (date('Y-m-d H:i:s',$order["buytime"])); ?></span></p>
        <p><span class="l_l3">订单方向：</span><span class="l_l" id="getOstyle">涨</span></p>
        <p><span class="l_l3">杠杆比例：<span class="l_l">30倍</span></span></p>
        <p><span class="l_l3">手续费：<span class="l_l">1元/手</span></span></p>
        <p><span class="l_l3">入仓数量：</span><span class="l_l"><?php echo ($order["onumber"]); ?></span></p>

        <p class="oprice">
          <span class="l_l3">入仓价：</span>
          <span class="l_l rucang"><?php echo ($order["buyprice"]); ?></span>
          <span class="r_r"><?php echo ($order["ptitle"]); ?>现价：</span>
          <span class="l_l" id="youjia">

        </p>

        <!--<p class="oprice">-->
        <!--<span class="l_l3">选择时间：</span><span class="l_l"><?php echo ($order['shijian']); ?>分钟</span><span class="r_r">倒计时：</span><span class="l_l" id="havecode_btn"></span>-->

        <!--</p>-->


        <input type="hidden" id="selltime" value="<?php echo ($order['selltime']); ?>">
        <p>
          <span class="l_l3">建仓金额：</span>
          <?php if($order["eid"] == 1): ?><span class="l_l">0</span>
            <?php else: ?>
            <span class="l_l" id="jiancj"></span><?php endif; ?>
        </p>


        <!--<p>-->

        <!--<span class="l_l3">盈亏资金：</span>-->
            <!--<span class="l_l redd" id="ykzj"></span>-->
        <!--<?php if($order["eid"] != 1): ?>-->
            <!--<span class="l_l redd" id="mykbfb"></span>-->
        <!--<?php endif; ?>-->
        <!--<?php if($order["eid"] == 1): ?><span class="r_r"><img src="/vpan/Public/Home/images/ticket-small.png">(已使用<?php echo ($order["uprice"]); ?>元体验券)</span><?php endif; ?>-->

        <!--</p>-->


        <p><span class="l_l3">本单盈余：</span><span class="l_l" id="bdyy"></span></p>
      </div>
      <input onclick="SetRemainTimeNow()" style="width: 64px; height:32px; background-color: #ff7c83; color: #FFF; border-radius: 4px; margin-left: 45%; margin-bottom: 20px;" type="button" value="立即平仓"/>
      <a class="qxpc" href="<?php echo U('Index/index');?>">返回交易平台首页</a>

      <div id="bg2">
      </div>
      <input type="hidden" name="oid" value="<?php echo ($order["oid"]); ?>" id="buyid">
      <!--   <div class="payment_time_mask2" style="">
           <li id="guanbi"><h3>设置止盈/止损</h3></li>

                <nav class=""> <a href="javascript:;" class="back" ></a>

              </nav>
              <form id="jccg" class="build-form" method="post" action="<?php echo U('Detailed/edityk');?>" autocomplete="off">
              <div class="b-line" style="margin-left: 0px;">
                  <label class="b-label">确认数量：</label>
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
                <input type="hidden" name="oid" value="<?php echo ($order["oid"]); ?>" id="buyid">
                  <input type="hidden" name="zy" value="<?php echo ($order["endprofit"]); ?>" id="zy">
                  <input type="hidden" name="zk" value="<?php echo ($order["endloss"]); ?>" id="zk">
                  <input type="submit" class="pwd-btn  save" value="保存设置" onclick="baocun()">
                  </form>


  </div> -->

    </div>
  </div>
  </div>
  <div id="loading" style="width: 100%;height: 105%;position: absolute;top: 0; z-index: 9999;display: none;">
    <div class="load-center" style="background: #000;position: absolute;width: 60%;height: 14%;bottom: 10%;border-radius: 10px;color: #fff;text-align: center;font-size: 24px;left: 17%;padding: 1%;">
      <img src="/vpan/Public/Home/images/ajax-loading.jpg" alt="ajax-loading" width="40"/><br/>页面加载中...
    </div>
  </div>


  <link rel="stylesheet" href="/vpan/Public/Home/css/common.css"/>
  <script type="text/javascript" src="/vpan/Public/Home/js/jquery.min.js"></script>
  <script src="/vpan/Public/Home/js/script.js"></script>
  <script type="text/javascript">
    setInterval('butt()', 500);
    setInterval('mybutt()', 500);
    function butt(){
      var nprice = $("#youjia").html();
      var url = "<?php echo U('Index/price');?>";
      if ($('#orcid').val()==1) {
        url = "<?php echo U('Index/price');?>";
      }
      else if ($('#orcid').val()==2)
      {
        url = "<?php echo U('Index/byprice');?>";
      }else{
        url = "<?php echo U('Index/toprice');?>";
      };
      $.ajax({
        type: "post",
        url: url,
        success: function(data) {
          $('#youjia').html(data[0]);
          //隐藏油价
          if(data[0]>nprice){
            $('#youjia').attr("class","l_l redd");
          }else if(data[0]==nprice){}else{
            $('#youjia').attr("class","l_l jg2");
          }
        }
      });
    }
    function mybutt(){
      $.ajax({
        type: "post",
        url: "<?php echo U('Detailed/orderxq');?>",
        data:{"oid":$('#buyid').val(),"youjia":$('#youjia').html(),'cid':$('#orcid').val()},
        beforeSend:function(XMLHttpRequest){
          //alert('远程调用开始...');
        },
        success: function(data) {
          $('#jiancj').html(data['jc']);
          //$('#ykzj').html(data['ykzj']);
          $('#bdyy').html(data['bdyy']);
          var sum1= parseFloat(data['ykbfb']).toFixed(2);
          if(sum1!='NaN'){
            $('#mykbfb').html('(<em id="ykbfb">'+sum1+'</em>)%');
          }

          //在用户亏损达到保证金金额后将用户的订单执行平仓处理
//          var bdyy = data['bdyy'];
//          var jiancj = data['jc'];

//          if (bdyy <= -jiancj){
//
//            //立即平仓
//            ClosePosition();
//          }


          //盈亏资金
          var sum= data['ykzj'];
          if(sum>0){
            $('#ykzj').attr("class","l_l redd");
          }else{
            $('#ykzj').attr("class","l_l jg2");
          }

          if(sum1>0){
             $('#mykbfb').attr("class","l_l redd");
          }else{
            $('#mykbfb').attr("class","l_l jg2");
          }
        },
        error: function(data) {
          //alert(data);
        }
      });
    }
  </script>
  <script type="text/javascript">
    $(function(){
      sendMessage();
    });


    var num = "<?php echo ($order["ostyle"]); ?>";
    if (num == 0){
      $("#getOstyle").html("<span>买涨</span>");
    }
    else {
      $("#getOstyle").html("<span>买跌</span>");
    }



    var shi=$('#selltime').val();
    var InterValObj; //timer变量，控制时间
    var curCount;//当前剩余秒数
    function sendMessage() {
      $.ajax({
        type: "post",
        url: "<?php echo U('Detailed/gettime');?>",
        success: function(data) {
          var time=data;
          var count = shi-time;
          curCount = count;
          InterValObj = window.setInterval(SetRemainTime, 1000);
        },
        error: function(data) {

        }
      });
    }
    function SetRemainTime() {
      if (curCount <= 0) {
        window.clearInterval(InterValObj);//停止计时器
        window.setTimeout(function(){ location.href = "<?php echo U('Index/index');?>"; },1000);
      }
      else {
        curCount--;
        $("#havecode_btn").html(curCount + "秒");
      }
    }

    //立即平仓
    function SetRemainTimeNow() {

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
          if (confirm("是否确定要平仓？")) {

            //确定
            ClosePosition();

          }
        }
        else {
          alert("休市时间不能平仓");
        }


      }else {

        alert("休市时间不能平仓");
      }

    }

    //平仓
    function ClosePosition() {
      var orderno = "<?php echo ($order["orderno"]); ?>";
      var buyTime = "<?php echo ($order["buytime"]); ?>";

      $.ajax({
        type: "post",
        url: "<?php echo U('Detailed/setClosePosition');?>",
        data: {"orderno": orderno, "buytime": buyTime},
        success: function (data) {

          //重置定时器为0
          curCount = 0;
          SetRemainTime();
        },
        error: function (data) {

          alert('false');
        }
      });
    }

  </script>


 </div>
<div class="xiaoxi"><div id="msg" class="msg"></div></div> 
</body>
</html>