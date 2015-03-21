<?php

class ContentAction extends Action{
	
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
	
	public function contentDetail()
	{
		
		$cate = $_GET["cate"];
		$content = M("Contents");
		
		$con = $content->where("cateid=%d",$cate)->find();
		$this->assign("con",$con);
		$this->assign("cate",$cate);
		$this->display("contentDetail");
	}
	
	public function goAddContent()
	{
		$id = $_GET["id"];
		$cate = $_GET["cate"];
		$content = M("Contents");
		$category = M("Category");
		$con = $content->where("id=%d",$id)->find();
		$gory = $category->where("id=%d",$cate)->find();
		$this->assign("cate",$cate);
		$this->assign("con",$con);
		$this->assign("gory",$gory);
		$this->display("addContent");
	}
	
	public function addContent()
	{
		$id = $_POST["id"];
		$cate = $_POST["cate"];
		$title= $_POST["title"];
		$sorts = $_POST["sorts"];
		$ctime = $_POST["ctime"];
		$details = $_POST["content"];
		if($details)
		{
			$details= str_replace("\\", "", $details);
		}
		
		$con = M("Contents");
		if(!$sorts)
		{
			$sql="select max(sorts) as sorts from contents";
			$sorts = $con->query($sql);
			$sorts = $sorts[0]["sorts"]+1;
		}
		
		if(!$ctime)
		{
			$ctime= date('Y-m-d H:i');
		}
		
		$data["cateid"]=$cate;
		$data["title"]=$title;
		$data["sorts"]=$sorts;
		$data["ctime"]=$ctime;
		$data["details"]=$details;
		$data["enable"]=1;
		if($id)
		{
			$con->where("id=%d",$id)->data($data)->save();
		}else{
			$con->data($data)->add();
		}
		
		$this->returncontentDetail($cate);
		
	}
	
	public function returncontentDetail($cate)
	{
		$content = M("Contents");
		$con = $content->where("cateid=%d",$cate)->find();
		$this->assign("con",$con);
		$this->assign("cate",$cate);
		$this->display("contentDetail");
	}
	
	public function deleteContent()
	{
		$content = M("Contents");
		$id = $_GET["id"];
		$cate =$_GET["cate"];

		$content->where("id=%d",$id)->delete();
		$this->returncontentDetail($cate);
	}
	
	
	
}

?>