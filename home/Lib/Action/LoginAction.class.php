<?php

class LoginAction extends Action {
	
	public function __construct() {
	
		parent::__construct();
		ini_set('date.timezone','PRC');
		Log::$format = '[ Y-m-d H:i:s ]';
		header("Content-Type:text/html; charset=utf-8");
	}
  
	public function checkCode()
	{
		$checkcode = $_POST["checkcode"];
		$code = session("code");
		if($checkcode==$code)
		{
			$this->ajaxReturn("1");
		}else{
			$this->ajaxReturn("0");
		}
	}
	
	public function initUser()
	{
		
		$logintime = date('Y-m-d H:i');
		$utils = new UtilAction();
		$users = M("Users");
		
		$keys = $utils->randstr();
		$data["username"] = "admin";
		$data["password"] = $utils->encrypt("admin123456", $keys);
		$data["email"] = "277156235@qq.com";
		$data["enable"] = "1";
		$data["salts"] = $keys;
		$data["ctime"] = $logintime;
		$users->add($data);
		
		$this->show("success");
		
	}
	
	public function initPro()
	{
		
		$p = M("Products");
		$proList = $p->where("")->select();
		foreach ($proList as $pro)
		{
			$imgs = $pro["imgs"];
			$imgs = str_replace("upload", "Public/upload", $imgs);
			$data["imgs"] = $imgs;
			$p->where("id=%d",$pro["id"])->save($data);
		}
	}

	public function  nopass()
	{
		$this->assign("msg","输入您的登录名，找回密码：");
		$this->display("nopass");
	}
	
	public function nologin()
	{
		session_destroy();
		$msg = $_GET["msg"];
		if(!$msg)
		{
			$msg="您还没登录!";
		}	
		$this->assign("msg",$msg);
		$this->display("nologin");
	}
	
	public function startlogin()
	{
		if(session('?users'))
		{
			dump(session("users"));
			$this->display("Index/index");
		}else{
			
			//import('ORG.Net.IpLocation');// 导入IpLocation类
			$users = M("Users");
			
			$logintime = date('Y-m-d H:i');
			$utils = new UtilAction();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$checkcode = $_POST["checkcode"];
			$code = session("code");
			
			if($code!=$checkcode)
			{
				$this->assign("msg","验证码错误!");
				$this->display("nologin");
			}else{	
				
				$res = $users->where("username = '%s' ",$username)->find();
				if(res)
				{
					$salts = $res["salts"];
					if($utils->encrypt($password, $salts)==$res["password"])
					{
						if($res["enable"]==1)
						{
							$ip = get_client_ip();
							$loca=$utils->getCity($ip);
							$os = $utils->GetOS();
							$bw = $utils->GetBrowser();
							$lan = $utils->GetLang();
							$notes = $loca["country"]."、".$loca["area"]."、".$loca["region"]."、".$loca["city"]."、".$loca["isp"]."、".$os.$lan."系统、".$bw."浏览器、";
							$login = M("Logincount");
							$data["username"] = $res["username"];
							$data["logintime"] = $logintime;
							$data["loginip"] =$ip;
							$data["notes"] = $notes;
							$login->add($data);
								
							$da["lastlogin"] = $logintime;
							$users->where("id=%d",$res["id"])->data($da)->save();
							session('users',$res);
							$this->display("Index/index");
				
						}else{
							$this->assign("msg","该账号被禁用、请联系管理员!");
							$this->display("nologin");
						}
					}else{
						$this->assign("msg","用户密码错误!");
						$this->display("nologin");
					}
				}else{
					$this->assign("msg","该用户不存在!");
					$this->display("nologin");
				}
			}
			
		}
		
	} 
	//登录统计
	public function loginCount()
	{
		$login = M("Logincount");
		$count = $login->where("")->count();// 查询满足要求的总记录数
		$nowPage = isset($_GET['p'])?$_GET['p']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:15;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);
		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}
		
		$list = $login->where("")->order('logintime desc')->page($nowPage.','.$pageSize)->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("loginCount"); // 输出模板
		
	}
	
	//访客信息
	public function visterlist()
	{
		$vis = M("Visters");
		$count = $vis->where("")->count();// 查询满足要求的总记录数
		$nowPage = isset($_GET['p'])?$_GET['p']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:15;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);
		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}
		
		$list = $vis->where("")->order('ctime desc')->page($nowPage.','.$pageSize)->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("visterList"); // 输出模板
	}
	
	public function checkReset()
	{
		
		$usename = $_POST["username"];
		$u = M("Users");
		
		$user = $u->where("username='%s'",$usename)->find();
		if(!$user)
		{
			$this->ajaxReturn("noreg");
		}else{
			
			$getpasstime =time();
			$uid= $user["id"];
			$token = md5($uid.$user['username'].$user['password']);
			$url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]."/mayning/admin.php/Login/resetPass?username=".$usename."&token=".$token;
			$time = date('Y-m-d H:i');
			$email="277156235@qq.com";
			if($user['email'])
			{
				$email=$user['email'];
			}
			$emailsubject = "Mayning - 找回密码";
			$emailbody = "亲爱的".$user['username']."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码（链接24小时内有效、且只可使用一次）。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。";
			$result = think_send_mail($email, "May", $emailsubject, $emailbody, null);
			if($result){//邮件发送成功
				$msg = '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
				//更新数据发送时间
				$data["getpasstime"]=$getpasstime;
				$u->where("id=%d",$user["id"])->save($data);
			}else{
				$msg = $result;
			}
			$this->ajaxReturn($msg);
		}
		
	}
	
	public function resetPass()
	{
		$token = stripslashes(trim($_GET['token']));
		$username = stripslashes(trim($_GET['username']));
		$u = M("Users");
		$user = $u->where("username='%s'",$username)->find();
		$msg="";
		$res = 0;
		if($user)
		{
			$mt = md5($user['id'].$user['username'].$user['password']);
			if($mt==$token){
				if(time()-$user['getpasstime']>24*60*60){
					$msg = '该链接已过期！';
				}else{
					$res = 1;
					$msg = '请重新输入您的密码:';
				}
				
			}else{
				$msg =  '无效的链接!';
			}
		}else{
			$msg =  '错误的链接！';
		}
		
		$this->assign("msg",$msg);
		$this->assign("id",$user['id']);
		$this->assign("res",$res);
		$this->display("resetPass");
	}
	
	public function updateResetPass()
	{
		$u = M("Users");
		$id = $_POST["id"];
		$password = $_POST["password"];
		$utils = new UtilAction();
		$keys = $utils->randstr();
		$data["salts"]=$keys;
		$data["getpasstime"]="";
		$data["password"]=$utils->encrypt($password, $keys);
		$u = M("Users");
		$u->where("id=%d",$id)->save($data);
		$this->assign("msg","修改成功、请重新登录");
		$this->display("nologin");
	}
	
	public function getCode() {
		$w="100";
		$h="30";
		$im = imagecreate($w, $h);
	//imagecolorallocate($im, 14, 114, 180); // background color
	$red = imagecolorallocate($im, 255, 0, 0);
	$white = imagecolorallocate($im, 255, 255, 255);

	$num1 = rand(1, 20);
	$num2 = rand(1, 20);

	session('code',($num1 + $num2)) ;

	$gray = imagecolorallocate($im, 118, 151, 199);
	$black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

	//画背景
	imagefilledrectangle($im, 0, 0, 100, 30, $black);
	//在画布上随机生成大量点，起干扰作用;
	for ($i = 0; $i < 80; $i++) {
		imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
	}

	imagestring($im, 5, 5, 4, $num1, $red);
	imagestring($im, 5, 30, 3, "+", $red);
	imagestring($im, 5, 45, 4, $num2, $red);
	imagestring($im, 5, 70, 3, "=", $red);
	imagestring($im, 5, 80, 2, "?", $white);

	header("Content-type: image/png");
	imagepng($im);
	imagedestroy($im);
	}
	
	public function testLocation()
	{
		$utils = new UtilAction();
		$ip= get_client_ip();
		$loca=$utils->getCity("218.28.20.163");
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $ip." ".$loca["country"]."、".$loca["area"]."、".$loca["region"]."、".$loca["city"]."、".$loca["isp"]."、".$os."、".$bw."、".$lan;
		
	}

	
	
}