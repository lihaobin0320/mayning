<?php

class IndexAction extends Action {
	
	public function __construct() {

		parent::__construct();
		Log::$format = '[ Y-m-d H:i:s ]';
		header("Content-Type:text/html; charset=utf-8");
		$content = M("Contents");
		//获取网页底部信息
		$buttom = $content->where(" enable=1 and cateid=4 ")->find();
		//获取首页欢迎语
		$welcome = $content->where(" enable=1 and cateid=1 ")->find();
		$this->assign('welcome',$welcome);// 赋值数据集
		$this->assign('buttom',$buttom);// 赋值数据集
		$ip = get_client_ip();
		if(!session('?vister'))
		{
			session("vister",$ip);
		}
	}

	//默认首页
    public function index(){
    	$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
    	$da["page"]="系统首页";
    	$vis->add($da);
    	// 使用 D 函数实例化用户模型类
    	$product = M("Products");
    	//获取首页轮播图片
    	$rollList = $product->where(" enable=1 and state=1 ")->order(' sorts desc')->select();
    	//获取首页展示图片
    	$showList = $product->where(" enable=1 and state=2 ")->order(' sorts desc')->select();
    	
    	$this->assign('rollList',$rollList);// 赋值数据集
    	$this->assign('showList',$showList);// 赋值数据集
    
    	//dump($welcome);
    	$this->display("index");
    }
    //关于我们
    public function aboutUs()
    {
    	$ip = get_client_ip();
    	$utils = new UtilAction();
    	$loca=$utils->GetIpLookup($ip);
    	$os = $utils->GetOS();
    	$bw = $utils->GetBrowser();
    	$lan = $utils->GetLang();
    	$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
    	$da["page"]="关于我们页面";
    	$vis->add($da);
    	$content = M("Contents");
    	$aboutUs = $content->where(" enable=1 and cateid=2 ")->find();
    	$this->assign('aboutUs',$aboutUs);
    	$this->display("aboutUs");
	}
	//Faq列表
	public function news()
	{
		$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
		$da["page"]="FAQ页面";
		$vis->add($da);
		$faqcate = M("Faqcate");
		$faq = M("Faqs");
		
		$param = $_GET['faqcate'];
		
		$temp="";
		if($param)
		{
			$temp=" 1=1 and enable=1 and  faqcate= ".$param;
		}else{
			$temp=" 1=1 and enable=1 ";
		}
		$faqcateList = $faqcate->where("enable=1 ")->order(' sorts desc')->select();
		$count = $faq->where($temp)->count();// 查询满足要求的总记录数
		$nowPage = isset($_GET['p'])?$_GET['p']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:10;//每页显示条数、默认为10
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
		
		$list = $faq->where($temp)->order('sorts desc')->page($nowPage.','.$pageSize)->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('faqcateList',$faqcateList);// 赋值数据集
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("news"); // 输出模板
	}
	//Faq详情
	public function newsInfo()
	{
		$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
		$da["page"]="FAQ详情";
		$vis->add($da);
		$faqcate = M("Faqcate");
		$faq = M("Faqs");
		$id = $_GET["id"];
		
		$faqcateList = $faqcate->where(" 1=1 ")->select();
		$faqInfo = $faq->where(" id =".$id)->find();
		$this->assign("faqcateList",$faqcateList);
		$this->assign("faqInfo",$faqInfo);
		$this->assign("faqcate",$faqcate);
		$this->display("newsInfo"); // 输出模板
	}
	//产品列表
	public function product()
	{
		$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
		$da["page"]="产品页面";
		$vis->add($da);
		$procate = M("Procate");
		$pro = M("Products");
		$param = $_GET['procate'];//一级菜单
		$param2 = $_GET['procate2'];//二级菜单
		
		$cate = $procate->where("id=%d",$param)->find();
		$cate2 = $procate->where("id=%d",$param2)->find();
		if($param)
		{
			$cate2List = $procate->where("pid=%d",$param)->select();
		}
		
		
		$sql="select a.id,a.title,a.info,a.imgs,a.ctime from products a left join procate b on a.proid = b.id where 1=1 and a.enable=1 and b.enable=1 ";
		$sql2 ="select count(*) as count from products a left join procate b on a.proid = b.id where 1=1 and a.enable=1 and b.enable=1 ";
		if($param)
		{
			if($param2)
			{
				$sql.=" and ( b.pid=".$param2." or b.id=".$param2.")";
				$sql2.=" and ( b.pid=".$param2." or b.id=".$param2.")";
			}else{
				$sql.=" and ( b.pid=".$param." or b.id=".$param.")";
				$sql2.=" and ( b.pid=".$param." or b.id=".$param.")";
			}
					
			
		}
		
		$count = $pro->query($sql2);
		$count = intval($count[0]["count"]);
		$nowPage = isset($_GET['p'])?$_GET['p']:1;//页码、默认为1
		
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);
		$sql.=" order by a.sorts desc limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $pro->query($sql);
		$procateList = $procate->where(" enable =1 and pid=0  ")->order(' sorts desc')->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('procateList',$procateList);// 赋值数据集
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->assign("cate",$cate);//总记录数
		$this->assign("cate2",$cate2);//总记录数
		$this->assign("cate2List",$cate2List);//总记录数
		$this->display("product"); // 输出模板
	}
	//产品详情
	public function productInfo()
	{
		$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
		$da["page"]="产品详情页面";
		$vis->add($da);
		$procate = M("Procate");
		$pro = M("Products");
		
		$param = $_GET['procate'];//一级菜单
		$param2 = $_GET['procate2'];//二级菜单
		
		$cate = $procate->where("id=%d",$param)->find();
		$cate2 = $procate->where("id=%d",$param2)->find();
		$id = $_GET['id'];
		$procateList = $procate->where(" enable =1 and pid=0 ")->order(' sorts desc')->select();
		$productInfo = $pro->where(" id=%d",$id)->find();
		
		if(!$param)
		{
			$cate2 = $procate->where("id=%d",$productInfo["proid"])->find();
			$cate = $procate->where("id=%d",$cate2["pid"])->find();
		}
		
		
		$this->assign("procateList",$procateList);
		$this->assign("productInfo",$productInfo);
		$this->assign("cate",$cate);//总记录数
		$this->assign("cate2",$cate2);//总记录数
		$this->assign("procate",$procate);
		$this->display("productInfo");
	}
	//联系我们
	public function contact()
	{
		$ip = get_client_ip();
    	$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		$os = $utils->GetOS();
		$bw = $utils->GetBrowser();
		$lan = $utils->GetLang();
		$notes = $loca['country']." ".$loca['province']." ".$loca['city']."、".$os.$lan."系统、".$bw."浏览器、";
    	$vis = M("Visters");
    	$ctime = date('Y-m-d H:i');
    	$da["ctime"]=$ctime;
    	$da["info"]=$notes;
    	$da["ip"]=$ip;
		$da["page"]="产品详情页面";
		$vis->add($da);
		$content = M("Contents");
		$contact = $content->where(" enable=1 and cateid=3 ")->find();
		$this->assign('contact',$contact);
		$this->display("contact");
	}
}