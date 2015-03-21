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
     <div id="button" class="mt10">
     	<input type="button" name="button" class="btn btn82 btn_checked" value="全选" onclick="selectAll()"> 
       <input type="button" name="button" class="btn btn82 btn_add" value="新增" onclick="addProcate()"> 
       <input type="button" name="button" class="btn btn82 btn_del" value="删除" onclick="deleteAll()"> 
     </div>
     <div id="table" class="mt10">
        <div class="box span10 oh">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <thead>
                <tr>
                   <th width="5%">序&nbsp;号</th>
                   <th width="5%">排&nbsp;序</th>
                   <th >分类名称</th>
                   <th width="15%">创建时间</th>
                   <th width="10%">启用状态</th>
                   <th width="15%">上级分类</th>
                   <th width="25%">操&nbsp;&nbsp;作</th>
                </tr>
               </thead>
               <tbody id="table_body"> 
               <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$procate): $mod = ($i % 2 );++$i;?><tr class="tr">
	  			<td class="td_center"><input type="checkbox" value="<?php echo ($procate["id"]); ?>" /><?php echo ($i); ?></td>
	  			<td class="td_center"><input type="hidden" name="sortid" value="<?php echo ($procate["id"]); ?>" /><input type="text" name="sort" value="<?php echo ($procate["sorts"]); ?>" onblur="blurInput(this)" onfocus="focusInput(this)"  style="border:1px;width:40px;" /><input type="button" onclick="sortConfirm(this)" name="sortbt" style="display:none;margin-top:5px;"  value="确定" class="ext_btn ext_btn_submit"></td>
	  			<td class="td_center"><a href="__ROOT__/admin.php/Product/getProcateDetail?id=<?php echo ($procate["id"]); ?>" ><?php echo (msubstr($procate["title"],0,20,'utf-8',true)); ?></a></td>
	  			<td class="td_center"><?php echo ($procate["ctime"]); ?></td>
	  			<?php if(($procate["enable"] == 1)): ?><td class="td_center">已启用</td>
	  			<?php else: ?>
	  			<td class="td_center">未启用</td><?php endif; ?>
	  			<td class="td_center"><?php echo (msubstr($procate["ptitle"],0,20,'utf-8',true)); ?></td>
	  			<td class="td_center">
	  			<?php if(($procate["pid"] == 0)): ?><a href="__ROOT__/admin.php/Product/getProcateDetail?pid=<?php echo ($procate["id"]); ?>" class="ext_btn ext_btn_submit"><span class="add"></span>子分类</a>&nbsp;&nbsp;
	  			 	<?php else: endif; ?>
	  			<?php if(($procate["enable"] == 1)): ?><a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductcateEnable?id=<?php echo ($procate["id"]); ?>&enable=2">禁用</a> &nbsp;&nbsp;
	  		   	<?php else: ?>
	  		    <a  class="ext_btn" href="__ROOT__/admin.php/Product/changeProductcateEnable?id=<?php echo ($procate["id"]); ?>&enable=1">启用</a>&nbsp;&nbsp;<?php endif; ?>
	  			<input type="button" name="button" onclick="deletes(<?php echo ($procate["id"]); ?>)" class="ext_btn ext_btn_error" value="删除" />
	  			</td>
	  			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
              </table>
              
              <div id="kkpager"></div>
        </div>
     </div>
    
   </div> 
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
			window.location="__ROOT__/admin.php/Product/procateList/p/"+n;
			
		  return false;
		}
	});
});

function focusInput(obj)
{
	$("input[name='sortbt']").hide();
	$(obj).parent().find("input[name='sortbt']").show();
}

function blurInput(obj)
{
	var oo= $(obj).parent().find("input[name='sortbt']");
	//alert($(oo).focus());
	//if($(oo).focus())
		//{
			sortConfirm(oo);
		//}else{
		//	$(obj).parent().find("input[name='sortbt']").hide();
		//}
}
function sortConfirm(obj)
{
	$(this).attr("disabled","disabled");
	var sort= $(obj).parent().find("input[name='sort']").val();
	var id = $(obj).parent().find("input[name='sortid']").val();
	window.location="__ROOT__/admin.php/Product/changeProductcateSort?id="+id+"&sort="+sort;
}

function selectAll()
{
	$("input:checkbox").each(function(){
		
		var flag = $(this).attr("checked");
		if(flag)
			{
				$(this).removeAttr("checked");
			}else{
				$(this).attr("checked","checked");
				
			}
	});
}


function deleteAll()
{
	var ids = "";
	$("input:checkbox:checked").each(function(){
		ids+=$(this).val()+",";
	});
	
	if(ids !=null && ids !="")
		{
			var str_end = ids.substring(ids.length-1,ids.lenght);
			if(str_end==",")
				{
				 ids = ids.substring(0, ids.length-1);
				}
		}else{
			alert("请先选择要删除的序号");
			return;
		}
	var bo = confirm("确定要删除，该选项不可恢复？");
	if(bo)
	{
		window.location="__ROOT__/admin.php/Product/deleteAllProcate?ids="+ids;
	}	
	
	
}

function addProcate(){
	window.location="__ROOT__/admin.php/Product/getProcateDetail";
}

function deletes(id)
{
	var bo = confirm("确定要删除，该选项不可恢复？");
	if(bo)
	{
		window.location="__ROOT__/admin.php/Product/deleteAllProcate?ids="+id;
	}	
}

</script>
 </body>
 </html>