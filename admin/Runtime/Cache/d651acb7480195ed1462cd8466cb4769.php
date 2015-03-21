<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
 <html lang="zh-CN">
 <head>
    	<meta charset="UTF-8">
   <link rel="stylesheet" href="__PUBLIC__/admin/css/common.css">
   <link rel="stylesheet" href="__PUBLIC__/admin/css/main.css">
   <link rel="stylesheet" href="__PUBLIC__/admin/css/kkpager.css">
   <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
   <script type="text/javascript" src="__PUBLIC__/admin/js/colResizable-1.3.min.js"></script>
   <script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
    <script type="text/javascript">
      $(function(){  
        $(".list_table").colResizable({
          liveDrag:true,
          gripInnerHtml:"<div class='grip'></div>", 
          draggingClass:"dragging", 
          minWidth:30
        }); 
        
      }); 
   </script>
   <script type="text/javascript" src="__PUBLIC__/admin/js/kkpager.min.js"></script>
 </head>
 <body>
  <div class="container">
     <div id="table" class="mt10">
        <div class="box span10 oh">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
              <thead>
                <tr>
                   <th width="10%">序号</th>
                   <th width="20%">访问页面</th>
                   <th width="20%">访问时间</th>
                   <th width="20%">访问IP</th>
                   <th>备注</th>
                </tr>
                </thead>
                <tbody id="table_body">
               <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vis): $mod = ($i % 2 );++$i;?><tr class="tr">
		  		<td class="td_center"><input type="checkbox"><?php echo ($i); ?></td>
		  		<td class="td_center"><?php echo ($vis["page"]); ?></td>
		  		<td class="td_center"><?php echo ($vis["ctime"]); ?></td>
		  		<td class="td_center"><?php echo ($vis["ip"]); ?></td>
		  		<td class="td_center"><?php echo ($vis["info"]); ?></td>
		  		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
                 </tbody>
              </table>

        </div>
     </div>
     
   </div> 
   <div id="kkpager"></div>
  <!--总页数-->
<input type="hidden"  id="pageCount"  value="<?php echo ($pageCount); ?>" />
<!--总记录数-->
<input type="hidden"  id="itemCount"  value="<?php echo ($itemsCount); ?>"/>
<!--当前页码-->
<input type="hidden"  id="pageNo"  value="<?php echo ($pageNo); ?>"/>
<script type="text/javascript">
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
			firstPageText : '首页',
			lastPageText : '尾页',
			prePageText : '上一页',
			nextPageText : '下一页',
			totalPageBeforeText : '共',
			totalPageAfterText : '页',
			totalRecordsAfterText : '条数据',
		
		},
		mode : 'click',//默认值是link，可选link或者click
		click : function(n){
			this.selectPage(n);
			window.location="__ROOT__/admin.php/Login/visterlist/p/"+n;
			
		  return false;
		}
	});
});
</script>
 </body>
 </html>