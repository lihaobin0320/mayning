$(document).ready(function(){
	
	getlist(0,9);
	
});

function getlist(page,pagenum) {
	
	jQuery.getJSON("LoginCountAction.php?ttid="+Math.random(), {"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
	  	jQuery.each(items, function(index, item) {
	  		if(item[4]==null || item[4]=="" || item[4]=="null")
	  		{
	  			item[4]="";
	  		}
	  		str+='<tr class="tr">';
	  		str+='<td class="td_center"><input type="checkbox"></td>';
	  		str+='<td>'+item[1]+'</td>';
	  		str+='<td>'+item[2]+'</td>';
	  		str+='<td>'+item[3]+'</td>';
	  		str+='<td>'+item[4]+'</td>';
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


