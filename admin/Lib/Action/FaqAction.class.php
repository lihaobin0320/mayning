<?php

class FaqAction extends Action{
	
	public function __construct() {
	
		parent::__construct();
		if(!session('?users'))
		{
			$this->display("Login/nologin");
		}
		ini_set('date.timezone','PRC');
		Log::$format = '[ Y-m-d H:i:s ]';
		header("Content-Type:text/html; charset=utf-8");
	}
	
	public function faqcateList()
	{
		$faqcate = M("Faqcate");
		$count = $faqcate->where("")->count();// 查询满足要求的总记录数
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
		
		$list = $faqcate->where("")->order('sorts desc')->page($nowPage.','.$pageSize)->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("faqcateList"); // 输出模板
	}
	
	function changeFaqcateEnable()
	{
		$id =$_GET["id"];
		$enable =$_GET["enable"];
		
		$data["enable"] = $enable;
		$faqcate = M("Faqcate");
		$faqcate->where("id=%d",$id)->save($data);
		$this->faqcateList();
	}
	
	function changeFaqcateSort()
	{
		$id =$_GET["id"];
		$sort =$_GET["sort"];
	
		$data["sort"] = $sort;
		$faqcate = M("Faqcate");
		$faqcate->where("id=%d",$id)->save($data);
		$this->faqcateList();
	}
	
	function deleteFaqcate()
	{
		$ids =$_GET["ids"];
		$faqcate = M("Faqcate");
		$faqcate->where("id in (".$ids.")")->delete();
		$this->faqcateList();
	}
	
	public function faqcateDetail()
	{
		$id = $_GET["id"];
		
		$faqcate = M("Faqcate");
		$cate = $faqcate->where("id=%d",$id)->find();
		$this->assign("cate",$cate);
		$this->display("faqcateDetail");
	}
	
	public function addFaqcate()
	{
		$id = $_POST["id"];
		$faqcate = M("Faqcate");
		
		$title = $_POST["title"];
		$enable = $_POST["enable"];
		$sort = $_POST["sort"];
		$ctime = $_POST["ctime"];
		if(!$sort)
		{
			$sql="select max(sorts) as sorts from faqcate";
			$sort = $faqcate->query($sql);
			$sort = $sort[0]["sorts"]+1;
		}
		
		if(!$ctime)
		{
			$ctime= date('Y-m-d H:i');
		}
		
		$data["title"]=$title;
		$data["enable"]=$enable;
		$data["sorts"]=$sort;
		$data["ctime"]=$ctime;
		
		if($id)
		{
			$faqcate->where("id=%d",$id)->data($data)->filter('strip_tags')->save();
		}else{
			$faqcate->data($data)->filter('strip_tags')->add();
		}
		
		$this->faqcateList();
	}
	
	public function faqList()
	{
		$faqs = M("Faqs");
		$name = $_REQUEST["name"];
		$sql="select a.id ,a.title,a.ctime,a.sorts,a.enable,b.title as catetitle from faqs a left join faqcate b on a.faqcate=b.id where 1=1 ";
		$sql_count="select count(a.id) as count from faqs a left join faqcate b on a.faqcate=b.id where 1=1 ";
		if($name)
		{
			$sql=$sql." and a.title like '%".$name."%' or b.title like '%".$name."%' or a.ctime like '%".$name."%'";
			$sql_count=$sql_count." and a.title like '%".$name."%' or b.title like '%".$name."%' or a.ctime like '%".$name."%'";
		}
		$sql=$sql." order by a.sorts desc";
		$count = $faqs->query($sql_count);
		$count = $count[0]["count"];
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
		
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $faqs->query($sql);
		//跳转到页面，把list数组传到页面中
		$this->assign('name',$name);// 赋值数据集
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("faqList"); // 输出模板
	}
	
	public function changeFaqEnable()
	{
		$id = $_GET["id"];
		$enable = $_GET["enable"];
		
		$faqs = M("Faqs");
		$data["enable"]=$enable;
		$faqs->where("id=%d",$id)->save($data);
		$this->faqList();
	}
	
	public function changeFaqSort()
	{
		$id = $_GET["id"];
		$sort = $_GET["sort"];
		
		$faqs = M("Faqs");
		$data["sorts"]=$sort;
		$faqs->where("id=%d",$id)->save($data);
		$this->faqList();
	}
	
	public function deleteFaq()
	{
		$ids =$_GET["ids"];
		$faqs = M("Faqs");
		$faqs->where("id in (".$ids.")")->delete();
		$this->faqList();
	}
	
	public function getFaqDetail()
	{
		$id = $_GET["id"];
		$faqs = M("Faqs");
		$cate = M("Faqcate");
		
		$faqcateList = $cate->where("1=1")->select();
		$faq = $faqs->where("id=%d",$id)->find();
		
		$this->assign("faqcateList",$faqcateList);
		$this->assign("faq",$faq);
		$this->display("faqDetail");
		
	}
	
	public function addFaq()
	{
		
		
	}	
	
	
}

?>