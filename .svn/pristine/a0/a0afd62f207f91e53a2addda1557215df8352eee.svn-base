<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function login()
    {
        header("Content-type: text/html; charset=utf-8");

        // 判断提交方式
        if (I('post.username')!=''&&I('post.password')!='') {
            // 实例化Login对象
            $user = D('userinfo');
            $where = array();
            $where['username'] = I('post.username');
            $result = $user->where($where)->field('uid,username,upwd,utime,ustatus')->find();
            if ($result['ustatus']==1) {
                $this->error('已经加入黑名单中');
            }
            // 验证用户名 对比 密码
            if ($result['upwd'] === md5(I('post.password').$result['utime'])) {
                // 存储session
                session('uid', $result['uid']);          // 当前用户id
                session('username', $result['username']);   // 当前用户昵称
                //session('MyOpenid', $result['openid']);// 当前用户openID

                session('MyOpenid', I('post.my_openid'));// 当前用户openID
                // 更新用户登录信息
                $dd['lastlog']=time();
                $user->where('uid='.$result['uid'])->save($dd);
                $where['uid'] = session('uid');

                $this->redirect('Index/index');
                //$this->ajaxReturn(1);

            } else {
                $this->error('登录失败,用户名或密码不正确!');
                //$this->ajaxReturn(2);
            }
        }

        $userinfo = M('userinfo');
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            //非微信浏览器禁止浏览
            echo "非微信浏览器禁止浏览";

        } else {
            //做跳转，拿到openid,第一步跳转链接，
            if ($_GET['openid']=='') {

                //获取网址参数
                $sale = explode('&',$_SERVER["QUERY_STRING"])[1];
                $REDIRECT_URI = "http://m.xinyicaijing.com/Extend/weixin.php?".$sale;

                $oid = $_GET['uid'];
                cookie('getoid',$oid);
                $this->assign('is_weixin',1);
                $wechat=M('wechat')->find();


                $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wechat['appid']."&redirect_uri=$REDIRECT_URI&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";

                echo "<script language='javascript'>window.location='".$url."'</script>";

            }else{
                $this->assign('is_weixin',2);


                //这里做一个判断，客户没有注册，则直接去注册页面，否则去登录页面。
                $openid['openid']=$_GET['openid'];
                $openid['nickname']=$_GET['nickname'];
                $openid['address']=$_GET['address'];
                $openid['portrait']=$_GET['portrait'];
                $openid['utime']=$_GET['subscribe_time'];//时间
                $openid['username']= substr($openid['openid'], -5).time();//登录名
                $openid['usertype']='1';
                $openid['wxtype']='1';
                $userinfoid=$userinfo->where("openid='".$openid['openid']."'")->find();


                session('openid', $openid['openid']);// 当前用户openID

                //有数据在判断看是否有密码，有账号，没有的话跳转到初始页面，让输入密码，这里是修改方法。

                if ($userinfoid) {

                    if ($userinfoid['upwd']) {
                        //传用户名过去，做隐藏，然后直接登录
                        $this->assign('username',$userinfoid['username']);
                    }else{
                        //注册初始密码页面
                        $this->redirect('User/reg', array('openid' => $openid['openid']), 1, '请设置初始密码...');
                    }
                }
                else{
                    //没查询到，就跳转到注册页面，让输入初始密码。生成一个账号。这里是添加账号方法后，赋值跳转到登录页面。
                    if($userinfo->add($openid)){
                        //初始密码页面
                        $this->redirect('User/reg', array('openid' => $openid['openid']), 1, '请设置初始密码...');

                    }
                }
            }
            $this->display();
        }
    }

    public function readme(){

        $this->display();
    }
    //注册页面
    public function reg()
    {

        $openid=I('get.openid');
        $oid = I('get.oid');
        $puid = I('get.uid');

        $data['oid'] = $_COOKIE['getoid'];

        $this->assign('openid',$openid);
        $this->assign('oid',$oid);
        $this->assign('puid',$puid);
        $this->display();

    }
    /////////////////////////////////
    //本函数不是注册函数
    ////////////////////////////////
    //注册
    public function register()
    {

        if(IS_POST)
        {
            // 判断提交方式 做不同处理
            // 实例化User对象
            $user = D('userinfo');
            //检查用户名
            header("Content-type: text/html; charset=utf-8");
            //检查手机验证码
            // $code = $this->mescontent();
            $verify = I('post.code');
            if ($code != $verify) {
                /*
                *推广链接时需要在注册时添加一个获取oid的方法，添加进去，作为上线的记录。
                */
                $data['username'] = I('post.username');
                $data['utel'] = I('post.utel');
                $data['utime'] = date(time());
                $data['upwd'] = md5(I('post.upwd') . date(time()));
                $data['oid']=I('post.oid');
                $uname = $user->where('username='.$data['username'])->find();

                if($uname){
                    $this->ajaxReturn(3);
                }else{
                    //插入数据库
                    if ($uid = $user->add($data)) {
                        //添加对应的金额表
                        $acc['uid']=$uid;
                        $acc['pwd']=I('post.upwd');
                        $aid = M('accountinfo')->add($acc);
                        //发放优惠券

                        //////////////////////////////
                        //发放优惠券功能暂时关闭
                        //2016/12/28
                        //
                        ////////////////////////////
                        //发放3张优惠券
//                        $cp['uid'] = $uid;
//                        $cp['eid'] = 1;
//                        $cp['exgtime'] = time();
//                        $limittime = D('experience')->where("eid=6")->getField('limittime');
//                        $cp['endtime'] = time()+24*3600*(intval($limittime));
//                        $cp['getstyle'] = 0;
//                        $cp['getway'] = "注册赠送";
//                        for($i=0;$i<=2;$i++)
//                        {
//                            D('experienceinfo')->add($cp);
//                        }



                        //分享赠券
                        // $puid = I('post.puid');
                        // if($puid!="")
                        // {
                        //     $cp1['uid'] = $puid;
                        //     $cp1['eid'] = 1;
                        //     $cp1['exgtime'] = time();
                        //     $limittime = D('experience')->where("eid=6")->getField('limittime');
                        //     $cp1['endtime'] = time()+24*3600*(intval($limittime));
                        //     $cp1['getstyle'] = 0;
                        //     $cp1['getway'] = "分享赠送";
                        //     D('experienceinfo')->add($cp1);
                        // }

                        $this->ajaxReturn(1);
                    } else {
                        $this->ajaxReturn(2);
                    }
                }
            }else{
                $this->ajaxReturn(0);
            }
        }
        else{
            $oid = I('get.oid');
            $com = M('userinfo')->field('comname,uid')->where('uid='.$oid)->find();
            $this->assign('com',$com);
            $this->display();
        }


    }

    //注册处理
    //设置初始密码，密码后台可以修改。这里需要创建资金表，创建详细信息表。
    public function myreg(){

        //判断是否存在上线分享的用户ID
        if($_SESSION['sale'] !=''){
            $data['managername'] = $_SESSION['sale'];
        }

        $userinfo=M('userinfo');
        $openid=I('post.openid');
        $user=$userinfo->where("openid='".$openid."'")->find();
        $data['uid']=$user['uid'];
        $data['utime'] = date(time());
        $data['oid'] = $_COOKIE['getoid'];
        $data['upwd'] = md5(I('post.upwd') . date(time()));
        $data['wxtype']='0';
        $data['questionID'] = I('post.question');
        $data['answer'] = I('post.answer');
        if($userinfo->save($data)){
            $brok['uid']=$user['uid'];
            $brok['brokerid']=I('post.brokerid');
            M('managerinfo')->add($brok);
            $acc['uid']=$user['uid'];
            $acc['pwd']=I('post.upwd');
            M('accountinfo')->add($acc);

            //////////////////////
            //暂时屏蔽优惠券功能
            //2016/12/28
            ///////////////////////
//            //发放3张8元优惠券
//            $cp['uid'] = $user['uid'];
//            $cp['eid'] = 1;
//            $cp['exgtime'] = time();
//            $limittime = D('experience')->where("eid=1")->getField('limittime');
//            $cp['endtime'] = time()+24*3600*(intval($limittime));
//            $cp['getstyle'] = 0;
//            $cp['getway'] = "注册赠送";
//            for($i=0;$i<=2;$i++)
//            {
//                D('experienceinfo')->add($cp);
//            }

            // //分享赠券
            // $puid =   $data['oid'];
            // if($puid!="")
            // {
            //     $cp1['uid'] = $puid;
            //     $cp1['eid'] = 1;
            //     $cp1['exgtime'] = time();
            //     $limittime = D('experience')->where("eid=1")->getField('limittime');
            //     $cp1['endtime'] = time()+24*3600*(intval($limittime));
            //     $cp1['getstyle'] = 0;
            //     $cp1['getway'] = "分享赠送";
            //     D('experienceinfo')->add($cp1);
            // }

            $this->redirect('User/login');
        }else{
            $this->error('设置失败，请联系管理员');
        }


    }
    //生成随机六位验证码

    public function mescontent()
    {

        $CheckCode = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return $CheckCode;

    }

    //短信验证
    public function smsverify()
    {
        $code = $this->mescontent();
        $post_data = array();
        $post_data['userid'] = '2571';
        $post_data['password'] = 'zjy100200';
        $post_data['account'] = 'zj46602437';
        $post_data['content'] = '【微盘开发】您的验证码是:' . $code;
        $post_data['mobile'] = $_REQUEST['tel'];
        $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
        $url = 'http://118.145.18.236:9999/sms.aspx?action=send';
        $o = '';
        foreach ($post_data as $k => $v) {
            $o .= "$k=" . urlencode($v) . '&';
        }
        $post_data = substr($o, 0, -1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
        $result = curl_exec($ch);

    }

    //会员中心
    public function memberinfo()
    {
        $this->userlogin();
        $uid = $_SESSION['uid'];
        $result = M('accountinfo')->where('uid=' . $uid)->find();
        $suer = M('userinfo')->where('uid='. $uid)->find();
        $this->assign('result', $result);
        $this->assign('suer', $suer);
        $this->display();
    }
    //修改手机号码
    public function editle()
    {
        $this->userlogin();
        $edit = M('userinfo');
        $uid = $_SESSION['uid'];
        if (IS_POST) {
            $data['utel'] =I('post.utle');
            $edituser = $edit->where('uid='.$uid)->save($data);
            if ($edituser) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(2);
            }
        }
        $utel=$edit->where('uid='.$uid)->find();
        $this->assign('utel', $utel['utel']);
        $this->display();
    }
    //修改登录密码
    public function edituser()
    {
        $this->userlogin();
        if (IS_POST) {
            $data['uid'] = $_SESSION['uid'];
            $myuser = M('userinfo')->where('uid=' . $data['uid'])->find();
            $user = M('userinfo')->where($data)->find();
            if ($user['upwd'] === md5(I('post.upwd') . $myuser['utime'])) {
                $edit = M('userinfo');
                if ($edit->create()) {
                    $edit->uid = $_SESSION['uid'];
                    $edit->utime = date(time());
                    $edit->upwd = md5(I('post.newpwd') . date(time()));
                    $edituser = $edit->save();
                    if ($edituser) {
                        // redirect(U('User/memberinfo'), 1, '密码修改成功...');
                        $this->ajaxReturn(1);
                    } else {
                        // $this->error('密码修改失败，请重新修改');
                        $this->ajaxReturn(2);
                    }
                }
            } else {
                // $this->error('原密码不正确，请重新输入');
                $this->ajaxReturn(0);
            }
        }
        $this->display();
    }
    //修改提现密码
    public function editpwd()
    {
        $this->userlogin();
        if (IS_POST) {
            $data['uid'] = $_SESSION['uid'];
            $user = M('userinfo')->where($data)->find();
            if ($user['pwd'] === md5(I('post.upwd'))) {
                $uid = $_SESSION['uid'];
                $str['pwd']=md5(I('post.newpwd'));
                $edituser = M('userinfo')->where('uid='.$uid)->save($str);
                //$arr=M('userinfoid')->where('uid='.$uid)->save($str);
                if ($edituser) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(2);
                }

            } else {
                $this->ajaxReturn(0);
            }
        }
        $this->display();
    }


    //退出登录
    public function logout()
    {
        // 清楚所有session
        session(null);
        $this->redirect('Index/login');

    }

    //账户提现
    public function cash()
    {
        $this->userlogin();
        $account = D('accountinfo');
        $balance = D('balance');
        $bankinfo = D('bankinfo');
        $bournal = D('bournal');
        $withdrawal=D('withdrawal');
        $user=D('userinfo');
        $uid = $_SESSION['uid'];
        $username = $_SESSION['husername'];
        if(IS_POST){
            //提现密码
            $bpwd = $user->field('pwd')->where('uid='.$uid)->find();
            $pwd = I('post.pwd');
            $banknumber = I('post.banknumber');
            $bankname = I('post.bankname');
            $province = I('post.province');
            $city = I('post.city');
            $branch = I('post.branch');
            $busername = I('post.busername');
            $bpprice = I('post.bpprice');
            if($bpwd['pwd']==md5($pwd)){
                $where['uid'] = array('eq',$uid);
                $user_balance = $account->where($where)->find();

                if($user_balance['balance'] < $bpprice){
                    $this->ajaxReturn("-88");

                }
                // if (date('Y-m-d')<=date('Y-m-d',strtotime('+9 hours')) || date('Y-m-d')>=date('Y-m-d',strtotime('+15 hours')) {
                //     $this->ajaxReturn(2);
                // }
                if(strlen($banknumber)==16||strlen($banknumber)==19){
                    $detailed = A('Home/Detailed');
                    //提现表
                    $balances['bptype'] = '提现';
                    $balances['remarks'] = '开始提现';
                    $balances['bptime'] = date(time());
                    $balances['bpprice'] = $bpprice;
                    $balances['uid'] = $uid;
                    $balances['isverified'] = 0;
                    $balances['balance'] = $user_balance['balance'];
                    $balances['withdrawal']=1;
                    $balances['bpno']=$detailed->build_order_no();
                    //提现记录
                    $bournals['btype'] = '提现';
                    $bournals['btime'] = date(time());
                    $bournals['bprice'] = $bpprice;
                    $bournals['uid'] = $uid;
                    $bournals['username'] = $username;
                    $bournals['isverified'] = 0;
                    $bournals['bno'] = $detailed->build_order_no();
                    $bournals['balance'] = $user_balance['balance'];
                    //银行卡信息，添加或修改
                    $banks['bankname'] = $bankname;
                    $banks['province'] = $province;
                    $banks['city'] = $city;
                    $banks['branch'] = $branch;
                    $banks['banknumber'] = $banknumber;
                    $banks['busername'] = $busername;
                    //插入提现记录
                    $balance_result = $balance->add($balances);
                    $bournal_result = $bournal->add($bournals);
                    //$withdrawal_result = $withdrawal->add($balances);
                    //查询银行卡表所有用户id数组
                    $uidcount = $bankinfo->where('uid='.$uid)->count();
                    //判断uid是否已经存在银行卡表内，存在插入数据，不存在修改数据
                    if($uidcount==1){
                        //查询用户银行卡表的bid
                        $bid = $bankinfo->field('bid')->where('uid='.$uid)->find();
                        $bankinfo->where('bid='.$bid['bid'])->save($banks);
                    }else{
                        $banks['uid'] = $uid;
                        $bankinfo->add($banks);
                    }
                    
                    if($balance_result){
                        $accounts['balance'] = $user_balance['balance'];
                        $account->where('uid='.$uid)->save($accounts);
                        $this->ajaxReturn();
                    }else{
                        $this->ajaxReturn("0");
                    }
                }else{
                    $this->ajaxReturn("10");
                }
            }else{
                $this->ajaxReturn("-99");
            }
        }else{
            //账户余额
            $totle = $account->field('balance')->where('uid='.$uid)->find();
            //银行信息
            $binfo = $bankinfo->where('uid='.$uid)->find();
            $suer = M('userinfo')->where('uid='.$uid)->find();
            $this->assign('suer', $suer);
            $this->assign('binfo',$binfo);
            $this->assign('totle',$totle);
            $this->display();
        }
    }
    //账户充值
    public function recharge()
    {
        $this->userlogin();
        $uid = $_SESSION['uid'];
        $result = M('accountinfo')->where('uid='. $uid)->find();
        $suer = M('userinfo')->where('uid='.$uid)->find();
        $this->assign('result', $result);
        $this->assign('suer', $suer);
        $this->assign('style','1');
        if (IS_POST) {
            $date['bpprice']=I('post.tfee1');
            $date['bpno']=$this->build_order_no();
            $date['balance'] = $result['balance'];
            $date['uid']=$uid;
            $date['bptype']='充值';
            $date['bptime']=date(time());
            $date['remarks']='开始充值';
            $balanceid=M('balance')->add($date);
            if ($balanceid) {
                $balc=M('balance')->where('bpid='.$balanceid)->find();
                $this->assign('balc',$balc);
            }
            $this->assign('style','2');
        }
        $this->assign('MyOpenid',$suer['openid']);
//        $this->assign('MyOpenid','1111111');
        $this->display();
    }
    //处理支付后的结果，加钱
    public function notify(){
        $orderno=I('get.order_id');
        $balance=M('balance')->where('bpno='.$orderno)->find();

        //判断订单是否存在，并且判断是否是同一个人操作


        if ($balance&&$balance['uid']==$_SESSION['uid']) {


            $date['bpno']=$balance['bpno'];
            $date['remarks']='充值成功';
            $style=M('balance')->where('uid='.$balance['uid']. ' AND bpno='.$orderno)->save($date);

            //修改客户的帐号余额
            if ($style !== false) {

                //查询订单金额
                $prict=M('balance')->where('uid='.$balance['uid']. ' AND bpno='.$orderno)->find();



                //先取出用户帐号的余额。
                $userprice=M('accountinfo')->where('uid='.$balance['uid'])->find();
                $mydate['balance']=$prict['bpprice']+$userprice['balance'];


                M('accountinfo')->where('uid='.$balance['uid'])->save($mydate);


            }
        }
        $this->redirect('User/memberinfo');
    }

    //获取用户收入排行
    public function ranking(){
        $this->userlogin();
        $order=M('order');
        //$userinfo=M('userinfo')->select();
        $tq=C('DB_PREFIX');
        // foreach ($userinfo as $k => $v) {
        $list=$order->field('sum('.$tq.'order.ploss) as pric,'.$tq.'order.uid')->group($tq.'order.uid')->order('sum('.$tq.'order.ploss) desc')->limit(10)->select();
        $lists=array();
        foreach ($list as $k => $v) {
            $lists[$k]=$v;
            $username=M('userinfo')->field('username','portrait','nickname')->where('uid='.$v['uid'])->find();
            $lists[$k]['name']=$username['username'];
            $lists[$k]['nickname']=(mb_strlen($username['nickname'])>5?mb_substr($username['nickname'],0,4,'utf-8')."...":$username['nickname']);
            //$lists[$k]['nickname']=$username['nickname'];
            $lists[$k]['portrait']=$username['portrait'];
        }
        $this->assign('lists',$lists);
        $this->display();
    }
    //体验卷列表
    public function experiencelist()
    {
        $this->userlogin();
        $uid = $_SESSION['uid'];
        $tq = C('DB_PREFIX');
        $endtime = date(time());

        // $list=M('experience')->join($tq.'experienceinfo on'.$tq.'experienceinfo.exid=' . $tq . 'experience.eid')->select();

        $list=M('experienceinfo')->join($tq.'experience on '.$tq.'experienceinfo.eid='.$tq.'experience.eid')->where($tq.'experienceinfo.uid='.$uid.' and '.$endtime.' < '.$tq.'experienceinfo.endtime and '.$tq.'experienceinfo.getstyle=0')->select();


        $this->assign('list', $list);
        $this->display();
    }


    //体验卷列表
    public function alist()
    {
        $this->userlogin();
        $uid = $_SESSION['uid'];
        $tq = C('DB_PREFIX');
        $endtime = date(time());
        $alist = M('experience')->where(  $endtime . ' < ' . $tq . 'experience.endtime')->select();


        $this->assign('alist', $alist);
        $this->display();
    }
    //用户提现密码添加
    public function pwdadd(){
    
        $this->userlogin();
        //实例化userinfo表
        $users = D('userinfo');
        $acc=D('accountinfo');
        $uid=$_SESSION['uid'];
        //print_r($uid);exit;
        if(IS_POST){
            $date['pwd']=md5(I('post.newpwd'));
            
            $result = $users->where('uid='.$uid)->save($date);
            print_r($result);exit;
            //$result =$acc->where('uid='.$uid)->save($date);
            if($result){
                //$this->success('添加成功',U('User/memberinfo'));
                $this->ajaxReturn(1);
            }else{
                //$this->error('添加失败');
                $this->ajaxReturn(2);
            }

        }else{
            $this->display();
        }
    }




    //体验卷详情页
    public function experienceid()
    {
        $this->userlogin();
        $eid = I('eid');
        $tq = C('DB_PREFIX');
        //$expid = M('experience')->where('eid=' . $eid)->find();
        $list=M('experienceinfo')->join($tq.'experience  on '.$tq.'experienceinfo.eid='.$tq.'experience.eid')->where($tq.'experience.eid=' . $eid)->select();

        $expid = $list[0];

        $this->assign('expid', $expid);
        $this->display();
    }

    public function userlogin()
    {
        //判断用户是否已经登录
        if (!isset($_SESSION['uid'])) {
            $this->redirect('User/login');
        }
    }

    public function img(){
        $this->userlogin();
        $hostlink= $_SERVER['HTTP_HOST'];
        $url=  $hostlink.U('User/login',array('uid'=>session('uid')));
        $src = "http://www.xcsoft.cn/public/qrcode&text={$url}&size=4&level=L&padding=2&logo=";
        $reaurl = "http://m.xinyicaijing.com/Extend/sample.php?url=$url&src=$src";
        //  echo "<script language='javascript'>window.location='".$reaurl."'</script>";

    }

    //随机生成订单编号
    function build_order_no(){
        return date(time()).substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 3);
    }
    //信息中心
    function message(){
        $uid=$_SESSION['uid'];
        $userinfo = D('userinfo');
        $uinfo = $userinfo->where('uid='.$uid)->find();

        $this->assign('user',$uinfo);

        $this->display();
    }
    //提现进度查看
    function payment(){
        $uid=$_SESSION['uid'];
        $userinfo = D('userinfo');
        $balances=D('balance');
        $uinfo = $userinfo->where('uid='.$uid)->find();
        $res=$balances->where('uid='.$uid)->order('bpid desc')->limit(1)->find();
        //$res=$balances->where('uid='.$uid)->order('bpid desc')->limit(1)->select();
        //print_r($res);exit;
   
        $this->assign('user',$uinfo);
        $this->assign('res',$res);
        $this->display();
    }
    //系统信息
    function system(){
        $uid=$_SESSION['uid'];
        $tq=C('DB_PREFIX');
        $count = M('send')->where($tq.'send.uid='.$uid)->count();
        $pagecount = 10;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        //$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%  第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show(); 
        $list=M('send')->join($tq.'information on '.$tq.'send.mid='.$tq.'information.mid')->where($tq.'send.uid='.$uid)->order($tq.'send.id desc')->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    //系统信息详情
    function systemid(){
        $this->userlogin();
        $mid = I('mid');
        $tq = C('DB_PREFIX');
        //$expid = M('experience')->where('eid=' . $eid)->find();
        $list=M('send')->join($tq.'information  on '.$tq.'send.mid='.$tq.'information.mid')->where($tq.'information.mid=' . $mid)->select(); 
        $expid = $list[0];
        
        $this->assign('expid', $expid);
        $this->display();
    }
    function help(){

        $this->display();
    }

    //获取sesion
    function getSession(){

        $this->ajaxReturn($_SESSION['uid']);
    }

    //找回密码页面
    function retrievepwd(){
        $userinfo=M('userinfo');
        $openid=$_SESSION['openid'];
        $user=$userinfo->where("openid='".$openid."'")->find();

        $this->assign('questionID',$user['questionID']);
        $this->display();
    }

    //找回密码
    function retrieve(){
        $userinfo=M('userinfo');
        $openid=$_SESSION['openid'];

        $user=$userinfo->where("openid='".$openid."'")->find();
        if (IS_POST){

            if ($user['answer'] == I('post.answer')){
                redirect(U('User/resetpwd'));
            }else {
                $this->error('回答问题不正确，请重新输入');
            }
        }

    }

    //重置密码
    function resetPasswod(){

        $user=M('userinfo');
        $openid=$_SESSION['openid'];

        $resetuser=$user->where("openid='".$openid."'")->find();


        //重置密码
        $data['uid'] = $resetuser['uid'];
        $data['utime'] = date(time());
        $data['upwd'] = md5(I('post.confirmPwd') . date(time()));

        $resetPwd=$user->save($data);
        if($resetPwd){
            redirect(U('User/login'));
        }else{
            $this->error('密码重置失败，请重新修改');
        }

    }
}
