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
     	<input type="button" name="button" class="btn btn82 btn_checked" value="全选"  onclick="selectAll()"> 
       <input type="button" name="button"  class="btn btn82 btn_add" onclick="addProduct()"  value="新增"> 
       <input type="button" name="button" class="btn btn82 btn_del" value="删除" onclick="deleteAll()"> 
     </div>
     <div id="search_bar" class="mt10">
       <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">搜索</b></div>
            <div class="box_center pt10 pb10">
            <form action="__ROOT__/admin.php/Product/getAllProductList" id="selectForm" method="post">
              <table class="form_table" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>搜索条件：</td>
                  <td><input type="text" onclick="this.select()" value="<?php echo ($name); ?>" name="name"  placeholder="输入名称、分类、时间关键字查询" class="input-text lh25" size="50"></td>
                  <td>
                   <input type="submit" name="button" class="btn btn82 btn_search" value="查询"> 
                    <input type="button" onclick="javascript:window.location.reload()"  name="button" class="btn btn82 btn_nochecked" value="重置">
                  </td>
                </tr>
              </table>
             </form> 
            </div>
            <div class="box_bottom pb5 pt5 pr10" style="border-top:1px solid #dadada;">
              <div class="search_bar_btn" style="text-align:right;">
            
              </div>
            </div>
          </div>
        </div>
    </div>
     <div id="table" class="mt10">
        <div class="box span10 oh">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <thead>
                <tr>
                   <th width="5%">序&nbsp;&nbsp;号</th>
                   <th width="5%">排&nbsp;&nbsp;序</th>
                   <th width="10%">图&nbsp;&nbsp;片</th>
                   <th >产品名称</th>
                   <th width="12%">产品分类</th>
                   <th width="8%">产品状态</th>
                   <th width="12%">创建时间</th>
                   <th width="30%">操&nbsp;&nbsp;作</th>
                </tr>
               </thead>
               <tbody id="table_body"> 
               <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><tr class="tr">
	  			  <td class="td_center"><input type="checkbox" value="<?php echo ($pro["id"]); ?>" /><?php echo ($i); ?> </td>
	  		      <td class="td_center"><input type="hidden" name="sortid" value="<?php echo ($pro["id"]); ?>" /><input type="text" name="sort" value="<?php echo ($pro["sorts"]); ?>" onblur="blurInput(this)" onfocus="focusInput(this)"  style="border:1px;width:40px;" /><input type="button" onclick="sortConfirm(this)" name="sortbt" style="display:none;margin-top:5px;"  value="确定" class="ext_btn ext_btn_submit"></td>
	  		 	  <td class="td_center"><a href="__ROOT__/admin.php/Product/getProductDetail?id=<?php echo ($pro["id"]); ?>"  /><img src="<?php echo ($pro["imgs"]); ?>" height="100" width="100" /></a></td>
	  		      <td class="td_center"><a href="__ROOT__/admin.php/Product/getProductDetail?id=<?php echo ($pro["id"]); ?>"  /><?php echo (msubstr($pro["title"],0,20,'utf-8',true)); ?></a></td>
	  		      <td class="td_center"><?php echo (msubstr($pro["protitle"],0,30,'utf-8',true)); ?></td>
	  			<?php if(($pro["enable"] == 1)): if(($pro["state"] == 1)): ?><td class="td_center">大图轮播<a class="ext_btn"  href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=0" >取消</a></td>
	  				<?php elseif(($pro["state"] == 2)): ?>
	  				<td class="td_center">小图展示<a class="ext_btn"  href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=0" >取消</a></td>
	  				<?php else: ?>
	  				<td class="td_center">已展示</td><?php endif; ?>
	  			<?php else: ?>
	  			<td class="td_center">未展示</td><?php endif; ?>	
	  			<td class="td_center"><?php echo ($pro["ctime"]); ?></td>
	  			<td class="td_center">
	  			<!-- <a href="__ROOT__/admin.php/Product/getProductDetail?id=<?php echo ($pro["id"]); ?>" class="ext_btn ext_btn_submit" />修改</a>&nbsp;&nbsp; -->
	  		
	  			<?php if(($pro["enable"] == 1)): ?><a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductEnable?id=<?php echo ($pro["id"]); ?>&enable=2">前台隐藏</a> &nbsp;&nbsp;
	  				<?php if(($pro["state"] == 1)): ?><a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=2">小图展示</a> &nbsp;&nbsp;	
	  				<?php elseif(($pro["state"] == 2)): ?>
	  				<a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=1">大图轮播</a> &nbsp;&nbsp;
	  				<?php else: ?>
	  				<a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=2">小图展示</a> &nbsp;&nbsp;
	  				<a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductState?id=<?php echo ($pro["id"]); ?>&state=1">大图轮播</a> &nbsp;&nbsp;<?php endif; ?>	
	  			<?php else: ?>
	  				<a class="ext_btn" href="__ROOT__/admin.php/Product/changeProductEnable?id=<?php echo ($pro["id"]); ?>&enable=1" >前台展示</a> &nbsp;&nbsp;<?php endif; ?>
	  			<input type="button" name="button" onclick="deletes(<?php echo ($pro["id"]); ?>)" class="ext_btn ext_btn_error" value="删除" />
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
 	
   function addProduct()
   {
   	window.location="__ROOT__/admin.php/Product/getProductDetail";
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
			window.location="__ROOT__/admin.php/Product/deleteAllProduct?ids="+ids;
		}
 	}
   
   function deletes(id)
   {
   	var bo = confirm("确定要删除，该选项不可恢复？");
   	if(bo)
   	{
   		window.location="__ROOT__/admin.php/Product/deleteAllProduct?ids="+id;
   	}	
   }
   
   function focusInput(obj)
   {
   	$("input[name='sortbt']").hide();
   	$(obj).parent().find("input[name='sortbt']").show();
   }

   function blurInput(obj)
   {
   	var oo= $(obj).parent().find("input[name='sortbt']");
   	//if($(oo).focus())
   		//{
   			//$(obj).parent().find("input[name='sortbt']").attr("disabled","disabled");
   			sortConfirm(oo);
   		//}else{
   			//$(obj).parent().find("input[name='sortbt']").hide();
   		//}
   }
   function sortConfirm(obj)
   {
   		var sort= $(obj).parent().find("input[name='sort']").val();
   		var id = $(obj).parent().find("input[name='sortid']").val();
   		window.location="__ROOT__/admin.php/Product/changeProductSort?id="+id+"&sort="+sort;
   }
   
   $(function(){
	   
	   selectProcate();
	   
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
				var name = $("input[name='name']").val();
				window.location="__ROOT__/admin.php/Product/getAllProductList/p/"+n+"?name="+name;
				
			  return false;
			}
		});
	});
   
   function selectProcate()
	{
		var id = $("#procate").val();
		if(!id)
		{
			$("#procate2").hide();
		}else{
			$("#procate2").show();
		}
		$.getJSON("__ROOT__/admin.php/Product/selectChildProcate",{id:id},function(json){
		var str='<option value="">==全部分类==</option> ';
		
		$.each(json,function(index,item){
			str+='<option value="'+item.id+'">=='+item.title+'==</option>';
				
		});	
			
		$("#procate2").html(str);
		
		});
			
	}
   </script>
 </body>
 </html>