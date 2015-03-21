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
<input type="hidden" id="menuid" value="4" />
<input type="hidden" id="procate" value="<?php echo ($cate["id"]); ?>"/>
<input type="hidden" id="procate2" value="<?php echo ($cate2["id"]); ?>"/>
<!--header end-->
<!--main-->
<div class="main">
  <div class="wapper1000">
       <!--left-->
       <div class="add_left margin_01">
          <div class="top"></div>
          <div class="add_menu">
        <ul>
          <li title="All Faqs" ><a href="__ROOT__/index.php/Index/product" id="hover0" >All Product</a></li>
        <?php if(is_array($procateList)): $i = 0; $__LIST__ = $procateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$procate): $mod = ($i % 2 );++$i;?><li title="<?php echo ($procate["title"]); ?>"><a id="hover<?php echo ($procate["id"]); ?>" href="__ROOT__/index.php/Index/product?procate=<?php echo ($procate["id"]); ?>"><?php echo (msubstr($procate["title"],0,20,'utf-8',true)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		  </ul>
             
          </div>
          <div class="add_left_bo"></div>
       </div>
       <!--left end-->
       <!--right-->
    <div class="add_right margin_01">
    		<div class="nowpro">
             <?php if(($cate != null)): ?><a href="__ROOT__/index.php/Index/product">All Product </a> >> <a href="__ROOT__/index.php/Index/product?procate=<?php echo ($cate["id"]); ?>"><?php echo ($cate["title"]); ?></a><?php endif; ?>
             <?php if(($cate2 != null)): ?>>> <a href="__ROOT__/index.php/Index/product?procate=<?php echo ($cate["id"]); ?>&procate2=<?php echo ($cate2["id"]); ?>"><?php echo ($cate2["title"]); ?></a><?php endif; ?>
             </div>
     	  <div class="add_bo">
		            <div class="add_content">
		            <center><h2><?php echo ($productInfo["title"]); ?></h2></center><br />
		            <img src="<?php echo ($productInfo["imgs"]); ?>" style="max-width: 700px;min-height: 500px;" alt="" /><br/><br/>
		            <p><?php echo ($productInfo["details"]); ?></p>
					</div>
         </div>
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
<script type="text/javascript">
var procate = $("#procate").val();
if(procate)
{
	$("#hover"+procate).addClass("hover");
}else{
	$("#hover0").addClass("hover");
}
</script>
</body>
</html>