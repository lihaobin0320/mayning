<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>May Ning</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css"/>
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
<input type="hidden" id="menuid" value="2" />
<!--header end-->
<!--main-->
<div class="main" >
  <div class="wapper1000 margin_01">
       <!--right-->
            <div class="add_bo1" id="content">
    		<?php echo ($aboutUs["details"]); ?>	
    		</div>
       <!--right end-->
    </div>    
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
</body>
</html>