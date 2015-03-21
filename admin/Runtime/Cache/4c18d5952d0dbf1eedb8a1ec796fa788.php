<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="__PUBLIC__/admin/css/common.css">
<link rel="stylesheet" href="__PUBLIC__/admin/css/style.css">
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery.SuperSlide.js"></script>
<script type="text/javascript">
$(function(){
	$(".sideMenu").slide({
		titCell:"h3",
		targetCell:"ul",
		defaultIndex:0,
		effect:'slideDown',
		delayTime:'500' ,
		trigger:'click',
		triggerTime:'150',
		defaultPlay:true,
		returnDefault:false,
		easing:'easeInQuint',
		endFun:function(){
			scrollWW();
		}
	});
	$(window).resize(function() {
		scrollWW();
	});
});
function scrollWW(){
	if($(".side").height()<$(".sideMenu").height()){
		$(".scroll").show();
		var pos = $(".sideMenu ul:visible").position().top-38;
		$('.sideMenu').animate({top:-pos});
	}else{
		$(".scroll").hide();
		$('.sideMenu').animate({top:0});
		n=1;
	}
}

var n=1;
function menuScroll(num){
	var Scroll = $('.sideMenu');
	var ScrollP = $('.sideMenu').position();
	/*alert(n);
	 alert(ScrollP.top);*/
	if(num==1){
		Scroll.animate({top:ScrollP.top-38});
		n = n+1;
	}else{
		if (ScrollP.top > -38 && ScrollP.top != 0) { ScrollP.top = -38; }
		if (ScrollP.top<0) {
			Scroll.animate({top:38+ScrollP.top});
		}else{
			n=1;
		}
		if(n>1){
			n = n-1;
		}
	}
}
</script>
<title>后台首页</title>
</head>
<body>
<div class="top">
<div id="top_t">
<div id="logo" class="fl"></div>
<div id="photo_info" class="fr">
<div id="photo" class="fl">
<a href="__ROOT__/admin.php/User/userDetail?id=<?php echo ($_SESSION['users']['id']); ?>" target="right"><img src="__PUBLIC__/admin/images/a.png" alt="" width="60" height="60"></a>
</div>
<div id="base_info" class="fr">
<div class="help_info">
<a href="#" id="hp">&nbsp;</a>
<a href="#" id="gy">&nbsp;</a>
<a href="__ROOT__/admin.php/Login/nologin" id="out">&nbsp;</a>
</div>
<div class="info_center">
	<a href="__ROOT__/admin.php/User/userDetail?id=<?php echo ($_SESSION['users']['id']); ?>" class="info_center_pass" target="right"><?php echo ($_SESSION['users']['username']); ?></a>
  <span id="nt"><a class="info_center_pass"  target="right"  href="__ROOT__/admin.php/User/goUpdatePass">修改密码</a></span>
</div>
</div>
</div>
</div>
<div id="side_here">
<div id="side_here_l" class="fl"></div>
<div id="here_area" class="fl">当前位置：登录统计</div>
</div>
</div>
<div class="side">
<div class="sideMenu" style="margin:0 auto">
<h3 >后台统计</h3>
<ul>
<li style="cursor:pointer" class="on"  onclick="selectPage('__ROOT__/admin.php/Login/loginCount',this)">登录统计</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Login/visterlist',this)">访客信息</li>
</ul>
<h3>产品管理</h3>
<ul>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Product/procateList',this)">分类管理</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Product/getAllProductList',this)">产品管理</li>
</ul>
<h3>信息管理</h3>
<ul>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Content/contentDetail?cate=1',this)">首页欢迎语</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Content/contentDetail?cate=2',this)">关于我们</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Content/contentDetail?cate=3',this)">联系方式</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Content/contentDetail?cate=4',this)">网站底部联系方式</li>
</ul>
<h3>FAQ管理</h3>
<ul>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Faq/faqcateList',this)">FAQ分类管理</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/Faq/faqList',this)">FAQ管理</li>
</ul>
<h3>其他链接</h3>
<ul>
<li ><a href="http://vip.tq.cn/vip/index.do" target="_blank">客服设置</a></li>
<li style="cursor:pointer"><a href="http://www.mayning.cn" target="_blank">返回首页</a></li>
</ul>
<h3>用户管理</h3>
<ul>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/User/userList',this)">用户信息</li>
<li style="cursor:pointer" onclick="selectPage('__ROOT__/admin.php/User/goUpdatePass',this)">修改密码</li>
</ul>




</div>
</div>
<div class="main">
<iframe name="right" id="rightMain" src="__ROOT__/admin.php/Login/loginCount" frameborder="no" scrolling="auto" width="100%" height="auto" allowtransparency="true"></iframe>
</div>
<div class="bottom">
<div id="bottom_bg">版权</div>
</div>
<div class="scroll">
<a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a>
<a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a>
</div>
<script type="text/javascript">

function selectPage(urls,obj)
{
	$("li").each(function(){
		$(this).removeAttr("class");
	});
	$(obj).attr("class","on");
	$("#rightMain").removeAttr("src");
	$("#rightMain").attr("src",urls);
	$("#here_area").html("当前位置：\t"+$(obj).html());
}

</script>
</body>

</html>