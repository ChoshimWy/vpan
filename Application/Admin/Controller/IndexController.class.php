<?php

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
    	header("Content-type: text/html; charset=utf-8");
    	$user= A('Admin/User');
		$user->checklogin();
		
		$tq=C('DB_PREFIX');
    	$user = D("userinfo");
		$order = D("order");
		$product = D("productinfo");
		$account = D("accountinfo");
		
    	$today = date("Y-m-d",time());
        $today = explode('-', $today);
		$begintime = mktime(0,0,0,$today[1],$today[2],$today[0]);
    	//用户数量
    	$userCount = $user->where('ustatus=0')->count();
		
    	//今日订单数量
    	$orderDay = $order->where("date_format(from_UNIXTIME(buytime),'%Y-%m-%d')>='".date('Y-m-d')."'")->count();
        //今日产生订单的用户
        //$alluser = $order->where('buytime>'.$begintime)->count();
        //今日产生买跌的数量
        $allostyle=$order->where('buytime>'.$begintime.' and '.$tq.'order.ostyle=1')->count();
        //今日产生买涨的数量
        $allrose=$order->where('buytime>'.$begintime.' and '.$tq.'order.ostyle=0')->count();
        //今日产生平仓的数量
        $allunwind=$order->where('buytime>'.$begintime.' and '.$tq.'order.ostaus=1')->count();
        //今日产生建仓的数量
        $allpositions=$order->where('buytime>'.$begintime.' and '.$tq.'order.ostaus=0')->count();
        

        //最近7天订单数量、最近30天交易总金额
		$sevenDay = date('Y-m-d',strtotime("-7 day"));
		$orderCount = $order->where("date_format(from_UNIXTIME(selltime),'%Y-%m-%d')>='".$sevenDay."'")->count();

		$last_day = date('Y-m-d',strtotime("-30 day"));
		$result = $order->where("date_format(from_UNIXTIME(selltime),'%Y-%m-%d')>='".$last_day."'")->select();
		for($i=0;$i<count($result);$i++){
			$total += ($result[$i]['onumber']*$result[$i]['buyprice']);
		}
		//最近30天交易总金额
		$total = number_format($total);
		
		$orders = $order->table('wp_userinfo u,wp_order o,wp_productinfo p')->where('u.uid=o.uid and o.pid=p.pid')->field('u.uid as uid,u.username as username,o.buytime as buytime,p.pid as pid,p.ptitle as ptitle,p.uprice as uprice,o.onumber as onumber,o.ostyle as ostyle,o.ostaus as ostaus,o.fee as fee,o.orderno as orderno')->order('o.oid desc')->limit(10)->select();
		
		
		
		//产品信息展示
		$plist = $product->order('pid asc')->limit(5)->select();
		
		
		
		//var_dump($plist);
        $this->assign('allunwind',$allunwind);
        $this->assign('allpositions',$allpositions);
        $this->assign('allrose',$allrose);
        $this->assign('allostyle',$allostyle);
        $this->assign('alluser',$alluser);
		$this->assign('orderDay',$orderDay);
    	$this->assign('userCount',$userCount);
		$this->assign('orderCount',$orderCount);
		$this->assign('total',$total);
		$this->assign('orders',$orders);
		$this->assign('plist',$plist);
		$this->display();
	}
	public function price(){
		 $diancha=$this->selectcid(1);
         $source=file_get_contents("xh/conc.txt");
		
         $msg = explode(',',$source);
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
         
         //$myprice[0] =$myprice[0]*$diancha['myat']*$diancha['myatjia'];
         return $myprice[0];
    }
	public function byprice(){
		 $diancha=$this->selectcid(2);
         $source=file_get_contents("xh/baiyin.txt");
         $msg = explode(',',$source);
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
          $myprice[0] =$myprice[0]*$diancha['myat']*$diancha['myatjia'];
         return $myprice[0];
    }
	public function toprice(){
		 $diancha=$this->selectcid(3);
         $source=file_get_contents("xh/tong.txt");
         $msg = explode(',',$source);
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
          $myprice[0] =$myprice[0]*$diancha['myat']*$diancha['myatjia'];
         return $myprice[0];
    }
    ////////////////////////////
    //平仓处理
    /////////////////////////////
    public function crons()
    {
        //写入文件方法
        $isopen=M('webconfig')->where('id=1')->find();
        
        //获取所有没有平仓的订单
        $tq=C('DB_PREFIX');
        $orders = D('order');
        $users = D('userinfo');
        $jo = D('journal');
        $detailed = A('Admin/User');
        $orderno = $this->build_order_no();
        $field = $tq.'order.eid as eid,'.$tq.'order.oid as oid,'.$tq.'order.buyprice as buyprice,'.$tq.'order.onumber as onumber,'.$tq.'productinfo.wave as wave,'.$tq.'order.endprofit as endprofit,'.$tq.'order.endloss as endloss,'.$tq.'catproduct.cid as cid,'.$tq.'productinfo.uprice as uprice,'.$tq.'productinfo.patx as patx,'.$tq.'order.uid as uid,'.$tq.'order.ptitle as ptitle,'.$tq.'order.pid as pid,'.$tq.'accountinfo.balance as balance,'.$tq.'userinfo.username as username,'.$tq.'order.ostyle as ostyle,'.$tq.'order.fee as fee,'.$tq.'catproduct.myat as myat,'.$tq.'order.selltime as selltime';
        //$olist = $orders->where('ostaus=0')->select();
        $order=$orders->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')
        ->join($tq.'catproduct on '.$tq.'productinfo.cid='.$tq.'catproduct.cid')->join($tq.'userinfo on '.$tq.'order.uid='.$tq.'userinfo.uid')->join($tq.'accountinfo on '.$tq.'order.uid='.$tq.'accountinfo.uid')->field($field)->where('ostaus=0')->select();
        
        //计算盈余中间变量
        $TempDataBegin=0;
        $TempDataEnd=0;
        $TempData=0 ;
        
        if ($order) {
            //获取最新产品价格
            $yprice = $this->price();//油价
            $byprice = $this->byprice();//白银价
            $toprice = $this->toprice();//铜价
            	
 
            if(date("H")==4 || $isopen['isopen']==0){
                	
                if($yprice>0 && $byprice>0 && $toprice>0){
                    //设置盈亏比，爆仓
                    //设置盈亏比，爆仓
                    foreach($order as $k => $v){
                        $uid = $v['uid'];
                        $uprice=$v['uprice'];   //获取商品的价格。
                        $endprofit=$v['endprofit']*$uprice*0.01;//获取止盈
                        $endloss=$v['endloss']*$uprice*0.01;	//获取止损
                        $ostyle=$v['ostyle'];	//获取买张买跌的值，0是涨，1是跌。
                        $cid = $v['cid'];		//商品区分
                        $buyprice=$v['buyprice'];
                        $onumber=$v['onumber'];    //交易手数量
        
                        if ($ostyle==0) {
                            //买涨处理
                            //韦东沛修改
                       
        
                            //$ploss = ($yprice-$buyprice)*$onumber*$v['patx'];//盈亏资金
                            $ploss = ($yprice-$buyprice)*$onumber;//盈亏资金
                            $youjia=$yprice;
                            //韦东沛修改结束
                            	
                            if ($v['eid']==0) {
                                if($ploss>0){
                                    $bdyy=$uprice*$onumber+$uprice*$onumber;
                                }elseif($ploss==0){
                                    $bdyy=$uprice*$onumber;
                                }else{
                                    $bdyy=0;
                                }
                            }else{
                                if($ploss>0){
                                    $bdyy=$uprice*$onumber;
                                }else{
                                    $bdyy=0;
                                }
                            }
                        }
                        else
                        {
                            //买跌时处理代码（谁这么写？）
                            if($cid==1){
                                //韦东沛修改
                                //$ploss = ($buyprice-$yprice)*$onumber*$v['patx'];//盈亏资金
                                $ploss = ($buyprice-$yprice)*$onumber;//盈亏资金
                                	
                                $youjia=$yprice;
                            }elseif($cid==2){
                                $ploss = ($buyprice-$byprice)*$onumber;		//盈亏资金
                                $youjia=$byprice;
                            }elseif($cid==3){
                                $ploss = ($buyprice-$toprice)*$onumber;		//盈亏资金
                                $youjia=$toprice;
                            }
                            if ($v['eid']==0) {
                                if($ploss>0){
                                    $bdyy=$uprice*$onumber+$uprice*$onumber;
                                }elseif($ploss==0){
                                    $bdyy=$uprice*$onumber;
                                }else{
                                    $bdyy=0;
                                }
                            }else{
                                if($ploss>0){
                                    $bdyy=$uprice*$onumber;
                                }else{
                                    $bdyy=0;
                                }
                            }
        
                        }
        
                        	
                        // $date['selltime']=date(time());
                        $date['ostaus']=1;
                        $date['sellprice']=$youjia;
                        // 			        if ($v['eid']==0) {
                        // 			        	$date['ploss']=$bdyy-$uprice*$onumber;
                        // 			        }else{
                        // 			        	$date['ploss']=$bdyy;
                        // 			        }
        
                         
                        //以下跟买跌处理无关
                        if ($v['eid']==0) {
                            //$TempData1=floor($youjia*$onumber/30);
                            $TempDataBegin=$buyprice;
                            $TempDataEnd=$youjia;
                            $TempData=($TempDataEnd - $TempDataBegin) *$onumber ;
                             
                            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                            $date['ploss']=$TempData;
                             
                             
                        }else{
                            //$date['ploss']=$bdyy;
                            //优惠券的盈余
                            $TempDataBegin=$buyprice;
                            $TempDataEnd=$youjia;
                            //优惠券
                            $TempData=($TempDataEnd - $TempDataBegin ) *$onumber;
                            //如果亏损，则账户金额不减少
                            if ($TempData<0)
                            {
                                $TempData=0;
                            }
                            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                            $date['ploss']=$TempData;
                             
                        }
                        $bdyy = floor($buyprice/30)*$onumber + $TempData;
                        //韦东沛修改。fee不用再计算。
                        //$date['fee']=$v['fee']*$onumber;
                         
                        $msg= $orders->where('oid='.$v['oid'])->save($date);
                         
                         
                         
                        if ($msg) {
                            $myprice=M('accountinfo')->where('uid='.$uid)->find();
                            $acco= M('accountinfo');
                            $acco->uid=$uid;
                             
        
                            //原作者的代码
                            //$acco->balance=$myprice['balance']+$bdyy;
                            //韦东沛修改
                            //买跌时计算的余额
                            $acco->balance=$myprice['balance'] + floor($buyprice/30)*$onumber + $TempData;
                             
                             
                             
                            $acco->save();
                            //根据商品id查询商品
                            $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
                            //用户亏损了，返点
                            //添加平仓日志表
                            //随机生成订单号
                            $myjournal=M('journal');
                            $journal['jno']=$this->build_order_no();						//订单号
                            $journal['uid'] = $uid;											//用户id
                            $journal['jtype'] = '平仓';										//类型
                            $journal['jtime'] = date(time());								//操作时间
                            $journal['jincome'] = $bdyy + $date['fee'];						//收支金额【要予以删除】
                            $journal['number'] = $v['onumber'];						        //数量
                            $journal['remarks'] = $goods['ptitle'];							//产品名称
                            $journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
                            if ($bdyy>$uprice*$onumber){
                                $journal['jstate']=1;										//盈利还是亏损
                            }else{
                                $journal['jstate']=0;
                            }
                            $journal['jusername'] = $_SESSION['husername'];								//用户名
                            $journal['jostyle'] = $ostyle;						//涨、跌
                            $journal['juprice'] = $uprice;									//单价
                            $journal['jfee'] = $fee;										//手续费
                            $journal['jbuyprice'] = $v['buyprice'];					//入仓价
                            $journal['jsellprice'] = $youjia;								//平仓价
                            $journal['jaccess'] = $bdyy;									//出入金额
                            $journal['jploss'] = $ploss;										//出入金额
                            $journal['oid'] = $oid;											//改订单流水的订单id
                            $journal['explain'] = $otype.'平仓';
                            $myjournal->add($journal);
                            $orders->where('oid='.$oid)->setField('commission',$journal['balance']);
                        }else{
                            $msg="平仓失败，稍后平仓";
                        }
        
                    }
                }
            }else{
        
                if($yprice>0 && $byprice>0 && $toprice>0){
                    //设置盈亏比，爆仓
                    foreach($order as $k => $v){
                        $uid = $v['uid'];
                        $uprice=$v['uprice'];   //获取商品的价格。
                        $endprofit=$v['endprofit']*$uprice*0.01;//获取止盈
                        $endloss=$v['endloss']*$uprice*0.01;	//获取止损
                        $ostyle=$v['ostyle'];	//获取买张买跌的值，0是涨，1是跌。
                        $cid = $v['cid'];		//商品区分
                        $buyprice=$v['buyprice'];
                        $onumber=$v['onumber'];
                        $selltime=$v['selltime'];  //时间


                        //买涨
                        if ($ostyle==0) {
                            if($cid==1){
                                //韦东沛修改
                                //$ploss = ($yprice-$buyprice)*$onumber*$v['patx'];//盈亏资金
                                $ploss = ($yprice-$buyprice)*$onumber;//盈亏资金
        
                                $youjia=$yprice;
                            }elseif($cid==2){
                                $ploss = ($byprice-$buyprice)*$onumber;		//盈亏资金
                                $youjia=$byprice;
                            }elseif($cid==3){
                                $ploss = ($toprice-$buyprice)*$onumber;		//盈亏资金
                                $youjia=$toprice;
                            }
        
                            if ($v['eid']==0) {
                                //真正花钱
 
                                //本单盈余
                                $bdyy=$uprice*$onumber ;
        
                            }else{
                                if($ploss>0){
                                    $bdyy=$uprice*$onumber;
                                }else{
                                    $bdyy=0;
                                }
                            }
        
        
                            	
                            //平仓
                            if ($selltime<=date(time())) {
                                // $date['selltime']=date(time());
                                $date['ostaus']=1;
                                $date['sellprice']=$youjia;
                                if ($v['eid']==0) {
                                    //$TempData1=floor($youjia*$onumber/30);
        
                                    $TempDataBegin=$buyprice;
                                    $TempDataEnd=$youjia;
                                    $TempData=($TempDataEnd - $TempDataBegin) *$onumber ;
                                    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                    $date['ploss']=$TempData;



                                    $bdyy = floor($buyprice/30)*$onumber + $TempData;
        
                                }else{
                                    //$date['ploss']=$bdyy;
                                    //优惠券的盈余
                                    //优惠券的盈余
                                    $TempDataBegin=$buyprice;
                                    $TempDataEnd=$youjia;
                                    //优惠券
                                    $TempData=($TempDataEnd - $TempDataBegin ) *$onumber;
                                    //如果亏损，则账户金额不减少
                                    if ($TempData<0)
                                    {
                                        $TempData=0;
                                    }
                                    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                    $date['ploss']=$TempData;


                                    $bdyy = $TempData;
        
                                }
                                 

        
                                //$date['fee']=$v['fee']*$onumber;
                                //$date['fee']=$v['fee'];
        
                                $msg= $orders->where('oid='.$v['oid'])->save($date);
        
        
        
        
                                if ($msg) {
                                    $myprice=M('accountinfo')->where('uid='.$uid)->find();
                                    $acco= M('accountinfo');
                                    $acco->uid=$uid;
        
                                    //$acco->balance=$myprice['balance']+$bdyy;
                                    //买涨时计算的


                                    $acco->balance=$myprice['balance'] + $bdyy;

        
                                    $acco->save();
        
                                     
                                    //根据商品id查询商品
                                    $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
                                    //用户亏损了，返点
                                    //添加平仓日志表
                                    //随机生成订单号
                                    $myjournal=M('journal');
                                    $journal['jno']=$this->build_order_no();						//订单号
                                    $journal['uid'] = $uid;											//用户id
                                    $journal['jtype'] = '平仓';										//类型
                                    $journal['jtime'] = date(time());								//操作时间
                                    $journal['jincome'] = $bdyy;									//收支金额【要予以删除】
                                    $journal['number'] = $v['onumber'];						//数量
                                    $journal['remarks'] = $v['ptitle'];							//产品名称
                                    $journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
                                    if ($bdyy>$uprice*$onumber){
                                        $journal['jstate']=1;										//盈利还是亏损
                                    }else{
                                        $journal['jstate']=0;
                                    }
                                    $journal['jusername'] = $_SESSION['husername'];								//用户名
                                    $journal['jostyle'] = $ostyle;						//涨、跌
                                    $journal['juprice'] = $uprice;									//单价
                                    $journal['jfee'] = $fee;										//手续费
                                    $journal['jbuyprice'] = $v['buyprice'];					//入仓价
                                    $journal['jsellprice'] = $youjia;								//平仓价
                                    $journal['jaccess'] = $bdyy;									//出入金额
                                    $journal['jploss'] = $ploss;										//出入金额
                                    $journal['oid'] = $oid;											//改订单流水的订单id
                                    $journal['explain'] = $otype.'平仓';
                                    $myjournal->add($journal);
                                    $orders->where('oid='.$oid)->setField('commission',$journal['balance']);
                                }else{
                                    $msg="平仓失败，稍后平仓";
                                }
                            }
                        }

                        //买跌
                        else
                        {
                            if($cid==1){
                                //$ploss = ($buyprice-$yprice)*$onumber*$v['patx'];//盈亏资金
                                $ploss = ($buyprice-$yprice)*$onumber;//盈亏资金
                                	
                                $youjia=$yprice;
                            }elseif($cid==2){
                                $ploss =($buyprice-$byprice)*$onumber;		//盈亏资金
                                $youjia=$byprice;
                            }elseif($cid==3){
                                $ploss =($buyprice-$toprice)*$onumber;		//盈亏资金
                                $youjia=$toprice;
                            }
        
        
                            if ($v['eid']==0) {
                                //$TempData1=floor($youjia*$onumber/30);
        
                                $TempDataBegin=$buyprice;
                                $TempDataEnd=$youjia;
                                $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
                                //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                $date['ploss']=$TempData;

                                $bdyy = floor($buyprice/30)*$onumber + $TempData;
                            }else{
                                //$date['ploss']=$bdyy;
                                //优惠券的盈余
                                $TempDataBegin=$buyprice;
                                $TempDataEnd=$youjia;
                                //优惠券
                                $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
                                //如果亏损，则账户金额不减少
                                if ($TempData<0)
                                {
                                    $TempData=0;
                                }
                                //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                $date['ploss']=$TempData;

                                $bdyy =  $TempData;
                            }

                            // 平仓
                            if ($selltime<=date(time())) {
                                //买跌时处理
                                // $date['selltime']=date(time());
                                $date['ostaus']=1;
                                $date['sellprice']=$youjia;
                                // 						        if ($v['eid']==0) {
                                // 						        	$date['ploss']=$bdyy-$uprice*$onumber;
                                // 						        }else{
                                // 						        	$date['ploss']=$bdyy;
                                // 						        }
        
                                if ($v['eid']==0) {
                                    //$TempData1=floor($youjia*$onumber/30);
        
                                    $TempDataBegin=$buyprice;
                                    $TempDataEnd=$youjia;
                                    $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
                                    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                    $date['ploss']=$TempData;
                                    $bdyy = floor($buyprice/30)*$onumber + $TempData;
                                     
                                }else{
                                    //$date['ploss']=$bdyy;
                                    //优惠券的盈余
                                    $TempDataBegin=$buyprice;
                                    $TempDataEnd=$youjia;
                                    //优惠券
                                    $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
                                    //如果亏损，则账户金额不减少
                                    if ($TempData<0)
                                    {
                                        $TempData=0;
                                    }
                                    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
                                    $date['ploss']=$TempData;

                                    $bdyy =  $TempData;
                                }
        

        
                                //$date['fee']=$v['fee']*$onumber;
        
                                $msg= $orders->where('oid='.$v['oid'])->save($date);
                                if ($msg) {
                                    $myprice=M('accountinfo')->where('uid='.$uid)->find();
                                    $acco= M('accountinfo');
                                    $acco->uid=$uid;
                                    //不是买跌
                                    //$acco->balance=$myprice['balance']+$bdyy;
                                    //余额


                                    $acco->balance=$myprice['balance'] + $bdyy;


        
        
                                    $acco->save();
                                    //根据商品id查询商品
                                    $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
                                    //用户亏损了，返点
                                    //添加平仓日志表
                                    //随机生成订单号
                                    $myjournal=M('journal');
                                    $journal['jno']=$this->build_order_no();						//订单号
                                    $journal['uid'] = $uid;											//用户id
                                    $journal['jtype'] = '平仓';										//类型
                                    $journal['jtime'] = date(time());								//操作时间
                                    $journal['jincome'] = $bdyy;									//收支金额【要予以删除】
                                    $journal['number'] = $v['onumber'];						//数量
                                    $journal['remarks'] = $v['ptitle'];							//产品名称
                                    $journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
                                    if ($bdyy>$uprice*$onumber){
                                        $journal['jstate']=1;										//盈利还是亏损
                                    }else{
                                        $journal['jstate']=0;
                                    }
                                    $journal['jusername'] = $_SESSION['husername'];								//用户名
                                    $journal['jostyle'] = $ostyle;						//涨、跌
                                    $journal['juprice'] = $uprice;									//单价
                                    $journal['jfee'] = $fee;										//手续费
                                    $journal['jbuyprice'] = $v['buyprice'];					//入仓价
                                    $journal['jsellprice'] = $youjia;								//平仓价
                                    $journal['jaccess'] = $bdyy;									//出入金额
                                    $journal['jploss'] = $ploss;										//出入金额
                                    $journal['oid'] = $oid;											//改订单流水的订单id
                                    $journal['explain'] = $otype.'平仓';
                                    $myjournal->add($journal);
                                    $orders->where('oid='.$oid)->setField('commission',$journal['balance']);
                                }else{
                                    $msg="平仓失败，稍后平仓";
                                }
                            }
                        }
        
                    }
                }
            }
        }
        
        //echo $orders->getLastSql();
        //$this->assign('olist',$order);
        //$this->display();
        
    }
    
    
	public function crons_old(){
		//写入文件方法
		$isopen=M('webconfig')->where('id=1')->find();
		
		//获取所有没有平仓的订单
		$tq=C('DB_PREFIX');
		$orders = D('order');
		$users = D('userinfo');
		$jo = D('journal');
		$detailed = A('Admin/User');
		$orderno = $this->build_order_no();
		$field = $tq.'order.eid as eid,'.$tq.'order.oid as oid,'.$tq.'order.buyprice as buyprice,'.$tq.'order.onumber as onumber,'.$tq.'productinfo.wave as wave,'.$tq.'order.endprofit as endprofit,'.$tq.'order.endloss as endloss,'.$tq.'catproduct.cid as cid,'.$tq.'productinfo.uprice as uprice,'.$tq.'productinfo.patx as patx,'.$tq.'order.uid as uid,'.$tq.'order.ptitle as ptitle,'.$tq.'order.pid as pid,'.$tq.'accountinfo.balance as balance,'.$tq.'userinfo.username as username,'.$tq.'order.ostyle as ostyle,'.$tq.'order.fee as fee,'.$tq.'catproduct.myat as myat,'.$tq.'order.selltime as selltime';
		//$olist = $orders->where('ostaus=0')->select();
		$order=$orders->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')
        ->join($tq.'catproduct on '.$tq.'productinfo.cid='.$tq.'catproduct.cid')->join($tq.'userinfo on '.$tq.'order.uid='.$tq.'userinfo.uid')->join($tq.'accountinfo on '.$tq.'order.uid='.$tq.'accountinfo.uid')->field($field)->where('ostaus=0')->select();
		
		//计算盈余中间变量
		$TempDataBegin=0;
		$TempDataEnd=0;
		$TempData=0 ;
		
		if ($order) {
			//获取最新产品价格
			$yprice = $this->price();//油价
			$byprice = $this->byprice();//白银价
			$toprice = $this->toprice();//铜价
			
			
			//if(date("H")==4 || $isopen['isopen']==0){
			if(date("H")==4 || $isopen['isopen']==0){
			
			if($yprice>0 && $byprice>0 && $toprice>0){
				//设置盈亏比，爆仓
						//设置盈亏比，爆仓
				foreach($order as $k => $v){
					$uid = $v['uid'];	
					$uprice=$v['uprice'];   //获取商品的价格。
					$endprofit=$v['endprofit']*$uprice*0.01;//获取止盈
					$endloss=$v['endloss']*$uprice*0.01;	//获取止损
					$ostyle=$v['ostyle'];	//获取买张买跌的值，0是涨，1是跌。
					$cid = $v['cid'];		//商品区分
					$buyprice=$v['buyprice'];
					$onumber=$v['onumber'];    //交易手数量

					if ($ostyle==0) {
					    //买涨处理
					    //韦东沛修改
// 						if($cid==1){
// 							$ploss = ($yprice-$buyprice)*$onumber*$v['patx'];//盈亏资金		
			 
// 							$youjia=$yprice;		
// 						}elseif($cid==2){
// 							$ploss = ($byprice-$buyprice)*$onumber*$v['patx'];		//盈亏资金
// 							$youjia=$byprice;
// 						}elseif($cid==3){
// 							$ploss = ($toprice-$buyprice)*$onumber*$v['patx'];		//盈亏资金
// 							$youjia=$toprice;
// 						}

					       //$ploss = ($yprice-$buyprice)*$onumber*$v['patx'];//盈亏资金
					    $ploss = ($yprice-$buyprice)*$onumber;//盈亏资金
    					    $youjia=$yprice;
    					    //韦东沛修改结束
    					    
							if ($v['eid']==0) {
								if($ploss>0){
								$bdyy=$uprice*$onumber+$uprice*$onumber;
								 }elseif($ploss==0){
								   $bdyy=$uprice*$onumber;  	
								 }else{
									$bdyy=0; 
								 }
							}else{
								 if($ploss>0){
								   $bdyy=$uprice*$onumber;
								 }else{
									$bdyy=0;
								 }
							}
					}
					else
					{
					    //买跌时处理代码（谁这么写？）
						if($cid==1){
						    //韦东沛修改
							//$ploss = ($buyprice-$yprice)*$onumber*$v['patx'];//盈亏资金		
						    $ploss = ($buyprice-$yprice)*$onumber;//盈亏资金
				 
							$youjia=$yprice;		
						}elseif($cid==2){
							$ploss = ($buyprice-$byprice)*$onumber;		//盈亏资金
							$youjia=$byprice;
						}elseif($cid==3){
							$ploss = ($buyprice-$toprice)*$onumber;		//盈亏资金
							$youjia=$toprice;
						}
						if ($v['eid']==0) {
								if($ploss>0){
								 $bdyy=$uprice*$onumber+$uprice*$onumber;
								 }elseif($ploss==0){
								   $bdyy=$uprice*$onumber;  	
								 }else{
									$bdyy=0; 
								 }
							}else{
								 if($ploss>0){
								    $bdyy=$uprice*$onumber;
								 }else{
									$bdyy=0; 
								 }
							}
						
					}
				
			
			        // $date['selltime']=date(time());
			        $date['ostaus']=1;
			        $date['sellprice']=$youjia;
// 			        if ($v['eid']==0) {
// 			        	$date['ploss']=$bdyy-$uprice*$onumber;
// 			        }else{
// 			        	$date['ploss']=$bdyy;
// 			        }
                    
			        
			        //以下跟买跌处理无关
			        if ($v['eid']==0) {
			            //$TempData1=floor($youjia*$onumber/30);
			            $TempDataBegin=$buyprice;
			            $TempDataEnd=$youjia;
			            $TempData=($TempDataEnd - $TempDataBegin) *$onumber ;
		             
			            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
			            $date['ploss']=$TempData;
			            
			        
			        }else{
			            //$date['ploss']=$bdyy;
			            //优惠券的盈余
			            $TempDataBegin=$buyprice;
			            $TempDataEnd=$youjia;
			            //优惠券要加上买入保证金
			            $TempData=($TempDataEnd - $TempDataBegin + floor($buyprice/30)) *$onumber;
			            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
			            $date['ploss']=$TempData;
			        
			        }
			        $bdyy = floor($buyprice/30)*$onumber + $TempData;
			        //韦东沛修改。fee不用再计算。
			        //$date['fee']=$v['fee']*$onumber;
			        
			        $msg= $orders->where('oid='.$v['oid'])->save($date);
			        
			        
			        
			        if ($msg) {
			            $myprice=M('accountinfo')->where('uid='.$uid)->find();
			            $acco= M('accountinfo');
			            $acco->uid=$uid;
			            

			            //原作者的代码
			            //$acco->balance=$myprice['balance']+$bdyy;
			            //韦东沛修改
			            //买跌时计算的余额

			            $acco->balance=$myprice['balance'] + floor($buyprice/30)*$onumber + $TempData;
			            
			            
			            
			            $acco->save();
						//根据商品id查询商品
			            $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
						//用户亏损了，返点
			            //添加平仓日志表
			            //随机生成订单号
			            $myjournal=M('journal');
						$journal['jno']=$this->build_order_no();						//订单号
						$journal['uid'] = $uid;											//用户id
						$journal['jtype'] = '平仓';										//类型	
						$journal['jtime'] = date(time());								//操作时间
						$journal['jincome'] = $bdyy + $date['fee'];						//收支金额【要予以删除】
						$journal['number'] = $v['onumber'];						        //数量			
						$journal['remarks'] = $goods['ptitle'];							//产品名称	
						$journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
						if ($bdyy>$uprice*$onumber){
			                  $journal['jstate']=1;										//盈利还是亏损
			            }else{
			                  $journal['jstate']=0;
			            }			
						$journal['jusername'] = $_SESSION['husername'];								//用户名
						$journal['jostyle'] = $ostyle;						//涨、跌
						$journal['juprice'] = $uprice;									//单价
						$journal['jfee'] = $fee;										//手续费
						$journal['jbuyprice'] = $v['buyprice'];					//入仓价
						$journal['jsellprice'] = $youjia;								//平仓价
						$journal['jaccess'] = $bdyy;									//出入金额
						$journal['jploss'] = $ploss;										//出入金额
						$journal['oid'] = $oid;											//改订单流水的订单id
						$journal['explain'] = $otype.'平仓';
			            $myjournal->add($journal);
						$orders->where('oid='.$oid)->setField('commission',$journal['balance']);
			        }else{
			           $msg="平仓失败，稍后平仓";
			        }	
				  
				}
			}
		}else{

			if($yprice>0 && $byprice>0 && $toprice>0){	
				//设置盈亏比，爆仓
				foreach($order as $k => $v){
					$uid = $v['uid'];	
					$uprice=$v['uprice'];   //获取商品的价格。
					$endprofit=$v['endprofit']*$uprice*0.01;//获取止盈
					$endloss=$v['endloss']*$uprice*0.01;	//获取止损
					$ostyle=$v['ostyle'];	//获取买张买跌的值，0是涨，1是跌。
					$cid = $v['cid'];		//商品区分
					$buyprice=$v['buyprice'];
					$onumber=$v['onumber'];
					$selltime=$v['selltime'];  //时间

					if ($ostyle==0) {
						if($cid==1){
						    //韦东沛修改
							//$ploss = ($yprice-$buyprice)*$onumber*$v['patx'];//盈亏资金		
						    $ploss = ($yprice-$buyprice)*$onumber;//盈亏资金
						    
							$youjia=$yprice;		
						}elseif($cid==2){
							$ploss = ($byprice-$buyprice)*$onumber;		//盈亏资金
							$youjia=$byprice;
						}elseif($cid==3){
							$ploss = ($toprice-$buyprice)*$onumber;		//盈亏资金
							$youjia=$toprice;
						}
						
						if ($v['eid']==0) {
						    //真正花钱
// 								if($ploss>0){
// 								//$bdyy=$uprice*$onumber+$uprice*$onumber*0.75;
// 								    //本单盈余
// 								    $bdyy=$uprice*$onumber ;
// 								 }elseif($ploss==0){
// 								   $bdyy=$uprice*$onumber;  	
// 								 }else{
// 									$bdyy=0; 
// 								 }
                                    //本单盈余
						          $bdyy=$uprice*$onumber ;
						    
							}else{
								 if($ploss>0){
								   $bdyy=$uprice*$onumber;
								 }else{
									$bdyy=0; 
								 }
							}
						

							
						//平仓
						if ($selltime<=date(time())) {
						        // $date['selltime']=date(time());
						        $date['ostaus']=1;
						        $date['sellprice']=$youjia;
						        if ($v['eid']==0) {
						            //$TempData1=floor($youjia*$onumber/30);
						            
						            $TempDataBegin=$buyprice;
						            $TempDataEnd=$youjia;
						            $TempData=($TempDataEnd - $TempDataBegin) *$onumber ;
						              //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
							        $date['ploss']=$TempData;
						            
							        	 
							        	 
							        	
						            
						        }else{
						        	//$date['ploss']=$bdyy;
						        	//优惠券的盈余
						            $TempDataBegin=$buyprice;
						            $TempDataEnd=$youjia;
						            //优惠券要加上买入保证金
						            $TempData=($TempDataEnd - $TempDataBegin + floor($buyprice/30)) *$onumber;
						            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
						            $date['ploss']=$TempData;
						             
						            
						     
						            
						        }
						       
						        $bdyy = floor($buyprice/30)*$onumber + $TempData;
						        
						        //$date['fee']=$v['fee']*$onumber;
						        //$date['fee']=$v['fee'];
						        
						        $msg= $orders->where('oid='.$v['oid'])->save($date);
						        
						        
						        
						        
						        if ($msg) {
						            $myprice=M('accountinfo')->where('uid='.$uid)->find();
						            $acco= M('accountinfo');
						            $acco->uid=$uid;
						            
						            //$acco->balance=$myprice['balance']+$bdyy;
						            //买涨时计算的
						            $acco->balance=$myprice['balance'] + floor($buyprice/30)*$onumber + $TempData;
						            
						            
						            $acco->save();
						            
						             
									//根据商品id查询商品
						            $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
									//用户亏损了，返点
						            //添加平仓日志表
						            //随机生成订单号
						            $myjournal=M('journal');
									$journal['jno']=$this->build_order_no();						//订单号
									$journal['uid'] = $uid;											//用户id
									$journal['jtype'] = '平仓';										//类型	
									$journal['jtime'] = date(time());								//操作时间
									$journal['jincome'] = $bdyy;									//收支金额【要予以删除】
									$journal['number'] = $v['onumber'];						//数量			
									$journal['remarks'] = $v['ptitle'];							//产品名称	
									$journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
									if ($bdyy>$uprice*$onumber){
						                  $journal['jstate']=1;										//盈利还是亏损
						            }else{
						                  $journal['jstate']=0;
						            }			
									$journal['jusername'] = $_SESSION['husername'];								//用户名
									$journal['jostyle'] = $ostyle;						//涨、跌
									$journal['juprice'] = $uprice;									//单价
									$journal['jfee'] = $fee;										//手续费
									$journal['jbuyprice'] = $v['buyprice'];					//入仓价
									$journal['jsellprice'] = $youjia;								//平仓价
									$journal['jaccess'] = $bdyy;									//出入金额
									$journal['jploss'] = $ploss;										//出入金额
									$journal['oid'] = $oid;											//改订单流水的订单id
									$journal['explain'] = $otype.'平仓';
						            $myjournal->add($journal);
									$orders->where('oid='.$oid)->setField('commission',$journal['balance']);
						        }else{
						           $msg="平仓失败，稍后平仓";
						        }	
						}
					}
					else
					{
							if($cid==1){
							//$ploss = ($buyprice-$yprice)*$onumber*$v['patx'];//盈亏资金
							    $ploss = ($buyprice-$yprice)*$onumber;//盈亏资金
							    
							$youjia=$yprice;		
						}elseif($cid==2){
							$ploss =($buyprice-$byprice)*$onumber;		//盈亏资金
							$youjia=$byprice;
						}elseif($cid==3){
							$ploss =($buyprice-$toprice)*$onumber;		//盈亏资金
							$youjia=$toprice;
						}
						
 
						if ($v['eid']==0) {
						    //$TempData1=floor($youjia*$onumber/30);
						
						    $TempDataBegin=$buyprice;
						    $TempDataEnd=$youjia;
						    $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
						    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
						    $date['ploss']=$TempData;
						     
						
						}else{
						    //$date['ploss']=$bdyy;
						    //优惠券的盈余
						    $TempDataBegin=$buyprice;
						    $TempDataEnd=$youjia;
						    //优惠券要加上买入保证金
						    $TempData=($TempDataEnd - $TempDataBegin + floor($buyprice/30)) *$onumber;
						    //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
						    $date['ploss']=$TempData;
						    	
						
						}
						$bdyy = floor($buyprice/30)*$onumber + $TempData;
						// 平仓
						if ($selltime<=date(time())) {
						    //买跌时处理
						       // $date['selltime']=date(time());
						        $date['ostaus']=1;
						        $date['sellprice']=$youjia;
// 						        if ($v['eid']==0) {
// 						        	$date['ploss']=$bdyy-$uprice*$onumber;
// 						        }else{
// 						        	$date['ploss']=$bdyy;
// 						        }
						        
						        if ($v['eid']==0) {
						            //$TempData1=floor($youjia*$onumber/30);
						        
						            $TempDataBegin=$buyprice;
						            $TempDataEnd=$youjia;
						            $TempData=($TempDataBegin - $TempDataEnd ) *$onumber ;
						            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
						            $date['ploss']=$TempData;
						         
						        }else{
						            //$date['ploss']=$bdyy;
						            //优惠券的盈余
						            $TempDataBegin=$buyprice;
						            $TempDataEnd=$youjia;
						            //优惠券要加上买入保证金
						            $TempData=($TempDataBegin - $TempDataEnd   + floor($buyprice/30)) *$onumber;
						            //韦东沛修改。盈余=（当前价格 - 买入价格）*手数
						            $date['ploss']=$TempData;
						            
						        
						        }
						      
						        $bdyy = floor($buyprice/30)*$onumber + $TempData;
						        
						        //$date['fee']=$v['fee']*$onumber;
						        
						        $msg= $orders->where('oid='.$v['oid'])->save($date);
						        if ($msg) {
						            $myprice=M('accountinfo')->where('uid='.$uid)->find();
						            $acco= M('accountinfo');
						            $acco->uid=$uid;
						            //不是买跌
						            //$acco->balance=$myprice['balance']+$bdyy;
						            //余额
						            $acco->balance=$myprice['balance'] + floor($buyprice/30)*$onumber + $TempData;
						            
						            
						            $acco->save();
									//根据商品id查询商品
						            $goods=M('productinfo')->where('pid='.$myorder['pid'])->find();
									//用户亏损了，返点
						            //添加平仓日志表
						            //随机生成订单号
						            $myjournal=M('journal');
									$journal['jno']=$this->build_order_no();						//订单号
									$journal['uid'] = $uid;											//用户id
									$journal['jtype'] = '平仓';										//类型	
									$journal['jtime'] = date(time());								//操作时间
									$journal['jincome'] = $bdyy;									//收支金额【要予以删除】
									$journal['number'] = $v['onumber'];						//数量			
									$journal['remarks'] = $v['ptitle'];							//产品名称	
									$journal['balance'] = $myprice['balance']+$bdyy;					//账户余额
									if ($bdyy>$uprice*$onumber){
						                  $journal['jstate']=1;										//盈利还是亏损
						            }else{
						                  $journal['jstate']=0;
						            }			
									$journal['jusername'] = $_SESSION['husername'];								//用户名
									$journal['jostyle'] = $ostyle;						//涨、跌
									$journal['juprice'] = $uprice;									//单价
									$journal['jfee'] = $fee;										//手续费
									$journal['jbuyprice'] = $v['buyprice'];					//入仓价
									$journal['jsellprice'] = $youjia;								//平仓价
									$journal['jaccess'] = $bdyy;									//出入金额
									$journal['jploss'] = $ploss;										//出入金额
									$journal['oid'] = $oid;											//改订单流水的订单id
									$journal['explain'] = $otype.'平仓';
						            $myjournal->add($journal);
									$orders->where('oid='.$oid)->setField('commission',$journal['balance']);
						        }else{
						           $msg="平仓失败，稍后平仓";
						        }	
						}
					}
				  
				}
			}
		}
	 }
		
		//echo $orders->getLastSql();
		//$this->assign('olist',$order);
		//$this->display();
	}

	//随机生成订单编号
	function build_order_no(){
	    return date(time()).substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 3);
	}
		//调取分类的点差
    function selectcid($cid){
        $str=M('catproduct')->where('cid='.$cid)->find();
        return  $str;
    }
    //手续费统计
    function sxf(){
        $tq=C('DB_PREFIX');

        $user = D('userinfo');
        $uid = $_SESSION['userid'];
        $admin = $user->where('uid='.$uid)->find();
        $this->assign('otype',$admin['otype']);

        $order = D('order');
        $account = D('accountinfo');
        $step = I('get.step');
        $field = $tq.'userinfo.username as username,'.$tq.'userinfo.nickname as nickname,'.$tq.'userinfo.uid as usid,'.$tq.'userinfo.utel as utel,'.
            $tq.'userinfo.address as address,'.$tq.'userinfo.portrait as portrait,'.$tq.'userinfo.utime as utime,'.$tq.'userinfo.oid as oid,'
            .$tq.'userinfo.managername as managername,'.$tq.'userinfo.lastlog as lastlog,'.$tq.'accountinfo.balance as balance,'
            .$tq.'userinfo.otype as otype,'.$tq.'userinfo.ustatus as ustatus';
        $bankinfo=M('bankinfo');
        //搜索
        if($step == "search"){
            $keywords = '%'.I('post.keywords').'%';
            $where['nickname'] = array('like',$keywords);

            $ulist = $user->field($field)->join($tq.'accountinfo on '.$tq.'userinfo.uid='.$tq.'accountinfo.uid','left')->order($tq.'userinfo.uid desc')->select();
            //循环用户id，获取该用户的所有订单数,交易总金额，交易费
            foreach($ulist as $k => $v){
                $ocount = $order->where($tq.'order.uid='.$v['usid'])->count();
                $ulist[$k]['ocount'] = $ocount;
                $zge=$order->where('uid='.$v['usid'])->sum('buyprice+sellprice');
                $jyf=$order->where('uid='.$v['usid'])->sum('fee');
                $ulist[$k]['zge']=$zge;
                $ulist[$k]['jyf']=$jyf;
                
                
            }
            if($ulist){
                $this->ajaxReturn($ulist);
            }else{
                $this->ajaxReturn("null");
            }
        }else{
            //分页
            $count = $user->count();
            $pagecount = 12;
            $page = new \Think\Page($count , $pagecount);
            $page->parameter = $row; //此处的row是数组，为了传递查询条件
            $page->setConfig('first','首页');
            $page->setConfig('prev','&#8249;');
            $page->setConfig('next','&#8250;');
            $page->setConfig('last','尾页');
            $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% ');
            $show = $page->show();
            //查询用户和账户信息
            $ulist = $user->join($tq.'accountinfo on '.$tq.'userinfo.uid='.$tq.'accountinfo.uid','left')->field($field)->order($tq.'userinfo.uid desc')->limit($page->firstRow.','.$page->listRows)->select();
            //循环用户id，获取该用户的所有订单数，交易总金额，交易费
            foreach($ulist as $k => $v){
                $ocount = $order->where('uid='.$v['usid'])->count();
                $zge = $order->where('uid='.$v['usid'])->sum('buyprice+sellprice');
                $jyf=$order->where('uid='.$v['usid'])->sum('fee');
                $ulist[$k]['ocount'] = $ocount;
                $ulist[$k]['zge']=$zge;
                $ulist[$k]['jyf']=$jyf;

            }
            $this->assign('page',$show);
            $this->assign('ulist',$ulist);
        }
        $this->display();
    }

    //系统信息列表
    function systemlist(){
        $user= A('Admin/User');
        $user->checklogin();

        $user = D('userinfo');
        $uid = $_SESSION['userid'];
        $admin = $user->where('uid='.$uid)->find();
        $this->assign('otype',$admin['otype']);

        $information = D('information');

        $count=$information->count();
        $pagecount = 20;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','&#8249;');
        $page->setConfig('next','&#8250;');
        $page->setConfig('last','尾页');
        $show = $page->show();
        $coulist = $information->order('mid desc')->limit($page->firstRow.','.$page->listRows)->select();
        
        //print_r($coulist);exit;

        $this->assign('page',$page);
        $this->assign('coulist',$coulist);
        $this->display();
    }

    //添加系统信息
    function systemadd(){
        $user= A('Admin/User');
        $user->checklogin();
        $user = D('userinfo');
        $uid = $_SESSION['userid'];
        $admin = $user->where('uid='.$uid)->find();
        $this->assign('otype',$admin['otype']);
        if(IS_POST){
            $information=D('information');
            $date['title']=I('post.title');
            $date['content']=I('post.content');
            $date['settime']=date(time());
            if($information->create()){
                $result=$information->add($date);
                if ($result) {
                    $this->success("添加成功",U("index/systemlist"));
                }else{
                    $this->error("添加失败,请重新添加");
                }
            }else{
                $this->error($information->getError());
            }
        }else{
        $this->display();
    }
}
    //系统信息发送
    function systemsend(){
        $user= A('Admin/User');
        $user->checklogin();
        $information=D('information');
        $user=D('userinfo');
        $uid = $_SESSION['userid'];
        $admin = $user->where('uid='.$uid)->find();
        $this->assign('otype',$admin['otype']);
        $all=$information->select();
        $ulist=$user->select();
        $ucount=$user->count();
        $this->assign('ulist',$ulist);
        $this->assign('all',$all);

        if(IS_POST){
            $send=D('send');
            $mid=I('post.cptype');
            $date['mid']=$mid;
            $date['sendtime']=date(time());
            $uid=I('post.username');
            $date['uid']=$uid;
            
                if($date['uid']=="all"){
                  for($i=0;$i<$ucount;$i++){
                      $date['uid'] = $ulist[$i]['uid'];
                      $result = $send->add($date); 
                                         
                  }
                }else{
                    $result = $send->add($date);
                }

                if($result){
                    $this->success("发送成功",U('Index/systemlist'));
                }else{
                    $this->error('发送失败,请重新添加!');
                }

            }else{
        $this->display();   
    }
    }

    //系统信息修改
    function systemedit(){
        $user= A('Admin/User');
        $user->checklogin();
        $information = M('information');
        $mid = I('get.mid');
        $editex = $information->where('mid='.$mid)->find();
        if(IS_POST){
            $mid=I('post.mid');
            $data['title']=I('post.title');
            $data['content']=I('post.content');
            //$date['settime']=date(time());

            $ref = $information->where('mid='.$mid)->save($data);

            if($ref){
                $this->success('修改成功',U('index/systemlist'));
            }else{
                $this->error('修改失败');
            }              
        }else{ 
        $this->assign('editex',$editex);
        $this->display();
        }
    }
    //系统信息删除
    function systemdel(){
        $information = D('information');
        $mid = I('get.mid');
        $result = $information->where('mid='.$mid)->delete();
        if($result>0){
            $this->success("成功删除！",U("index/systemlist"));
        }else{
            $this->error('删除失败！');
            }
        }  

}