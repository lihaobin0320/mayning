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
<input type="hidden" id="menuid" value="3" />
<input type="hidden" id="faqcate" value="{#faqcate}" />
<!--header end-->
<!--main-->
<div class="main">
  <div class="wapper1000">
       <!--left-->
       <div class="add_left margin_01">
          <div class="top_faq"></div>
          <div class="add_menu">
          <ul>
          <li title="All Faqs" ><a href="__ROOT__/index.php/Index/news" id="hover0" >All FAQS</a></li>
        <?php if(is_array($faqcateList)): $i = 0; $__LIST__ = $faqcateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$faqcate): $mod = ($i % 2 );++$i;?><li title="<?php echo ($faqcate["title"]); ?>"><a id="hover<?php echo ($faqcate["id"]); ?>" href="__ROOT__/index.php/Index/news?faqcate=<?php echo ($faqcate["id"]); ?>"><?php echo (msubstr($faqcate["title"],0,25,'utf-8',true)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		  </ul>
             
          </div>
          <div class="add_left_bo"></div>
       </div>
       <!--left end-->
       <!--right-->
    <div class="add_right margin_01">
     	<div class="add_bo1" id="content">
                <?php echo ($faqInfo["details"]); ?>
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
var faqcate = getParam("faqcate");
if(faqcate)
{
	$("#faqcate").val(faqcate);
	$("#hover"+faqcate).addClass("hover");
}else{
	$("#hover0").addClass("hover");
}
</script>
</body>
</html>