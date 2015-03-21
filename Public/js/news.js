$(document).ready(function(){
	
	getlist(0,9);
	
});

function getlist(page,pagenum) {
	var faqcate = $("#faqcate").val();
	
	jQuery.getJSON("conn/FaqsPages.php?ttid="+Math.random(), {"pageno":page,"pagenum":9,faqcate:faqcate}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='';
	  	jQuery.each(items, function(index, item) {
	  		str+='<li><a href="newsInfo.php?id='+item[0]+'" >'+item[1]+'</a><span>'+item[4]+'</span></li>';
	  	});	
	  	$('#newsList').html("");
	  	jQuery(str).appendTo('#newsList');
        var preitemscount=$('#itemscount').val();
        if(itemscount!=preitemscount) {
        	$('#itemscount').val(itemscount);
        	$('#pagediv').pagination(itemscount,{items_per_page:9,callback:pagecallback});
        }
	  }catch(e){alert(e);}
	});
}

function selectFaq(obj,id)
{
	$(".hover").removeClass("hover");
	$(obj).addClass("hover");
	$("#faqcate").val(id);
	getlist(0,9);
}

function pagecallback(new_page_index, pagination_container){
	var pageNow = $("#pagenow").val();
	if(pageNow==new_page_index)
	 	return;
	$("#pagenow").val(new_page_index);
	 getlist(new_page_index,9);
}


