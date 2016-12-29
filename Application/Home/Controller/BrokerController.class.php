<?php
namespace Home\Controller;
use Think\Controller;
class BrokerController extends Controller {
    //申请经纪人
    public function applybroker(){
        if(IS_POST){
            header("Content-type: text/html; charset=utf-8");
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Public/Uploads/'; // 设置附件上传根目录
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                foreach($info as $file){
                    $idcover= $file['savepath'].$file['savename'];
                }}

            $data['uid']=$_SESSION['uid'];
            $obj=M('userinfo')->where($data)->find();
            if ($obj['agenttype']==0) {
                $user=D('userinfo')->where($data)->find();
                $data['did']=$user['oid'];
                $data['mname']=I('post.mname');
                $data['brokerid']=I('post.brokerid');
                $data['photoid']=$idcover;
                $manager=M('managerinfo')->where('uid='.$data['uid'])->select();

                if ($manager>0) {
                    $mm= M('managerinfo')->where('uid='.$data['uid'])->save($data);
                }else{
                    $mm= M('managerinfo')->add($data);
                }
                if($mm){
                    //查询用户信息，改变状态为1,（正在申请中）
                    //$man=M('managerinfo')->where('mid='.$mm)->find();
                    $mydata['agenttype']=1;
                    M('userinfo')->where('uid='.$data['uid'])->save($mydata);

                    $this->success('提交成功,等待审核', U('User/memberinfo'));
                } else {
                    $this->error('提交失败');
                }
            }else{
                $this->error('正在审核中,请勿重复提交',U('User/memberinfo'));
            }

        }else{
            $data['uid']=$_SESSION['uid'];
            $obj=M('userinfo')->where($data)->find();
            if ($obj['agenttype']==1) {
                $this->error('正在审核中,请勿重复提交',U('User/memberinfo'));
            }else{
                $this->display();
            }
        }
    }
    //返佣中心
    public function brokerinfo(){
        $uid=$_SESSION['uid'];
        $userinfo = D('userinfo');
        $uinfo = $userinfo->where('uid='.$uid)->find();

        $this->assign('user',$uinfo);
        $this->display();
     
    }
    //我的佣金总额
    public function mytiny(){
      
        //计算总客户数
        $uid = $_SESSION['uid'];
        $userinfo = D('userinfo');
        $account = D('accountinfo');
        $acinfo = $account->field('balance')->where('uid='.$uid)->find();
        $uinfo = $userinfo->where('uid='.$uid)->find();
        $journal = D('journal');
        $onetotal = D('userinfo')->where('oid='.$uid)->count();
        $oneuser = D('userinfo')->where('oid='.$uid)->select();
        $twototal = 0;
        foreach($oneuser as $row)
        {
            $a = D('userinfo')->where('oid='.$row['uid'])->count();
            $twototal+=$a;
        }
        $totalnum = $onetotal+$twototal;
        //显示二级客户列表
        $userall = "";
        $j = 0;
        foreach($oneuser as $row)
        {
            $a = $userinfo->where('oid='.$row['uid'])->select();
            for($i=0;$i<count($a);$i++)
            {
                $userall[$j] = $a[$i];
                $j++;
            }
        }
        //计算总共返回的佣金
        $onefee = 0;
        foreach($oneuser as $row)
        {
            $a = $journal->where('uid='.$row['uid'])->sum('onelevelfee');
            $onefee+=$a;
        }
        $twofee = 0;
        foreach($oneuser as $row)
        {
            $twouser = D('userinfo')->where('oid='.$row['uid'])->select();
            foreach($twouser as $rowtwo)
            {
                $a = $journal->where('uid='.$rowtwo['uid'])->sum('twolevelfee');
                $twofee+=$a;
            }

        }
        $totalfee = $onefee+$twofee;

        $this->assign('totalnum',$totalnum);
        $this->assign('totalfee',$totalfee);
        $this->assign('user',$uinfo);
        $this->assign('acinfo',$acinfo);
        $this->assign('oneuser',$oneuser);
        $this->assign('twouser',$userall);
        $this->display();


    }
    //一级返佣记录
    public function dhold(){

        /*  $tq=C('DB_PREFIX');
          $userinfo=M('userinfo');
          $order = M('order');
          //获取登录商的id
          $myuid=$_SESSION['uid'];
          $tmp = array();
          //根据登录id查询商户所有的下线id
          $arruid = array();
          $userlist=$userinfo->field('uid,username')->where('oid='.$myuid)->select();
          foreach ($userlist as $k => $v) {
              $arruid[] = $v['uid'];
          }
          $count =M('order')->join($tq.'userinfo on '.$tq.'order.uid='.$tq.'userinfo.uid')->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')->where($tq.'order.uid in('.implode(',', $arruid).') and '.$tq.'order.display=0 and '.$tq.'order.ostaus=0')->count();

          $pagecount = 10;
          $page = new \Think\Page($count , $pagecount);
          $page->parameter = $row; //此处的row是数组，为了传递查询条件
          $page->setConfig('first','首页');
          $page->setConfig('prev','上一页');
          $page->setConfig('next','下一页');
          $page->setConfig('last','尾页');
          $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
          $show = $page->show();
          $list=M('order')->field($tq.'order.ptitle,'.$tq.'order.onumber,'.$tq.'order.oid,'.$tq.'productinfo.uprice,'.$tq.'order.buytime')->join($tq.'userinfo on '.$tq.'order.uid='.$tq.'userinfo.uid')->join($tq.'productinfo on '.$tq.'order.pid='.$tq.'productinfo.pid')->where($tq.'order.uid in('.implode(',', $arruid).') and '.$tq.'order.display=0 and '.$tq.'order.ostaus=0')->limit($page->firstRow.','.$page->listRows)->select();
          $this->assign('page',$show);
          $this->assign('ordlist',$list);
          $this->display();*/

        $uid=$_SESSION['uid'];
        $userinfo = D('userinfo');
        $journal = D('journal');
        $oneuser = D('userinfo')->where('oid='.$uid)->select();
        $array ="";
        $j=0;
        foreach($oneuser as $row)
        {
            $a = $journal->where('uid='.$row['uid'].' and jtype="建仓"')->select();
            for($i=0;$i<count($a);$i++)
            {
                $array[$j]=$a[$i];
                $j++;
            }
        }
        $this->assign('list',$array);
        $this->display();

    }
    //二级返佣记录
    public function twolevel()
    {
        $uid = $_SESSION['uid'];
        $userinfo = D('userinfo');
        $joural = D('journal');
        $oneuser = D('userinfo')->where('oid='.$uid)->select();
        $userall = "";
        $j = 0;
        foreach($oneuser as $row)
        {
            $a = $userinfo->where('oid='.$row['uid'])->select();
            for($i=0;$i<count($a);$i++)
            {
                $userall[$j] = $a[$i];
                $j++;
            }
        }

        $jouralall = "";
        $x = 0;
        foreach($userall as $row)
        {
            $a = $joural->where('uid='.$row['uid'].' and jtype="建仓"')->select();
            for($i=0;$i<count($a);$i++)
            {
                $jouralall[$x]=$a[$i];
                $x++;
            }
        }
       
        $this->assign('list',$jouralall);
        $this->display();

    }
    //平仓单
    public function dclear(){
        $tq=C('DB_PREFIX');
        $userinfo=M('userinfo');
        $order = M('order');
        //获取登录商的id
        $myuid=$_SESSION['uid'];
        $tmp = array();
        //根据登录id查询商户所有的下线id
        $arruid = array();
        $userlist=$userinfo->field('uid,username')->where('oid='.$myuid)->select();
        foreach ($userlist as $k => $v) {
            $arruid[] = $v['uid'];
        }
        $count =M('journal')->join($tq.'userinfo on '.$tq.'journal.uid='.$tq.'userinfo.uid')->where($tq.'journal.uid in('.implode(',', $arruid).') and jtype="平仓"')->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page->show();
        $list=M('journal')->join($tq.'userinfo on '.$tq.'journal.uid='.$tq.'userinfo.uid')->where($tq.'journal.uid in('.implode(',', $arruid).') and jtype="平仓"')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('ordlist',$list);
        $this->display();
    }
    public function orderid(){
        $oid=I('oid');
        $order=M('journal')->where('oid='.$oid)->find();
        $this->assign('order',$order);
        $this->display();
    }
}