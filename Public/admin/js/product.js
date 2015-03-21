$(document).ready(function(){
	
	getlist(0,9);
	
	
});

function getlist(page,pagenum) {
	
	var title= $("#title").val();
	title = encodeURIComponent(title);
	var enable = $("#enable").val();
	var state = $("#state").val();
	var procate = $("#procate").val();
	var procate2 = $("#procate2").val();
	jQuery.getJSON("ProductAction.php?ttid="+Math.random(), {procate:procate,procate2:procate2,title:title,enable:enable,state:state,"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
	  	var num=0;
	  	jQuery.each(items, function(index, item) {
	  		
	  		index = parseInt(index);
	  		var len = parseInt(items.length);
	  		var preid = 0;
	  		if(index>0)
	  			{
	  			preid=items[index-1][0];
	  			}
	  		var nextid =0;
	  		if((index+1)>=len)
	  			{
	  			nextid=items[len-1][0];
	  			}else{
	  				nextid= items[index+1][0];
	  			}
	  		
	  		num++;
	  		str+='<tr class="tr">';
	  		str+='<td class="td_center"><input type="checkbox" value="'+item[0]+'" /> </td>';
	  		str+='<td class="td_center"><input type="hidden" name="sortid" value="'+item[0]+'" /><input type="text" name="sort" value="'+item[7]+'" onblur="blurInput(this)" onfocus="focusInput(this)"  style="border:1px;width:40px;" /><input type="button" onclick="sortConfirm(this)" name="sortbt" style="display:none;margin-top:5px;"  value="确定" class="ext_btn ext_btn_submit"></td>';
	  		str+='<td><img src="'+item[3]+'" height="100" width="100" /></td>';
	  		str+='<td>'+item[1]+'</td>';
	  		str+='<td>'+item[6]+'</td>';
	  		if(item[4]==1)
	  		{
	  			if(item[5]==1)
	  			{
	  				str+='<td>大图轮播<input type="button" class="ext_btn" value="取消" onclick=changeState('+item[0]+',0) ></td>';
	  			}else if(item[5]==2)
	  			{
	  				str+='<td>小图展示<input type="button" class="ext_btn" value="取消" onclick=changeState('+item[0]+',0) ></td>';
	  			}else{
	  				str+='<td>已展示</td>';	  				
	  			}
	  			
	  		}else{
	  			str+='<td>未展示</td>';
	  		}
	  		str+='<td>'+item[2]+'</td>';
	  		str+='<td>';
	  		str+='<input type="submit" value="修改" onclick="modifyProduct('+item[0]+')" class="ext_btn ext_btn_submit" />&nbsp;&nbsp;';
	  		if(index>0)
	  		{
	  			str+='<input type="button" value="上移" onclick="upSorts('+preid+','+item[0]+','+nextid+')" class="ext_btn ext_btn_error" />&nbsp;&nbsp;';	
	  		}
	  		if((index+1)!=len)
	  		{
	  			str+='<input type="button" value="下移"  onclick="downSorts('+preid+','+item[0]+','+nextid+')" class="ext_btn ext_btn_success"  />&nbsp;&nbsp;';
	  		}
	  		if(item[4]==1)
	  		{
	  			str+='<input type="button" class="ext_btn" value="前台隐藏" onclick=canelDisplay('+item[0]+',2)> &nbsp;&nbsp;';
	  			if(item[5]==1)
	  			{
	  				str+='<input type="button" class="ext_btn" value="小图展示" onclick=changeState('+item[0]+',2)> &nbsp;&nbsp;';	
	  			}else if(item[5]==2)
	  			{
	  				str+='<input type="button" class="ext_btn" value="大图轮播" onclick=changeState('+item[0]+',1)> &nbsp;&nbsp;';
	  			}else{
	  				str+='<input type="button" class="ext_btn" value="小图展示" onclick=changeState('+item[0]+',2)> &nbsp;&nbsp;';
	  				str+='<input type="button" class="ext_btn" value="大图轮播" onclick=changeState('+item[0]+',1)> &nbsp;&nbsp;';	
	  			}
	  			
	  		}else{
	  			str+='<input type="button" class="ext_btn" value="前台展示" onclick=canelDisplay('+item[0]+',1) > &nbsp;&nbsp;';
	  		}
	  		str+='</td>';
	  		str+='</tr>';
	  	});	
	  	$('#table_body').html("");
	  	jQuery(str).appendTo('#table_body');
        var preitemscount=$('#itemscount').val();
        if(itemscount!=preitemscount) {
        	$('#itemscount').val(itemscount);
        	$('#pagediv').pagination(itemscount,{items_per_page:9,callback:pagecallback});
        }
	  }catch(e){alert(e);}
	});
}


function pagecallback(new_page_index, pagination_container){
	var pageNow = $("#pagenow").val();
	if(pageNow==new_page_index)
	 	return;
	$("#pagenow").val(new_page_index);
	 getlist(new_page_index,9);
}

//取消前台显示
function canelDisplay(id,enable)
{
	$.post("changeProductEnabel.php?ttid="+Math.random(),{id:id,enable:enable},function(datas){
		getlist(0,9);
	});
}
//设置前台轮播
function changeState(id,state)
{
	$.post("changeProductState.php?ttid="+Math.random(),{id:id,state:state},function(datas){
		getlist(0,9);
	});
}

//选择前台显示隐藏状态
function changeEnable()
{
	var enable = $("#enable").val();
	if(enable==1 || enable=="1")
	{
		$("#state").show();
		
	}else{
		$("#state").hide();
	}
	
	getlist(0,9);
}

//选择展示状态搜索
function selectState()
{
	getlist(0,9);
}

//选择一级分类搜索
function changeProcate()
{
	var pid = $("#procate").val();
	if(pid)
	{
		$("#procate2").html('<option value="">==选择上级分类==</option>');
		$("#procate2").show();
		getlist(0,9);
	}else{
		$("#procate2").html('<option value="">==选择上级分类==</option>');
		$("#procate2").hide();
		getlist(0,9);
	}

	$.getJSON("../conn/GetProCateByPid.php?ttid="+Math.random(),{pid:pid},function(json){

	var items = json.items;
	var str='<option value="">==全部分类==</option>';
	$.each(items,function(index,item){
			str+='<option value="'+item[0]+'">=='+item[1]+'==</option>';
		});	
		
	$("#procate2").html(str);
	
	});
	
	
}

//选择二级分类搜索
function changeProcate2()
{
	getlist(0,9);
}

//输入名称搜索
function changeTitle()
{
	getlist(0,9);
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
	
	$.post("deleteProductsByIds.php?ttid="+Math.random(),{ids:ids},function(datas){
		getlist(0,9);
	});
}

function modifyProduct(id)
{
	window.location="modifyProduct.php?id="+id+"&ttid="+Math.random();
}

function upSorts(preid,id,nextid)
{
	
	$.post("changeProductSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"1"},function(datas){
		getlist(0,9);
	});
}

function downSorts(preid,id,nextid)
{
	$.post("changeProductSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"0"},function(datas){
		getlist(0,9);
	});
}

function focusInput(obj)
{
	$("input[name='sortbt']").hide();
	$(obj).parent().find("input[name='sortbt']").show();
}

function blurInput(obj)
{
	var oo= $(obj).parent().find("input[name='sortbt']");
	if($(oo).focus())
		{
			$(obj).parent().find("input[name='sortbt']").attr("disabled","disabled");
			sortConfirm(oo);
		}else{
			$(obj).parent().find("input[name='sortbt']").hide();
		}
}
function sortConfirm(obj)
{
	var sort= $(obj).parent().find("input[name='sort']").val();
	var id = $(obj).parent().find("input[name='sortid']").val();
	$.post("changeProductSortsById.php?ttid="+Math.random(),{id:id,sort:sort},function(datas){
		getlist(0,9);
	});
}

