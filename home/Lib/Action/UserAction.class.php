<?php
class UserAction extends Action {
	
	public function userList()
	{
		$u = M("Users");
		$name = $_REQUEST["name"];
		$temp="";
		if($name)
		{
			$temp=" username like '%".$name."%' or ctime like '%".$name."%' or lastlogin like '%".$name."%' or email like '%".$name."%' ";
		}else{
			$temp="";
		}
		$count = $u->where($temp)->count();// 查询满足要求的总记录数
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
		
		$list = $u->where($temp)->order('ctime desc')->page($nowPage.','.$pageSize)->select();
		//跳转到页面，把list数组传到页面中
		$this->assign('list',$list);// 赋值数据集
		$this->assign('name',$name);// 赋值数据集
		$this->assign("itemsCount",$count);//总记录数
		$this->assign("pageCount",$pageCount);//总页数
		$this->assign("pageNo",$nowPage);//总记录数
		$this->display("userList"); // 输出模板
	}
	
	public function userDetail()
	{
		$u = M("Users");
		$id = $_GET["id"];
		
		$user = $u->where("id=%d",$id)->find();
		$this->assign("user",$user);//总记录数
		$this->display("userDetail");
	}
	
	public function deleteUser()
	{
		$ids = $_GET["ids"];
		if($ids)
		{
			$u = M("Users");
			$u->where("id in (".$ids.")")->delete();
		}
		$this->userList();
	}
	
	public function addUser()
	{
		
		$id = $_POST["id"];
		$ctime = $_POST["ctime"];
		$title = $_POST["title"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$enable = $_POST["enable"];
		$utils = new UtilAction();
		$keys = $utils->randstr();
		$u = M("Users");
		if(!$ctime)
		{
			$ctime= date('Y-m-d H:i');
		}
		
		$data["username"]=$title;
		$data["email"]=$email;
		$data["enable"]=$enable;
		$data["ctime"]=$ctime;
		if($password)
		{
			$data["salts"]=$keys;
			$data["password"]=$utils->encrypt($password, $keys);
		}
		
		if($id)
		{
			$u->where("id=%d",$id)->filter('strip_tags')->save($data);
			
		}else{
			$u->filter('strip_tags')->add($data);
		}
		
		$this->userList();
	}
    
	
	public function goUpdatePass()
	{
	
		$this->display("updatePass");

	}
	
	public function updatePass()
	{
		
		$u = session("users");
		$ur = M("Users");
		$utils = new UtilAction();
		$keys = $utils->randstr();
		
		$pass = $_POST["pass"];
		$password = $_POST["password"];
		
		$msg ="";
		if($utils->encrypt($pass, $u["salts"])!=$u["password"])
		{
			$msg="原密码错误！";
			$this->assign("msg",$msg);
			$this->display("updatePass");
		}else{
			$data["salts"]=$keys;
			$data["password"]=$utils->encrypt($password, $keys);
			$ur->where("id=%d",$u["id"])->save($data);
			$msg="密码修改成功，请重新登录！";
			session_destroy();
			$this->assign("msg",$msg);
			$this->display("updateSuccess");
			//重定向到指定的URL地址
			//redirect('/New/category/cate_id/2', 5, '页面跳转中...');
		}
		
	}

}