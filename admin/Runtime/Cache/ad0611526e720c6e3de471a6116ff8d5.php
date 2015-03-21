<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">

    <link rel="stylesheet" href="__PUBLIC__/admin/css/login.css">
    <style type="text/css">
 	#msg{
	margin-top: 10px;
 	color: red;
 	}
	</style>
    <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/cookie.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    		$("input[name='username']").focus();
    	 	var username = getCookie("username");
    	    var password = getCookie("password");
    	    $("input[name='username']").val(username);
    	    $("input[name='password']").val(password);
    });
    
    function checkForm()
    {
    	var username = $("input[name='username']").val();
    	var password= $("input[name='password']").val();
    	var checkcode= $("input[name='checkcode']").val();
    	if(username==null || username=="")
    	{
    		$("#msg").html("登录名不能为空！");
    		$("input[name='username']").focus();
    		return false;
    	}
    	if(password==null || password=="")
    	{
    		$("#msg").html("登录密码不能为空！");
    		$("input[name='password']").focus();
    		return false;
    	}
    	
    	if(checkcode==null || checkcode=="")
    	{
    		$("#msg").html("验证码不能为空！");
    		$("input[name='checkcode']").focus();
    		return false;
    	}
    	
    	
    }
    
    function checkCode()
    {
    	var checkcode= $("input[name='checkcode']").val();
    	if(checkcode==null || checkcode=="")
    	{
    		$("#msg").html("验证码不能为空！");
    		$("input[name='checkcode']").focus();
    		return ;
    	}else{
    		
    		$.post("__ROOT__/admin.php/Login/checkCode",{checkcode:checkcode},function(data){
        		if(data==1)
        		{
        			$("#msg").html("验证码正确！");
        		}else{
        			$("#msg").html("验证码错误！");
            		$("input[name='checkcode']").focus();
        		}
        		
        	});
    		
    	}
    	
    }
    </script>
	<title>后台登陆</title>
</head>
<body>
	<div id="login_top">
		<div id="welcome">
			欢迎使用MayNing后台管理系统
		</div>
		<div id="back">
			<a href="http://www.mayning.cn">返回首页</a>&nbsp;&nbsp; | &nbsp;&nbsp;
			<a href="__ROOT__/admin.php/Login/nopass">忘记密码?</a>
		</div>
	</div>
	<div id="login_center">
		<div id="login_area">
			<div id="login_form">
				<form action="__ROOT__/admin.php/Login/startlogin" method="post" onsubmit="return checkForm()">
					<div id="login_tip">
						用户登录&nbsp;&nbsp;UserLogin
					</div>
					<div><input type="text" name="username" placeholder="登录名必填"  class="username" ></div>
					<div><input type="password" name="password" class="pwd" placeholder="登录密码必填" ></div>
					<div id="msg"><?php echo ($msg); ?></div>
					<div id="btn_area">
           				 <img src="__ROOT__/admin.php/Login/getCode" alt="" width="100" height="30" >  
           				  <input type = "text" name="checkcode" class="verify" onblur="checkCode()"  />  
           				 <input type="submit" id="sub_btn" value="登&nbsp;&nbsp;录" >&nbsp;&nbsp;
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="login_bottom">
		版权所有
	</div>
</body>
</html>