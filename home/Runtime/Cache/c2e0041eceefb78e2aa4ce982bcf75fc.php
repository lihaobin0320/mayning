<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>May Ning</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css"/>
<link href="__PUBLIC__/css/slideBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/kkpager.css" />
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
<!--总页数-->
<input type="hidden"  id="pageCount"  value="<?php echo ($pageCount); ?>" />
<!--总记录数-->
<input type="hidden"  id="itemCount"  value="<?php echo ($itemsCount); ?>"/>
<!--当前页码-->
<input type="hidden"  id="pageNo"  value="<?php echo ($pageNo); ?>"/>
<!--header end-->
<!--main-->
<div class="main">
  <div class="wapper1000">
       <!--left-->
       <div class="add_left margin_01">
          <div class="top"></div>
          <div class="add_menu">
          <ul class="menu-item">
          <li title="All Faqs" ><a href="__ROOT__/index.php/Index/product" id="hover0" >All Product</a></li>
        <?php if(is_array($procateList)): $i = 0; $__LIST__ = $procateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$procate): $mod = ($i % 2 );++$i;?><li title="<?php echo ($procate["title"]); ?>"><a id="hover<?php echo ($procate["id"]); ?>" href="__ROOT__/index.php/Index/product?procate=<?php echo ($procate["id"]); ?>"><?php echo (msubstr($procate["title"],0,20,'utf-8',true)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		  </ul>
             
          </div>
          <div class="add_left_bo"></div>
       </div>
       <!--left end-->
       <!--right-->
    <div class="add_right margin_01">
    	
    		  <div class="nowpro"><a href="__ROOT__/index.php/Index/product">
             <?php if(($cate != null)): ?>All Product </a> >> <a href="__ROOT__/index.php/Index/product?procate=<?php echo ($cate["id"]); ?>"><?php echo ($cate["title"]); ?></a><?php endif; ?>
             <?php if(($cate2 != null)): ?>>> <a href="__ROOT__/index.php/Index/product?procate=<?php echo ($cate["id"]); ?>&procate2=<?php echo ($cate2["id"]); ?>"><?php echo ($cate2["title"]); ?></a><?php endif; ?>
             </div>
             <div class="nowpro2">
             <?php if(is_array($cate2List)): $i = 0; $__LIST__ = $cate2List;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ca2): $mod = ($i % 2 );++$i;?><a id="cate<?php echo ($ca2["id"]); ?>" href="__ROOT__/index.php/Index/product?procate=<?php echo ($cate["id"]); ?>&procate2=<?php echo ($ca2["id"]); ?>"><?php echo ($ca2["title"]); ?></a> &nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
             </div>
            <div class="add_bo">
             <ul class="add_list" >
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><li><a href="javascript:godetail(<?php echo ($pro["id"]); ?>)"><img src="<?php echo ($pro["imgs"]); ?>" width="215" height="207" /></a><span><a href="#"><?php echo ($pro["title"]); ?></a></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
         </div>
         <div id="kkpager"></div>
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
<script type="text/javascript" src="__PUBLIC__/js/kkpager.min.js"></script>
<script type="text/javascript">
var procate = $("#procate").val();
var procate2 = $("#procate2").val();
if(procate2)
{
	$("#cate"+procate2).addClass("active");
	$("#cate"+procate2).removeAttr("href");
}	
if(procate)
{
	$("#hover"+procate).addClass("hover");
}else{
	$("#hover0").addClass("hover");
}

function godetail(id)
{
	var procate = $("#procate").val();
	var procate2 = $("#procate2").val();
	if(procate)
	{
		if(procate2)
			{
				window.location="__ROOT__/index.php/Index/productInfo?procate="+procate+"&id="+id+"&procate2="+procate2;
			}else{
				window.location="__ROOT__/index.php/Index/productInfo?procate="+procate+"&id="+id;
			}
		
	}else{
		window.location="__ROOT__/index.php/Index/productInfo?id="+id;
	}
}

$(function(){
	var totalPage = $("#pageCount").val();
	var totalRecords = $("#itemCount").val();
	var pageNo = $("#pageNo").val();
	if(!pageNo){
		pageNo = 1;
	}
	//生成分页
	//有些参数是可选的，比如lang，若不传有默认值
	kkpager.generPageHtml({
		pno : pageNo,
		//总页码
		total : totalPage,
		//总数据条数
		totalRecords : totalRecords,
		lang : {
			firstPageText : 'First',
			firstPageTipText:"First",
			lastPageText : 'End',
			lastPageTipText :"End",
			prePageText : 'Pre',
			prePageTipText :"Pre",
			nextPageText : 'Next',
			nextPageTipText :"Next",
			totalPageBeforeText : '',
			totalPageAfterText : 'pages',
			totalRecordsAfterText : 'counts',
			gopageBeforeText :"go",
			gopageAfterText :"page",
			gopageButtonOkText:"ok",
			buttonTipBeforeText:"",
			buttonTipAfterText :"page",
		
		},
		mode : 'click',//默认值是link，可选link或者click
		click : function(n){
			this.selectPage(n);
			var procate = $("#procate").val();
			var procate2 = $("#procate2").val();
			if(procate)
			{
				if(procate2)
				{
					window.location="__ROOT__/index.php/Index/product/p/"+n+"?procate="+procate+"&procate2="+procate2;
				}else{
					window.location="__ROOT__/index.php/Index/product/p/"+n+"?procate="+procate;
				}
				
			}else{
				window.location="__ROOT__/index.php/Index/product/p/"+n;
			}
			
		  return false;
		}
	});
});
</script>
</body>
</html>