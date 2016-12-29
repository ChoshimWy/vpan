<?php
namespace Home\Controller;
class IndexController extends CommonController {
    public function index(){

        if(isset($_SESSION['uid'])) {
            $tq=C('DB_PREFIX');
            $uid=$_SESSION['uid'];
            //账号余额
            $userimg=M('userinfo')->where('uid='.$uid)->find();
            $price=M('accountinfo')->where('uid='.$uid)->find();
            //账号体验卷数
            $endtime=date(time());
            $exper=M('experienceinfo')->join($tq.'experience on '.$tq.'experienceinfo.eid='.$tq.'experience.eid')->where($tq.'experienceinfo.uid='.$uid.' and '.$tq.'experienceinfo.getstyle=0')->count();
            $user['price']=round($price['balance'],2);
            $user['exper']=$exper;
            $user['portrait']=$userimg['portrait'];
            $this->assign('user',$user);
        }
        $catgood=M('catproduct')->select();
        $goods=M('productinfo')->select();
        $uorder=$this->userorder();
        $news=$this->information();
        $focus=$this->focus();
        $notices=$this->notice();
        $isopen=$this->isopen();
        $this->assign('isopen',$isopen);
        $this->assign('nolist',$uorder);
        $this->assign('news',$news);
        $this->assign('focus',$focus);
        $this->assign('notices',$notices);
        $this->assign('catgood',$catgood);
        $this->assign('goods',$goods);
        $this->display();
    }
    //查询网站是否关闭，关闭则不能购买，并且现价变成休市
    public function isopen(){
        $stye=M('webconfig')->select();
        return $stye[0]['isopen'];
    }
    //显示最新资讯
    public function information(){
        $news=M('newsinfo')->where('ncategory=1')->order('nid desc')->limit(3)->select();
        return $news;
    }
    //显示财经要闻Focus
    public function focus(){
    $news=M('newsinfo')->where('ncategory=2')->order('nid desc')->limit(3)->select();
    return $news;
    }
    //显示系统公告Notice
    public function notice(){
    $news=M('newsinfo')->where('ncategory=3')->order('nid desc')->limit(3)->select();
    return $news;
    }
    //获取动态油的价格，显示到页面
   public function price(){
         $diancha=$this->selectcid(1);
         $source=file_get_contents("xh/conc.txt");
         $msg = explode(',',$source);
         //$myprice[0] = round(str_replace('price:', '',str_replace('"','',$msg[1])));//最新
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
         $myprice[8] = str_replace('jk:', '',str_replace('"','',$msg[2]));//今开
         $myprice[7] = str_replace('zk:', '',str_replace('"','',$msg[3]));//昨开
         $myprice[4] = str_replace('zg:', '',str_replace('"','',$msg[4]));//最高
         $myprice[5] = str_replace('zd:', '',str_replace('"','',$msg[5]));//最低
         
         //$myprice[0] =round($myprice[0]*$diancha['myat']*$diancha['myatjia'],2);
         
         $myprice[12] = $myprice[0]-$myprice[8];
         $this->ajaxReturn($myprice);
    }
    //获取动态白银的价格，显示到页面
    public function byprice(){
         $diancha=$this->selectcid(2);
         $source=file_get_contents("xh/baiyin.txt");       
		 $msg = explode(',',$source);
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
         $myprice[8] = str_replace('jk:', '',str_replace('"','',$msg[2]));//今开
         $myprice[7] = str_replace('zk:', '',str_replace('"','',$msg[3]));//昨开
         $myprice[4] = str_replace('zg:', '',str_replace('"','',$msg[4]));//最高
         $myprice[5] = str_replace('zd:', '',str_replace('"','',$msg[5]));//最低
         $myprice[0] =round($myprice[0]*$diancha['myat']*$diancha['myatjia'],2);
         $myprice[12] = $myprice[0]-$myprice[8];
         $this->ajaxReturn($myprice);
    }
    //获取动态铜的价格，显示到页面
    public function toprice(){
         $diancha=$this->selectcid(3);
         $source=file_get_contents("xh/tong.txt");
         $msg = explode(',',$source);
         $myprice[0] = str_replace('price:', '',str_replace('"','',$msg[1]));//最新
         $myprice[8] = str_replace('jk:', '',str_replace('"','',$msg[2]));//今开
         $myprice[7] = str_replace('zk:', '',str_replace('"','',$msg[3]));//昨开
         $myprice[4] = str_replace('zg:', '',str_replace('"','',$msg[4]));//最高
         $myprice[5] = str_replace('zd:', '',str_replace('"','',$msg[5]));//最低
         $myprice[0] =round($myprice[0]*$diancha['myat']*$diancha['myatjia'],2);
         $myprice[12] = $myprice[0]-$myprice[8];
         $this->ajaxReturn($myprice);
    }
    //根据传回来的id获取商品的信息
    public function selectid(){
        $tq=C('DB_PREFIX');
        $pid=I('post.pid');
        $uid=$_SESSION['uid'];
        //获取当前id对应的商品
        $good=M('productinfo')->where('pid='.$pid)->find();
        //查询用户时候有对应的体验卷
       // $sum=M('experienceinfo')->join($tq.'experience on '.$tq.'experienceinfo.exid='.$tq.'experience.eid')->where($tq.'experienceinfo.uid='.$uid.' and '.date(time()).' < '.$tq.'experience.endtime and '.$tq.'experienceinfo.getstyle=0 and '.$tq.'experience.eprice='.$good['uprice'])->count();
      $sum=M('experienceinfo')->join($tq.'experience on '.$tq.'experienceinfo.eid='.$tq.'experience.eid')->where($tq.'experienceinfo.uid='.$uid.' and '.date(time()).' < '.$tq.'experienceinfo.endtime and '.$tq.'experienceinfo.getstyle=0 and '.$tq.'experience.eprice>='.$good['uprice'])->count();

      
        $good['sum']=$sum;
        $this->ajaxReturn($good);   
    }

    //查询当前用户正在交易的订单
    public function userorder(){
        $tq=C('DB_PREFIX');
        $uid = $_SESSION['uid'];
        $userorders=M('order')->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')
        ->join($tq.'catproduct on '.$tq.'productinfo.cid='.$tq.'catproduct.cid')->where($tq.'order.uid='.$uid.' and ostaus=0')->select();
        return $userorders;
    }
        //查询当前用户正在交易的订单ajax处理
    public function orderlist(){
        $uid = $_SESSION['uid'];
        $orders=M('order')->where('uid='.$uid.' and ostaus=0')->getField('oid',true);
        $this->ajaxReturn($orders);
    }
    //查询订单信息(接收修改后的订单，或者直接平仓，或者购买完后平仓，3中情况)
    public function orderid(){
        $tq=C('DB_PREFIX');
        $orderid=I('post.orderid');
        $order=M('order')->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')
        ->join($tq.'catproduct on '.$tq.'productinfo.cid='.$tq.'catproduct.cid')->where('oid='.$orderid)->find();       
        // $order['expend'] = $order['onumber']*$order['uprice'];  //支出
        // $order['paytime'] = date('Y-m-d',$order['buytime']);
        $this->ajaxReturn($order);
    }
    //修改订单的止盈和止亏
    public function edityk(){
        $order=M('order');
        $order->oid=I('post.oid');
        $order->endprofit=I('post.zy');
        $order->endloss=I('post.zk');
        $order->save();
        $this->redirect('Index/index');
    }
    //查询分类的点差
    function selectcid($cid){
        $str=M('catproduct')->where('cid='.$cid)->find();
        return  $str;
    }
}