<?php
namespace Home\Controller;
use Think\Controller;

class AiyiController extends Controller {
    public function  index(){
        $gzhpay = C('GZHPAY');
		$order_no = $gzhpay['traceno'].date('ymdhis',time()).rand(1,100);
		$amount = I("post.num");
		
		$uid = $_SESSION['uid'];
        $data['bptime'] = date(time());
        $data['bptype'] ='充值';
        $data['uid'] =$uid;
        $data['balanceno'] =$order_no;
        $data['remarks'] ="开始充值";
        $data['bpprice']=$amount;
        $data['isverified']=0;
        //M('balance')->add($data);//增加表信息
		
		$url = "https://www.iyibank.com/pay/gateway";	//接口请求地址	
		$nonce_str = mt_rand(time(),time()+rand());
		$signature = "9da38b03f4b74d13bf187a84015837f5";//密钥
		$arr['service'] 	=	"cibweixin";	//接口类型
		$arr['version'] 	=	"1.0";			//版本号
		$arr['charset'] 	=	"utf-8";		//字符集
		$arr['sign_type'] 	=	"MD5";			//签名方式
		$arr['mch_id'] 		=	"1837";				//商户号
		$arr['out_trade_no']= 	"CDEs000001";		//商户订单号
		$arr['body']		= 	"米盘微信充值";	//商品描述
		$arr['total_fee']	= 	"1.00";		//金额
		$arr['mch_create_ip']	= 	"127.0.0.1";	//终端IP
		$arr['notify_url']	= 	"http://mipan.fxicc.com/home/aiyi/notify";	//通知地址
		$arr['callback_url']= 	"http://mipan.fxicc.com/home/user/memberinfo";	//支付完成跳转地址
		$arr['nonce_str']	= 	$nonce_str;	//随机数
		
		$temp='';
		ksort($arr);//对数组进行排序
		//遍历数组进行字符串的拼接
		foreach ($arr as $x=>$x_value){
			if ($x_value != null){
				$temp = $temp.$x."=".iconv('UTF-8','GBK//IGNORE',$x_value)."&";
			}
		}
		//MD5转码
		$arr['sign']=strtoupper(md5($temp.$signature));
		// $arr['sign'] = $temp.'sign'.'='.$md5;
		// echo "<pre>";
		// var_dump($arr);die;
		$xmls = "<?xml version='1.0' encoding='UTF-8'?>";
		//遍历数组进行xml的拼接
		foreach ($arr as $k=>$v){
			if ($v != null){
				if($k == 'body'){
					$xmls .= '<body>'.$v.'</body>';
				}else{
					$xmls .= '<'.$k.'>'.$v.'</'.$k.'>';
				}
			}
		}
		
		// var_dump($xmls);die;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);//设置抓取的url
		curl_setopt($curl, CURLOPT_HEADER, false);//设置头文件的信息作为数据流输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($curl, CURLOPT_POST, 1);//设置post方式提交
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xmls);
		$data = curl_exec($curl);//执行命令
		curl_close($curl);//关闭URL请求
		echo iconv('GBK//IGNORE', 'UTF-8', $data);//显示获得的数据
    }
	private function create($data, $submitUrl)
    {
        $inputstr = "";
        foreach ($data as $key => $v) {
            $inputstr .= '<input type="hidden"  id="' . $key . '" name="' . $key . '" value="' . $v . '"/>';
        }
        $form = '<form action="' . $submitUrl . '" name="pay" id="pay" method="POST">';
        $form .= $inputstr;
        $form .= '</form>';
        $html = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>请不要关闭页面,支付跳转中.....</title>
        </head><body>
        ';
        $html .= $form;
        $html .= '
        <script type="text/javascript">
            document.getElementById("pay").submit();
        </script>';
        $html .= '</body></html>';
		$this->Mheader('utf-8');
        echo $html;
        exit;

    }
	private function Mheader($type){
		header("Content-Type:text/html;charset={$type}"); 
	}
	public function notify(){
		
	}
}