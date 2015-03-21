$(document).ready(function(){
	//获取关于我们内容
	getAboutUs();
	
});


function getAboutUs()
{
	jQuery.getJSON('ListContentByCategory?ttid='+Math.random(), {"cateid":"2","pageno":"0","pagenum":"1"}, function(json, textStatus) {
		  if(json==null||json=='')
			  return ;
		  
			var items = json.items;
			$.each(items,function(index,item){
				$("#content").html(item.content);
			});
		  	
		});
};