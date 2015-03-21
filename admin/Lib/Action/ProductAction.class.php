<?php
class ProductAction extends Action {

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
	
	//获取全部产品分类
	public function procateList()
	{
		$procate = M("Procate");
		$count = $procate->where("")->count();// 查询满足要求的总记录数
		$sql="select a.id ,a.title,a.ctime,a.enable,a.sorts,a.pid,b.title as ptitle from procate a left join procate b on a.pid = b.id order by a.sorts desc,a.pid asc ";
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
		$list = $procate->query($sql);
		//跳转到页面，把list数组传到页面中
		$this->assign('list',$list);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("procateList"); // 输出模板
		
	}
	
	//修改产品分类排序
	public function changeProductcateSort()
	{
		$id = $_GET["id"];
		$sort = $_GET["sort"];
		$procate = M("Procate");
		$data['sorts'] = $sort;
		$procate->where("id=%d",$id)->save($data);
		$this->procateList();
	}
	
	//产品分类详情
	public function getProcateDetail()
	{
		$id = $_GET["id"];
		$pid = $_GET["pid"];
		$procate = M("Procate");
		$pro=$procate->where("id=%d",$id)->find();
		$procateList ;//一级分类
		if($pid)
		{
			$procateList = $procate->where("pid=0")->select();
		}	
		$this->assign("pro",$pro);
		$this->assign("pid",$pid);
		$this->assign("procateList",$procateList);
		$this->display("addProcate");
	}
	//删除产品分类
	function deleteAllProcate()
	{
		$ids = $_GET["ids"];
		if($ids)
		{
			$procate = M("Procate");
			$procate->where("id in (".$ids.")")->delete();
		}	
		$this->procateList();
		
	}
	
	//增加、更新产品分类
	function addProcate()
	{
		$id = $_POST["id"];
		$ctime = $_POST["ctime"];
		$title = $_POST["title"];
		$pid = $_POST["pid"];
		$enable =$_POST["enable"];
		$count =$_POST["count"];
		$procate = M("Procate");
		
		if(!$pid)
		{
			$pid=0;
		}
		
		if(!$count)
		{
			$sql="select max(sorts) as sorts from procate";
			$count = $procate->query($sql);
			$count = $count[0]["sorts"]+1;
		}
		
		if(!$ctime)
		{
			$ctime= date('Y-m-d H:i');
		}	
		$data['title'] = $title;
		$data['ctime'] = $ctime;
		$data['enable'] = $enable;
		$data['pid'] = $pid;
		$data['sorts'] = $count;
		if($id)
		{
			$procate->where("id=%d",$id)->data($data)->filter('strip_tags')->save();
		}else{
			$procate->data($data)->filter('strip_tags')->add();
		}
		
		$this->procateList();
		
	}
	//更新产品分类启用状态
	public function changeProductcateEnable()
	{
		
		$id = $_GET["id"];
		$enable = $_GET["enable"];
		$procate = M("Procate");
		$data['enable'] = $enable;
		$procate->where("id=%d",$id)->save($data);
		$this->procateList();
	}
	
	//查询所有产品
	public function getAllProductList()
	{
		$product = M("Products");
		$procate= M("Procate");
		
		$name = $_REQUEST["name"];
		
		$sql="select a.id,a.title,a.ctime,a.imgs,a.sorts,a.enable,a.state,a.proid,b.title as protitle from products a left join procate b on a.proid = b.id where 1=1 ";
		$sql_count="select count(a.id) as count from products a left join procate b on a.proid = b.id where 1=1 ";
		if($name)
		{
			$sql=$sql." and a.title like '%".$name."%' or b.title like '%".$name."%' or a.ctime like '%".$name."%'";
			$sql_count=$sql_count." and a.title like '%".$name."%' or b.title like '%".$name."%' or a.ctime like '%".$name."%'";
		}
		$sql=$sql." order by a.sorts desc";
		$procateList = $procate->where("pid=0")->order("sorts asc,pid asc")->select();
		$count = $product->query($sql_count);
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
		$list = $product->query($sql);
		//跳转到页面，把list数组传到页面中
		$this->assign('procateList',$procateList);// 赋值数据集
		$this->assign('list',$list);// 赋值数据集
		$this->assign('name',$name);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("productList"); // 输出模板
	}
	//删除产品
	public function deleteAllProduct()
	{
		$ids = $_GET["ids"];
		if($ids)
		{
			$product = M("Products");
			$product->where("id in (".$ids.")")->delete();
		}
		$this->getAllProductList();
		
	}
	
	//改变产品启用状态
	public function changeProductEnable()
	{
		
		$id = $_GET["id"];
		$enable = $_GET["enable"];
		$product = M("Products");
		$data["enable"]=$enable;
		$product->where("id=%d",$id)->save($data);
		$this->getAllProductList();
	}
	//改变产品显示状态、首页轮播1、首页展示2
	public function changeProductState()
	{
		$id = $_GET["id"];
		$state = $_GET["state"];
		$product = M("Products");
		$data["state"]=$state;
		$product->where("id=%d",$id)->save($data);
		$this->getAllProductList();
		
	}
	//改变产品排序
	public function changeProductSort()
	{
		$id = $_GET["id"];
		$sort = $_GET["sort"];
		$product = M("Products");
		$data["sorts"]=$sort;
		$product->where("id=%d",$id)->save($data);
		$this->getAllProductList();
	
	}
	
	//产品详情
	public function getProductDetail()
	{
		$id = $_GET["id"];
		
		$products = M("Products");
		$procate = M("Procate");
		$product = $products->where("id=%d",$id)->find();
		$procateList = $procate->where("pid=0")->select();
		$pid;
		if($product)
		{
			$cate = $procate->where("id=%d",$product["proid"])->find();
			$pid =intval($cate["pid"]);
		}
		$this->assign("pid",$pid);
		$this->assign("product",$product);
		$this->assign("procateList",$procateList);
		$this->display("addProduct");
		
	}
	//根据前台传递上级产品分类ID获取下级分类
	public function selectChildProcate()
	{
		$id = $_GET["id"];
		$procate = M("Procate");
		$procateList = $procate->where("pid=%d",$id)->select();
		$this->ajaxReturn($procateList);
	}
	//新增、更新产品信息
	public function addProduct()
	{
		$product = M("Products");
		$id = $_POST["id"];
		$uploads = $_POST["uploads"];
		$ctime = $_POST["ctime"];
		$sorts = $_POST["sorts"];
		$title = $_POST["title"];
		$procate = $_POST["procate"];
		$procate2 = $_POST["procate2"];
		$content = $_POST["content"];
		$enable = $_POST["enable"];
		if($content)
		{
			$content= str_replace("\\", "", $content);
		}
		if(!$ctime)
		{
			$ctime= date('Y-m-d H:i');
		}
		if(!$sorts)
		{
			$sql="select max(sorts) as sorts from products";
			$sorts = $product->query($sql);
			$sorts = $sorts[0]["sorts"]+1;
		}
		
		$data["title"]=$title;
		$data["imgs"]=$uploads;
		$data["ctime"]=$ctime;
		$data["sorts"]=$sorts;
		$data["details"]=$content;
		$data["enable"]=$enable;
		if($procate2)
		{
			$data["proid"]=$procate2;
		}else{
			$data["proid"]=$procate;
		}
		$data["state"]=0;
		
		if($id)
		{
			$product->where("id=%d",$id)->data($data)->save();
		}else{
			$product->data($data)->add();
		}
		
		$this->getAllProductList();
		
	} 

}