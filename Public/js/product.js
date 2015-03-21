$(document).ready(function(){
	
	getlist(0,9);
});

function getlist(page,pagenum) {
	var proCate=$("#procate").val();
	jQuery.getJSON('conn/ProPages.php?ttid='+Math.random(), {"procate":proCate,"pageno":page,"pagenum":9}, function(json, textStatus) {
	  if(json==null||json=='')
	  	return;
	  try{
	  	var items=json.items;
	  	var itemscount=json.itemscount;
	  	var str='<ul class="add_list" id="proList">';
	  	jQuery.each(items, function(index, item) {
	  		str+='<li><a href="productInfo.php?id='+item.id+'"><img src="'+item.imgs+'" width="215" height="207" /></a><span><a href="#">'+item.title+'</a></span></li>';
	  	});	
	  	str+='</ul>';
	  	$('.add_bo').html(str);
        var preitemscount=$('#itemscount').val();
        if(itemscount!=preitemscount) {
        	$('#itemscount').val(itemscount);
        	$('#pagediv').pagination(itemscount,{items_per_page:9,callback:pagecallback});
        }
	  }catch(e){alert(e);}
	});
}


function selectPro(obj,cateid)
{
	var name = $(obj).html();
	selectProCate(cateid,name);
	$(".hover").removeClass("hover");
	$(obj).addClass("hover");
	
	$("#procate").val(cateid);
	getlist(0,9);
}

function selectProCate(pid,name)
{
	$.getJSON("conn/GetProCateByPid.php?ttid="+Math.random(), {pid:pid}, function(json){
		var items = json.items ;
		if(items==null || items=="")
			{
				return ;
			}
		var str='<li title="All Products"><a href="javascript:void(0)" class="hover" onclick="selectPro(this,0)">All Products</a></li>';
		if(pid !=0 &&pid !="0")
			{
			str+='<li title="'+name+'"><a href="javascript:void(0)"  onclick="selectPro(this,'+pid+')">'+name+'</a></li>';	
			}
		
		$.each(items,function(index,item){
			str+='<li title="'+item[1]+'"><a href="javascript:void(0)"  onclick="selectPro(this,'+item[0]+')">'+item[1]+'</a></li>';
		});
		$("#cateList").html(str);
		
	});
}

function pagecallback(new_page_index, pagination_container){
	var pageNow = $("#pagenow").val();
	if(pageNow==new_page_index)
	 	return;
	$("#pagenow").val(new_page_index);
	 getlist(new_page_index,9);
}