$(document).ready(function(){
	
	getlist(0,9);
	
});

function getlist(page,pagenum) {
	var title= $("#title").val();
	title = encodeURIComponent(title);
	jQuery.getJSON("UserlistAction.php?ttid="+Math.random(), {title:title,"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
	  	jQuery.each(items, function(index, item) {
	  		
	  		if(item[3]==null || item[3]=="" ||item[3]=="null")
	  		{
	  			item[3]="";
	  		}
	  		if(item[5]==null || item[5]=="" ||item[5]=="null")
	  		{
	  			item[5]="";
	  		}
	  		var enable="";
	  		if(item[4]==1 || item[4]=="1")
	  		{
	  			enable="可用";
	  		}else{
	  			enable="禁用";
	  		}
	  		
	  		str+='<tr class="tr">';
	  		str+='<td class="td_center"><input type="checkbox" value="'+item[0]+'" ></td>';
	  		str+='<td>'+item[2]+'</td>';
	  		str+='<td>'+item[1]+'</td>';
	  		str+='<td>'+item[3]+'</td>';
	  		str+='<td>'+enable+'</td>';
	  		str+='<td>'+item[5]+'</td>';
	  		str+='<td>';
	  		str+='<input type="submit" value="修改" onclick="modifyUser('+item[0]+')" class="ext_btn ext_btn_submit" />&nbsp;&nbsp;';
	  		if(item[4]==1)
	  		{
	  			str+='<input type="button" class="ext_btn" value="禁用" onclick="changeUserEnable('+item[0]+',0)"> &nbsp;&nbsp;';
	  		}else{
	  			str+='<input type="button" class="ext_btn" value="启用" onclick="changeUserEnable('+item[0]+',1)" > &nbsp;&nbsp;';
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


function changeUserEnable(id,enable)
{
	$.post("changeUserEnabel.php?ttid="+Math.random(),{id:id,enable:enable},function(datas){
		window.location.reload();
	});
}

function modifyUser(id)
{
	window.location="modifyUser.php?id="+id+"&ttid="+Math.random();
}


function changeTitle()
{
	getlist(0,9);
}
