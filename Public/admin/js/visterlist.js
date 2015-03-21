$(document).ready(function(){
	
	getlist(0,9);
	
});

function getlist(page,pagenum) {
	var title= $("#title").val();
	title = encodeURIComponent(title);
	jQuery.getJSON("VisterlistAction.php?ttid="+Math.random(), {title:title,"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
	  	jQuery.each(items, function(index, item) {
	  		
	  		
	  		str+='<tr class="tr">';
	  		str+='<td class="td_center"><input type="checkbox" value="'+item[0]+'" ></td>';
	  		str+='<td>'+item[1]+'</td>';
	  		str+='<td>'+item[2]+'</td>';
	  		str+='<td>'+item[3]+'</td>';
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


function changeFaqcateEnable(id,enable)
{
	$.post("changeFaqcateEnabel.php?ttid="+Math.random(),{id:id,enable:enable},function(datas){
		window.location.reload();
	});
}

function modifyFaqCate(id)
{
	window.location="modifyFaqCate.php?id="+id+"&ttid="+Math.random();
}

function upSorts(preid,id,nextid)
{
	
	$.post("changeFaqCateSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"1"},function(datas){
		window.location.reload();
	});
}

function downSorts(preid,id,nextid)
{
	$.post("changeFaqCateSorts.php?ttid="+Math.random(),{id:id,preid:preid,nextid:nextid,"state":"0"},function(datas){
		window.location.reload();
	});
}

function changeTitle()
{
	getlist(0,9);
}
