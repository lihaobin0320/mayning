<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
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
   <link rel="stylesheet" href="__PUBLIC__/kindeditor-4.1.10/themes/default/default.css" />
	<link rel="stylesheet" href="__PUBLIC__/kindeditor-4.1.10/plugins/code/prettify.css" />
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.10/kindeditor-min.js"></script>
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script charset="utf-8" src="__PUBLIC__/kindeditor-4.1.10/plugins/code/prettify.js"></script>
 </head>
 <body>
     <div class="main_top">
     
     <div id="forms" class="mt10">
        <div class="box">
          <div class="box_border">
            <div class="box_top"><b class="pl15">产品信息</b></div>
            <div class="box_center">
              <form action="__ROOT__/admin.php/Product/addProduct" class="jqtransform" method="post">
              
              	<input type="hidden" name="uploads" id="uploads" value="<?php echo ($product["imgs"]); ?>" />
              	<input type="hidden" name="ctime" value="<?php echo ($product["ctime"]); ?>" />
              	<input type="hidden" name="sorts" value="<?php echo ($product["sorts"]); ?>" />
              	<input type="hidden" name="id" value="<?php echo ($product["id"]); ?>" />
              	<input type="hidden"  id="proid" value="<?php echo ($product["proid"]); ?>" />
              	<input type="hidden"  id="propid" value="<?php echo ($pid); ?>" />
               <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                  <td class="td_right">产品名称：</td>
                  <td class=""> 
                    <input type="text" name="title" value="<?php echo ($product["title"]); ?>" placeholder="产品名称必填" required="required" class="input-text lh30" size="100">
                  </td>
                </tr>
                <tr >
                  <td class="td_right">产品分类：</td>
                  <td class="">
                    <span class="fl">
                      <div class="select_border"> 
                        <div class="select_containers "> 
                        <select name="procate" id="procate" class="select"  onchange="selectProcate()"> 
                       	<?php if(is_array($procateList)): $i = 0; $__LIST__ = $procateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select> 
                        <select name="procate2"  id="procate2" class="select"> 
                        </select> 
                        </div> 
                      </div> 
                    </span>
                  </td>
                  
                 </tr>
                 <tr>
                  <td class="td_right">产品详情：</td>
                  <td class="">
                    <textarea name="content" style="width:800px;height:400px;visibility:hidden;" id="" cols="30" rows="10" class="textarea"><?php echo ($product["details"]); ?></textarea>
                  </td>
                 </tr>
                 <tr>
                  <td class="td_right">发布状态：</td>
                  <td class="">
                  <?php if(($product["enable"] == 2)): ?><input type="radio" value="0" checked="checked" name="enable">不展示&nbsp;&nbsp;
                    <input type="radio" value="1"  name="enable">前台展示
                    <?php else: ?>
                    <input type="radio" value="0"  name="enable">不展示&nbsp;&nbsp;
                    <input type="radio" value="1" checked="checked" name="enable">前台展示<?php endif; ?>
                  </td>
                 </tr>
                <tr>
                  <td class="td_right">上传图片：</td>
                  <td class=""><input type="button"  id="uploadButton" value="选择文件" />
                  <span class="" id="img_td" style="display: none"><img id="uploadimgs" src="" width="100" height="100"/></span>
                  </td>
                   
                 </tr>
                 <tr>
                   <td class="td_right">&nbsp;</td>
                   <td class="">
                     <input type="submit"  name="button" class="btn btn82 btn_save2" value="保存"> 
                    <input type="button" onclick="javascript:window.history.go(-1)"  class="btn btn82 btn_res" value="返回"> 
                   </td>
                 </tr>
               </table>
               </form>
            </div>
          </div>
        </div>
     </div>
   </div>
   
   <script type="text/javascript">
   $(document).ready(function(){
	   var propid = $("#propid").val();
	   if(propid)
		 {
		   $("#procate").find("option[value='"+propid+"']").attr("selected",true); 
		 } 
	   selectProcate();
	   var imgs = $("#uploads").val();
	   if(imgs)
		  {
		   	$('#uploadimgs').attr("src",imgs);
			$("#img_td").css("display","block");
		  } 
	   KindEditor.ready(function(K) {
		   var options = {
				   items : [ 'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
					 	        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
						        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
						        'superscript', 'quickformat', 'selectall', '|', 'fullscreen', '/',
						        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
						        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
						        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'pagebreak',
						        'anchor', 'link', 'unlink']
			};
   		editor = K.create('textarea[name="content"]',options);

			var uploadbutton = K.uploadbutton({
				button : K('#uploadButton')[0],
				fieldName : 'imgFile',
				url : '__PUBLIC__/kindeditor-4.1.10/php/upload_json.php?dir=image',
				afterUpload : function(data) {
					if (data.error === 0) {
						var url = K.formatUrl(data.url, 'absolute');
						K('#uploads').val(url);
						K('#uploadimgs').attr("src",url);
						$("#img_td").css("display","block");
					} else {
						alert(data.message);
					}
				},
				afterError : function(str) {
					alert('上传失败: ' + str);
				}
			});
			uploadbutton.fileBox.change(function(e) {
				uploadbutton.submit();
			});
			
		});
   });
	function selectProcate()
	{
		var id = $("#procate").val();
		 var proid = $("#proid").val();
		$.getJSON("__ROOT__/admin.php/Product/selectChildProcate",{id:id},function(json){
		var str='';
		$.each(json,function(index,item){
				if(proid==item.id)
				{
					str+='<option selected="selected" value="'+item.id+'">=='+item.title+'==</option>';	
				}else{
					str+='<option value="'+item.id+'">=='+item.title+'==</option>';
				}	
				
			});	
			
		$("#procate2").html(str);
		
		});
			
	}
	
   </script> 
 </body>
 </html>