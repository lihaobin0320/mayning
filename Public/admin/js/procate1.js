$(document).ready(function(){
	
	getlist(0,9);
	
});

function getlist(page,pagenum) {
	
	jQuery.getJSON("ProcateAction.php?ttid="+Math.random(), {"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
		
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
	  		str+='<tr class="tr">';
	  		str+='<td class="td_center"><input type="checkbox" value="'+item[0]+'" /> </td>';
	  		str+='<td class="td_center"><input type="hidden" name="sortid" value="'+item[0]+'" /><input type="text" name="sort" value="'+item[6]+'" onblur="blurInput(this)" onfocus="focusInput(this)"  style="border:1px;width:40px;" /><input type="button" onclick="sortConfirm(this)" name="sortbt" style="display:none;margin-top:5px;"  value="确定" class="ext_btn ext_btn_submit"></td>';
	  		str+='<td>'+item[1]+'</td>';
	  		str+='<td>'+item[2]+'</td>';
	  		if(item[3]==1)
	  		{
	  			str+='<td>已启用</td>';
	  		}else{
	  			str+='<td>未启用</td>';
	  		}
	  		if(item[5]==null || item[5]=='' || item[5]=='null')
	  		{
	  			item[5]="";
	  		}
	  		str+='<td>'+item[5]+'</td>';
	  		str+='<td>';
	  		if(item[4]==0 || item[4]=='0')
	  		{
	  			str+='<a href="addProcate.php?procate='+item[0]+'" class="ext_btn"><span class="add"></span>子分类</a>&nbsp;&nbsp;';
	  		}
	  		
	  		str+='<input type="submit" value="修改" onclick="modifyProcate('+item[0]+')" class="ext_btn ext_btn_submit" />&nbsp;&nbsp;';
	  		if(index>0)
	  		{
	  			str+='<input type="button" value="上移" onclick="upSorts('+preid+','+item[0]+','+nextid+')" class="ext_btn ext_btn_error" />&nbsp;&nbsp;';	
	  		}
	  		if((index+1)!=len)
	  		{
	  			str+='<input type="button" value="下移"  onclick="downSorts('+preid+','+item[0]+','+nextid+')" class="ext_btn ext_btn_success"  />&nbsp;&nbsp;';
	  		}
	  		
	  		if(item[3]==1)
	  		{
	  			str+='<input type="button" class="ext_btn" value="禁用"  onclick="changeProcateEnable('+item[0]+',0)"> &nbsp;&nbsp;';
	  		}else{
	  			str+='<input type="button" class="ext_btn" value="启用" onclick="changeProcateEnable('+item[0]+',1)"> &nbsp;&nbsp;';
	  		}
	  		str+='</td>';
	  		//str+='<td><input type="button" name="button" class="btn btn82 btn_config" value="配置">&nbsp;&nbsp;&nbsp;';
	  		//str+='<input type="button" name="button" class="btn btn82 btn_add" value="子分类">&nbsp;&nbsp;&nbsp;';
	  		//str+='<input type="button" name="button" class="btn btn82 btn_nochecked" value="禁用"></td>';
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
	
	$.post("deleteProcateByIds.php?ttid="+Math.random(),{ids:ids},function(datas){
		getlist(0,9);
	});
}

function changeProcateEnable(id,enable)
{
	$.post("changeProcateEnabel.php?ttid="+Math.random(),{id:id,enable:enable},function(datas){
		getlist(0,9);
	});
}

function modifyProcate(id)
{
	window.location="modifyProcate.php?id="+id+"&ttid="+Math.random();
}

function upSorts(preid,id,nextid)
{
	
	$.post("changeProcateSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"1"},function(datas){
		getlist(0,9);
	});
}

function downSorts(preid,id,nextid)
{
	$.post("changeProcateSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"0"},function(datas){
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
	$(this).attr("disabled","disabled");
	var sort= $(obj).parent().find("input[name='sort']").val();
	var id = $(obj).parent().find("input[name='sortid']").val();
	$.post("changeProcateSortsById.php?ttid="+Math.random(),{id:id,sort:sort},function(datas){
		getlist(0,9);
	});
}