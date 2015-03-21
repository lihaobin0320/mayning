<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>May Ning</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css"/>
<link href="__PUBLIC__/css/slideBox.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/slideBox.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--header-->
<div class="header">
    <div class="wapper1000">
       <div class="logo"><a href="#"><img src="__PUBLIC__/images/logo.jpg" width="216" height="86" /></a></div>
       <ul class="nav">
           <li class="meun"><a href="__ROOT__/index.php/Index/index"  id="menu1">HOME</a></li>
           <li>|</li>
           <li class="meun"><a href="__ROOT__/index.php/Index/aboutUs" id="menu2">ABOUT US</a></li>
           <li>|</li>
           <li class="meun"><a href="__ROOT__/index.php/Index/news" id="menu3">FAQ</a></li>
           <li>|</li>
           <li class="meun"><a href="__ROOT__/index.php/Index/product" id="menu4">PRODUCT</a></li>
           <li>|</li>
           <li class="meun"><a href="__ROOT__/index.php/Index/contact" id="menu5">CONTACT</a></li>
           <li>|</li>
       </ul>
    </div>
</div>
<input type="hidden" id="menuid" value="1" />
<!--header end-->
<!--main-->
<div class="main">
  <div class="wapper1000">
        <!--大图轮播start-->
       <div  class="nivoSlider margin_01">
       	 <div class="slideBox" id="slideBox">
		   <ul class="items">
		  <?php if(is_array($rollList)): $i = 0; $__LIST__ = $rollList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li title="<?php echo ($vo["title"]); ?>" ><a  href="__ROOT__/index.php/Index/productInfo?id=<?php echo ($vo["id"]); ?>"><img src="<?php echo ($vo["imgs"]); ?>"  /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		    </ul>
		</div>
		</div> 
        <!--大图轮播end-->
        <!-- 小图轮播start -->
		    <div class="main_right margin_01"  id="indexShow">
		   <?php if(is_array($showList)): $i = 0; $__LIST__ = $showList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="main_img"><a href="__ROOT__/index.php/Index/productInfo?id=<?php echo ($vo["id"]); ?>"><img src="<?php echo ($vo["imgs"]); ?>" width="266" height="255" /></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
		   <!-- 小图轮播end -->
    </div>
     <!--about-->
    <div class="about">
        <div class="top" id="welcomeTitle"></div>
        <div class="nei" id="welcomeInfo"><?php echo ($welcome["details"]); ?></div>
    </div>
    <!--about end-->
</div>
<!--main end-->
<!-- buttom start -->
<div class="bottom">
  <div class="wapper1000">
  		<div class="bottom_left">
         <?php echo ($buttom["details"]); ?>
        </div>
        <div class="bottom_right"><img src="__PUBLIC__/images/logo_b.jpg" width="219" height="55" /></div>
  </div>
</div>
<!-- buttom end -->
<script src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/js/menu.js"></script>
<script type="text/javascript"  src="http://float2006.tq.cn/floatcard?adminid=9524889&sort=0" ></script> 
<script src="__PUBLIC__/js/slidebox.js"></script>
<script>
$(document).ready(function(){

	$('#slideBox').slideBox(
			{
				direction : 'left',//left,top#方向
				duration : 0.3,//滚动持续时间，单位：秒
				easing : 'swing',//swing,linear//滚动特效
				delay : 5,//滚动延迟时间，单位：秒
				startIndex : 1,//初始焦点顺序
				hideClickBar : false,//不自动隐藏点选按键
				clickBarRadius : 10
				});

	/* var info = remote_ip_info["country"]+","+remote_ip_info["province"]+","+remote_ip_info["city"]+","+remote_ip_info["isp"];
	var ip =  remote_ip_info["start"]+"-"+remote_ip_info["end"];
	$.post("conn/setVisters.php?ttid="+Math.random(),{info:info,ip:ip},function(datas){

	}); */
	
});	
</script>

</body>
</html>